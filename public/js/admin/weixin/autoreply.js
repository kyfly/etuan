//--- models -------------------------------

//数据模型，把存储结果的json当数据库处理
function MessageModel(data) {
    this.messageDB = new TAFFY(data[0].message);
    this.mpId = data[0].mp_id;
}

MessageModel.prototype.getAllKeywordMsg = function () {
    return this.messageDB().get();
};

//--- views --------------------------------

//获取界面相关的html代码
function MessageView(msg) {
    this.message = msg;
}

//获取获取图文消息的DIV
MessageView.prototype.getNewsDiv = function () {
    if (this.message.content.length == 1) {
        var createTime = new Date(this.message.CreateTime);
        with (createTime) {
            createTime = getFullYear() + '-' + (getMonth() + 1) + '-' + getDay();
        }
        var msgHtml = String.format('<div class="col-md-6 margintop newsSingle">' +
            '<a href="{0}" target="_blank"><h4 class="colorBlack"> {1} </h4></a>' +
            '<p>{2}</p>' +
            '<img height="100%" width="100%" src="{3}" >' +
            '<p style="margin-top: 15px">{4}</p>' +
            '</div>',
            this.message.content[0].url, this.message.content[0].title, createTime,
            this.message.content[0].pic_url, this.message.content[0].description);
        return msgHtml;
    }
    else {
        var msgHtml = String.format(
            '<div class="examplebox2 col-md-6 margintop">' +
                '<div class="titlecover" style="padding: 15px; height: auto"><div class="greybox2" style="height: auto">' +
                '<img height="100%" width="100%" src="{0}">' +
                '<div class="titleline"><a href="{1}" class="colorWhite" target="_blank">{2}</a></div>' +
                '</div></div>',
            this.message.content[0].pic_url, this.message.content[0].url, this.message.content[0].title);
        for (var i = 1; i < this.message.content.length; i++) {
            msgHtml += String.format(
                '<div class="extrabox">' +
                    '<div class="newsSubtitle col-sm-8"><a href="{0}" target="_blank">{1}</a></div>' +
                    '<div class="col-sm-4"><img height="78px" width="78px" src="{2}"> </div>' +
                    '</div>',
                this.message.content[i].url, this.message.content[i].title, this.message.content[i].pic_url
            )
        }
        msgHtml += '</div>';
        return msgHtml;
    }
};

//--- controllers ---------------------------

//控制界面元素的显示
function MessageCtrl(messageData) {
    this.msgData = messageData;

    this.LoadKeywordRule();
}

MessageCtrl.prototype.isReserve = function (keyword) {
    return keyword == 'mp_welcome_autoreply_message' || keyword == 'mp_default_autoreply_message';
};

//载入自定义关键字消息，采用Add循环添加
MessageCtrl.prototype.LoadKeywordRule = function () {
    var msg = this.msgData.getAllKeywordMsg();
    for (var key in msg)
        this.AddKeywordRule(msg[key]);
};

//添加关键字规则div
MessageCtrl.prototype.AddKeywordRule = function (msg) {
    var ruleDivTpl = $('#ruleDivTpl');
    //拷贝模板，并修改id
    var ruleDiv = ruleDivTpl.clone().attr('id', "rule" + msg.msg_id);
    //格式化关键字，用空格隔开
    var keywordStr = '';
    for (var i = 0; i < msg.keyword.length; i++)
        if (msg.keyword[i] == 'mp_welcome_autoreply_message')
            var hasWelcome = true;
        else if (msg.keyword[i] == 'mp_default_autoreply_message')
            var hasDefault = true;
        else
            keywordStr += msg.keyword[i] + '&nbsp&nbsp';

    if (hasWelcome)
        keywordStr += '&nbsp&nbsp<code>★被添加自动回复</code>';
    if (hasDefault)
        keywordStr += '&nbsp&nbsp<code>★默认消息自动回复</code>';
    //加载关键字并修改id
    var ruleKey = ruleDiv.find('#ruleKeyTpl');
    ruleKey.html(keywordStr);
    ruleKey.attr('id', "ruleKey" + msg.msg_id);
    //加载自动回复内容并修改id
    var ruleContent = ruleDiv.find('#ruleContentTpl');
    if (msg.type == "text")
        ruleContent.html('<h5>' + msg.content + '</h5');
    else {
        var view = new MessageView(msg);
        ruleContent.html(view.getNewsDiv())
    }
    ruleContent.attr('id', 'ruleContent' + msg.msg_id);
    //在隐藏的模板之前插入内容，不能在之后插入，否则会缺少margin-top:20px样式
    ruleDivTpl.before(ruleDiv);
    //模板有隐藏样式，需要改为显示
    ruleDiv.show();
};

//--- other ---------------------------------

//加载自动回复数据
function loadAutoReply() {
    var ajaxUrl = "/static/showautoreply.json";
    $.getJSON(ajaxUrl, function (data, status) {
        if (status == "success") {
            msgData = new MessageModel(data);
            msgCtrl = new MessageCtrl(msgData);
        }
        else
            alert("获取自动回复数据失败！");
    });

}

//--- 事件响应 -------------------------------
$('#addText').click(function () {
    if (!$(this).hasClass('colorBlack')) {
        $(this).addClass('colorBlack');
        $('#addReg').removeClass('colorBlack');
        $('#addNews').removeClass('colorBlack');
        var editor = $('#msgEditor');
        editor.html('请在此处输入文字');
        editor.attr('contenteditable', 'true');
    }
});

$('#addReg').click(function () {
    if (!$(this).hasClass('colorBlack')) {
        $(this).addClass('colorBlack');
        $('#addText').removeClass('colorBlack');
        $('#addNews').removeClass('colorBlack');
        var editor = $('#msgEditor');
        editor.html('报名列表正在加载中...');
        editor.attr('contenteditable', 'false');
        $.get('reglist.json', function (data, status) {
            if (status == 'success') {
                data = eval(data);
                var regHtml = '<div class="form-group">';
                for (var i in data) {
                    regHtml += String.format('<label class="control-label">' +
                        '<input type="radio" id="reg{0}" value="reg{0}" name="regRadio"' +
                        (i == 0 ? 'checked="true"' : '') +
                        '>{1}</label><br>',
                        data[i].reg_id, data[i].name);
                }
                regHtml += '</div>';
                $('#msgEditor').html(regHtml);
            }
        })
    }
});

$('#addNews').click(function() {
    if (!$(this).hasClass('colorBlack')) {
        $(this).addClass('colorBlack');
        $('#addText').removeClass('colorBlack');
        $('#addReg').removeClass('colorBlack');
        var editor = $('#msgEditor');
        editor.attr('contenteditable', 'false');
        var newsHtml = '<label class="control-label" for="news1">图文素材网址：</label>' +
            '<input class="form-control" id="news1" type="text" style="width:330px">';
        editor.html(newsHtml);
    }

});

//添加格式化字符串函数支持
if (!String.format) {
    String.format = function (format) {
        var args = Array.prototype.slice.call(arguments, 1);
        return format.replace(/{(\d+)}/g, function (match, number) {
            return typeof args[number] != 'undefined' ? args[number] : match;
        });
    };
}

$(document).ready(function () {
    $('#ruleDivTpl').hide();
    loadAutoReply();
});
