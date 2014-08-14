//--- models -------------------------------

//数据模型，把存储结果的json当数据库处理
function MessageModel(data) {
    this.messageDB = new TAFFY(data[0].message);
    this.mpId = data[0].mp_id;
}

MessageModel.prototype.getWelcomeMsg = function () {
    return this.messageDB({keyword: {has: "mp_welcome_autoreply_message"} }).first();
};

MessageModel.prototype.getDefaultMsg = function () {
    return this.messageDB({keyword: {has: "mp_default_autoreply_message"} }).first();
};

MessageModel.prototype.getAllKeywordMsg = function () {
    return this.messageDB({keyword: {"!has": "mp_welcome_autoreply_message"}},
        {keyword: {"!has": "mp_default_autoreply_message"}}).get();
};

MessageModel.prototype.delMsgByKeyword = function(keyword) {
    this.messageDB({keyword: {has: keyword}}).remove();
};

//--- views --------------------------------

//获取界面相关的html代码
function MessageView(msg) {
    this.message = msg;
}

//获取获取图文消息的DIV
MessageView.prototype.getNewsDiv = function () {
   /* var newsTpl = '<div class="col-md-2">' +
        '<img style="margin-top: 9px" src="{0}" width="80px" height="80px">' +
        '</div> ' +
        '<div class="col-md-8">' +
        '<h5><a href="{1}">[图文消息] {2}</a></h5>' +
        '<p>{3}</p>' +
        '</div>';
    var newsMsg = this.message;
    var msgHtml = String.format(newsTpl, newsMsg.pic_url, newsMsg.url, newsMsg.title, newsMsg.description);
    return msgHtml;
   */
    if (this.message.content.length == 1)
    {
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
    else
    {
        var msgHtml = String.format(
            '<div class="examplebox2 col-md-6 margintop">' +
            '<div class="titlecover" style="padding: 15px; height: auto"><div class="greybox2" style="height: auto">' +
            '<img height="100%" width="100%" src="{0}">' +
            '<div class="titleline"><a href="{1}" class="colorWhite" target="_blank">{2}</a></div>'+
            '</div></div>',
           /* <div class="col-md-6 margintop imgtxtlist"><div class="thumbnail">' +
            '<img src="{0}" height="132px" width="292px">' +
            '<a href="{1}"><h4 style="margin: 8px!important;"> {2} </h4></a>' +
            '</div>',*/
            this.message.content[0].pic_url, this.message.content[0].url, this.message.content[0].title);
        for (var i = 1; i < this.message.content.length; i++)
        {
            msgHtml += String.format(
                '<div class="extrabox">' +
                '<div class="newsSubtitle col-sm-8"><a href="{0}" target="_blank">{1}</a></div>'+
                '<div class="col-sm-4"><img height="78px" width="78px" src="{2}"> </div>' +
                '</div>',
            /*'<div class="thumbnail">' +"
                '<div class="row">' +
                '<div class="col-sm-8"><a href="{0}"><h4>{1}</h4></div></a>' +
                '<div class="col-sm-4"><img height="78px" width="78px" src="{2}"> </div>' +
                '</div></div>',*/
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

    this.loadMsg(this.msgData.getWelcomeMsg(), $("#welcomeMsgContent"));
    this.loadMsg(this.msgData.getDefaultMsg(), $("#defaultMsgContent"));
    this.LoadKeywordRule();
}

//载入消息到欢迎消息或者默认消息框
MessageCtrl.prototype.loadMsg = function (msg, targetDiv) {
    if (!msg)  return;
    if (msg.type == "text") {
        targetDiv.text(msg.content);
        targetDiv.attr('contenteditable', true);
    }
    else {
        var view = new MessageView(msg);
        targetDiv.html(view.getNewsDiv());
        targetDiv.attr('contenteditable', false);
    }
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
    //格式化关键字，用逗号隔开
    var keywordStr = msg.keyword[0];
    if (msg.keyword.length > 1)
        for (var i = 1; i < msg.keyword.length; i++)
            keywordStr += ", " + msg.keyword[i];
    //加载关键字并修改id
    var ruleKey = ruleDiv.find('#ruleKeyTpl');
    ruleKey.text(keywordStr);
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

MessageCtrl.prototype.clearDiv = function(target, keyword) {
    $(target).html('');
    $(target).attr('contenteditable', true);
    this.msgData.delMsgByKeyword(keyword);
}

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
$('.glyphicon-pencil').click(function() {
    if (!$(this).hasClass('colorBlack'))
    {
        $(this).addClass('colorBlack');
        switch ($(this).parent().attr('id'))
        {
            case 'editTextWelcome':
                msgCtrl.clearDiv('#welcomeMsgContent', 'mp_welcome_autoreply_message');
                break;
            case 'editTextDefault':
                msgCtrl.clearDiv('#defaultMsgContent', 'mp_default_autoreply_message');
                break;
        }
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
