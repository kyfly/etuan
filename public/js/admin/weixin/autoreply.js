//--- models -------------------------------

//数据模型，把存储结果的json当数据库处理
function MessageModel(data) {
    this.messageDB = new TAFFY(data[0].message);
    this.mpId = data[0].mp_id;
}

MessageModel.prototype.getAllKeywordMsg = function () {
    return this.messageDB().get();
};

MessageModel.prototype.getMessageById = function(id) {
    return this.messageDB({mp_reply_id: id}).get();
};

MessageModel.prototype.getRegMsgById = function(reg_id) {
    return this.messageDB({act_id: reg_id}).get();
};

MessageModel.prototype.insertMessage = function(msg) {
    //将其他记录中的默认回复关键字删除
    var keywordToFind = "mp_welcome_autoreply_message";
    for (var i = 0; i < 2; i++ )
    {
        if (msg.keyword.indexOf(keywordToFind) > -1)
        {
            var keywordTmp = this.messageDB({keyword: {has: keywordToFind}}).select('keyword')[0];
            if (keywordTmp)
            {
                keywordTmp.removeByVal(keywordToFind);
                this.messageDB({keyword: {has: keywordToFind}}).update('keyword', keywordTmp);
            }
        }
        keywordToFind = "mp_default_autoreply_message";
    }
    return this.messageDB.insert(msg);
};

MessageModel.prototype.removeMsgById = function(id) {
    this.messageDB({mp_reply_id: id}).remove();
};

//--- views --------------------------------

//获取界面相关的html代码
function MessageView(msg) {
    this.message = msg;
}

//获取获取图文消息的DIV
MessageView.prototype.getNewsDiv = function () {
    if (this.message.content.length == 1) {
        if (this.message.CreateTime)
            var createTime = new Date(this.message.CreateTime * 1000 - 480 * 60000);
        else
            var createTime = new Date();
        createTime = createTime.getFullYear() + '-' + (createTime.getMonth() + 1) + '-' + createTime.getDate();
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
    for (var i = 0; i < msg.length; i++)
        this.AddKeywordRule(msg[i]);
};

//添加关键字规则div
MessageCtrl.prototype.AddKeywordRule = function (msg) {
    var ruleDivTpl = $('#ruleDivTpl');
    //拷贝模板，并修改id
    var ruleDivId = "rule" + msg.mp_reply_id;
    var ruleDiv = ruleDivTpl.clone().attr('id', ruleDivId);
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
    {
        $('#welcomeMsgTag').remove();
        keywordStr += '&nbsp&nbsp<code id="welcomeMsgTag">★被添加自动回复</code>';
    }
    if (hasDefault)
    {
        $('#defaultMsgTag').remove();
        keywordStr += '&nbsp&nbsp<code id="defaultMsgTag">★默认消息自动回复</code>';
    }
    //加载关键字并修改id
    var ruleKey = ruleDiv.find('#ruleKeyTpl');
    ruleKey.html(keywordStr);
    ruleKey.attr('id', "ruleKey" + msg.mp_reply_id);
    //加载自动回复内容并修改id
    var ruleContent = ruleDiv.find('#ruleContentTpl');
    if (msg.type == "text")
    {
        var textContent = msg.content;
        if (textContent.length > 50)
        {
            textContent = textContent.substring(0, 50);
            textContent += "...";
        }
        ruleContent.html('<h5>' + textContent.textToHtml() + '</h5');
    }
    else {
        var view = new MessageView(msg);
        ruleContent.html(view.getNewsDiv())
    }
    ruleContent.attr('id', 'ruleContent' + msg.mp_reply_id);
    //若该DIV已存在，则删除后再在同一位置添加
    var ruleDivAlready = $('#' + ruleDivId);
    if (ruleDivAlready.length)
    {
        nextDiv = ruleDivAlready.next();
        ruleDivAlready.remove();
        nextDiv.before(ruleDiv);
    }
    else
    //在隐藏的模板之前插入内容，不能在之后插入，否则会缺少margin-top:20px样式
        ruleDivTpl.before(ruleDiv);
    //模板有隐藏样式，需要改为显示
    ruleDiv.show();
    $('#sidebar').height($('#main').outerHeight(true));
};

//初始化添加/修改对话框
MessageCtrl.prototype.initModal = function(replyId) {
    //根据replyId获取消息
    var msg = this.msgData.getMessageById(replyId)[0];
    //添加关键字到TextArea中
    var keywordStr = '';
    for (var i = 0; i < msg.keyword.length; i++)
    {
        if (msg.keyword[i] != "mp_welcome_autoreply_message" && msg.keyword[i] != "mp_default_autoreply_message")
            keywordStr += msg.keyword[i] + "\n";
    }
    keywordStr = keywordStr.substring(0, keywordStr.length-1);
    $('#txtKeywords').val(keywordStr);
    //根据消息类型设定消息内容编辑框
    switch (msg.type)
    {
        case 'text':
            $('#addText').click();
            $('#msgEditor').html(msg.content.textToHtml());
            break;
        case 'news':
            switch (msg.news_from)
            {
                case 'registration':
                    $('#addReg').click();
                    $("input[name=regRadio][value=" + msg.act_id + "]")[0].checked = true;
                    break;
                case 'url':
                    $("#addNews").click();
                    prevNewsText = msg.content[0].url;
                    for (var i = 1; i < msg.content.length; i++)
                         prevNewsText += "\n" + msg.content[i].url;
                    $('#newsText').val(prevNewsText);
                    break;
            }
            break;
    }
    if (msg.keyword.indexOf("mp_welcome_autoreply_message") > -1)
    {
        $('#setAsWelcome').prop('checked', true);
    }
    else
    {
        $('#setAsWelcome').prop('checked', false);
    }
    if (msg.keyword.indexOf("mp_default_autoreply_message") > -1)
    {
        $('#setAsDefault').prop('checked', true);
    }
    else
    {
        $('#setAsDefault').prop('checked', false);
    }
};

MessageCtrl.prototype.clearModal = function() {
    $('#txtKeywords').val('');
    $('#addText').click();
    $('#setAsWelcome').prop('checked', false);
    $('#setAsDefault').prop('checked', false);
};

MessageCtrl.prototype.removeKeywordRule = function (id) {
    $.get('/weixin/reply/destory', {reply_id: id},
        function (data, status) {
            if (status == 'success')
            {
                if (data == 'true')
                {
                    $('#rule'+id).remove();
                    msgData.removeMsgById(id);
                    msgCtrl.showAlert('自动回复删除成功！');
                    $('#sidebar').height($('#main').outerHeight(true));
                }
                else
                    alert("哎呀呀，删除失败了！");
            }
        }
    );
};

MessageCtrl.prototype.uploadMessage = function (message) {
    $.post(!message.mp_reply_id ? '/weixin/reply/create' : '/weixin/reply/update',
        JSON.stringify(message),
        function (data, status){
            if (status == 'success')
            {
                data = JSON.parse(data);
                if (data.status == 'success')
                {
                    if (!message.content)
                        message.content = data.content;
                    if (!message.mp_reply_id)
                        message.mp_reply_id = data.mp_reply_id;
                    else
                        msgData.removeMsgById(message.mp_reply_id);
                    msgData.insertMessage(message);
                    msgCtrl.AddKeywordRule(message);
                    $('#addrulebox').modal('hide');
                    msgCtrl.showAlert('微信自动回复设置成功！');
                }
                else
                {
                    alert("对不起，未创建消息!\n错误信息：" + data.message);
                }
            }
            $('#btnSave').removeAttr("disabled");
        }
    )
};

MessageCtrl.prototype.showAlert = function (alertStr, type) {
    if (!type)  type = 'info';
    var alert = $('#topAlert');clearTimeout(closeAlertTimer);
    alert.removeClass();
    alert.addClass('alert alert-dismissible');
    alert.addClass('alert-' + type);
    $('#topAlertStr').text(alertStr);
    alert.slideDown();
    closeAlertTimer = setTimeout(function() {
        alert.slideUp();
    }, 5000);
};

//--- other ---------------------------------

//加载自动回复数据
function loadAutoReply() {
    var ajaxUrl = "/weixin/reply/show";
    $.getJSON(ajaxUrl, function (data, status) {
        if (status == "success") {
            msgData = new MessageModel(data);
            msgCtrl = new MessageCtrl(msgData);
            $('#btnAddRule').removeAttr("disabled");
            $('#btnOneKeyReg').removeAttr("disabled");
            $('#loadingAlert').slideUp();
        }
    });

}

//--- 事件响应 -------------------------------
$('#addText').click(function () {
    if (!$(this).hasClass('colorBlack')) {
        $(this).addClass('colorBlack');
        $('#addReg').removeClass('colorBlack');
        $('#addNews').removeClass('colorBlack');
        var editor = $('#msgEditor');
        editor.html('请在此处输入文字消息');
        editor.attr('contenteditable', 'true');
    }
});

$('#addReg').click(function () {
    if (!$(this).hasClass('colorBlack')) {
        $.get('/registration/activitylist', function (data, status) {
            if (status == 'success') {
                if (data.length == 0)
                {
                    alert("您未创建任何报名表，请前往报名模块创建！");
                    return;
                }
                $('#addReg').addClass('colorBlack');
                $('#addText').removeClass('colorBlack');
                $('#addNews').removeClass('colorBlack');
                var editor = $('#msgEditor');
                editor.attr('contenteditable', 'false');
                data = eval(data);
                var regHtml = '<div class="form-group">';
                for (var i = 0; i < data.length; i++) {
                    regHtml += String.format('<label class="control-label">' +
                        '<input type="radio" id="reg{0}" value="{0}" name="regRadio"' +
                        (i == 0 ? 'checked="true"' : '') +
                        '>{1}</label><br>',
                        data[i].reg_id, data[i].name);
                }
                regHtml += '</div>';
                editor.html(regHtml);
            }
        })
    }
});

$('#addNews').click(function () {
    if (!$(this).hasClass('colorBlack')) {
        $(this).addClass('colorBlack');
        $('#addText').removeClass('colorBlack');
        $('#addReg').removeClass('colorBlack');
        var editor = $('#msgEditor');
        editor.attr('contenteditable', 'false');
        var newsHtml = '<label class="control-label" for="news1">图文素材网址：</label>' +
            '<textarea class="form-control" rows="4" id="newsText"></textarea>' +
            '<p class="help-block">输入回车可添加多条图文网址</p>' +
            '<a>如何获得图文网址 <span class="glyphicon glyphicon-question-sign"></span></a>';
        editor.html(newsHtml);
    }
});

$('#btnSave').click(function () {
    var message = {};
    message.mp_reply_id = mpReplyId;
    message.mp_id = msgData.mpId;
    var keywordStr = $('#txtKeywords').val();
    if (keywordStr == '') {
        alert("啊哦，保存失败了！关键字不能为空哦！");
        return;
    }
    //去除多个连续的回车符
    while (keywordStr != keywordStr.replace("\n\n", "\n")) {
        keywordStr = keywordStr.replace("\n\n", "\n");
    }
    message.keyword = keywordStr.split("\n");
    //删除最后一个回车导致的空项目
    if (message.keyword[message.keyword.length - 1] == '')
        message.keyword.splice(message.keyword.length - 1, 1);
    //判断是否大于30字符
    for (var i = 0; i < message.keyword.length; i++)
        if (message.keyword[i].length > 30) {
            alert("啊哦，保存失败了！\n关键词“" + message.keyword[i] + "”大于30个字符了呀！");
            return;
        }
    if ($('#addText').hasClass('colorBlack')) {
        message.content = $('#msgEditor').html().htmlToText();
        message.type = "text";
        if (message.content == "") {
            alert("啊哦，保存失败了！\n文字回复内容不能为空哦！");
            return;
        }
        if (message.content.length > 600) {
            alert("啊哦，保存失败了！\n文字回复不能超过600字哦！");
            return;
        }
    }
    else if ($('#addReg').hasClass('colorBlack')) {
        message.type = "news";
        message.news_from = "registration";
        message.act_id = Number($("input[name='regRadio']:checked").val());
    }
    else {
        message.type = "news";
        message.news_from = "url";
        var newsText = $('#newsText').val();
        if (newsText == '')
        {
            alert("啊哦，保存失败了！\n图文地址不能为空哦！");
            return;
        }
        $(this).attr("disabled", "disabled");
        //优化性能，当图文url未改变时，不向服务器发起请求
        if (newsText != prevNewsText)
        //采用同步方式，将url传递给服务器，抓取微信素材库内容
            $.ajax({
                type: 'POST',
                url: '/weixin/reply/sucai',
                async: false,
                data: 'url=' + encodeURIComponent(newsText),
                success: function (data) {
                    message.content = JSON.parse(data);
                }
            });
        else
        {
            var tmpMsg = msgData.getMessageById(message.mp_reply_id)[0];
            message.content = tmpMsg.content;
        }
        prevNewsText = "";
    }
    //添加欢迎消息关键字
    if ($('#setAsWelcome').is(":checked"))
    {
        message.keyword.push('mp_welcome_autoreply_message');
    }
    if ($('#setAsDefault').is(":checked"))
    {
        message.keyword.push('mp_default_autoreply_message');
    }
    $(this).attr("disabled", "disabled");
    //向服务器发送数据，根据message.mp_reply_id是否定义判断目标接口
    msgCtrl.uploadMessage(message);
});

$('#btnOneKeyReg').click(function() {
    $(this).attr("disabled", "disabled");
    //获取报名表
    $.get('/registration/activitylist', function (data, status) {
        if (status == 'success') {
            if (data.length == 0)
            {
                alert("您未创建任何报名表，请前往报名模块创建！");
                return;
            }
            data = eval(data);
            var i = 0;
            while (i < data.length && msgData.getRegMsgById(data[i].reg_id)[0]) i++;
            if (data[i])
            {
                var message = {};
                message.mp_id = msgData.mpId;
                message.type = "news";
                message.news_from = "registration";
                message.act_id = data[i].reg_id;
                if (i == 0)
                    message.keyword = ["报名"];
                else
                    message.keyword = ["报名" + data[i].reg_id];
                msgCtrl.uploadMessage(message);
            }
            else
            {
                msgCtrl.showAlert('没有新的报名可以添加。', 'danger');
            }
            $('#btnOneKeyReg').removeAttr("disabled");
        }
    });
});

$('#btnAddRule').click(function () {
    msgCtrl.clearModal();

});

$('#addrulebox').on('hidden.bs.modal', function () {
    mpReplyId = undefined;
});

$('#btnConfirmDel').click(function () {
    msgCtrl.removeKeywordRule(mpReplyId);
    $('#delMsgModal').modal('hide');
});

$('#delMsgModal').on('hidden.bs.modal', function () {
    mpReplyId = undefined;
});

$('#topAlertClose').click(function () {
    $('#topAlert').slideUp();
    alert.removeClass();
    alert.addClass('alert alert-dismissible');
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

String.prototype.htmlToText = function() {
    var text = this.replace("<br>", "\n");
    text = text.replace("&nbsp;", " ");
    return text;
};


String.prototype.textToHtml = function() {
    var html = this.replace("\n", "<br>");
    html = html.replace(" ", "&nbsp;");
    return html;
};

Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};

Array.prototype.removeByVal = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};

function enterKeyPressHandler(evt) {
    var sel, range, br, addedBr = false;
    evt = evt || window.event;
    var charCode = evt.which || evt.keyCode;
    if (charCode == 13) {
        if (typeof window.getSelection != "undefined") {
            sel = window.getSelection();
            if (sel.getRangeAt && sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                br = document.createElement("br");
                range.insertNode(br);
                range.setEndAfter(br);
                range.setStartAfter(br);
                sel.removeAllRanges();
                sel.addRange(range);
                addedBr = true;
            }
        } else if (typeof document.selection != "undefined") {
            sel = document.selection;
            if (sel.createRange) {
                range = sel.createRange();
                range.pasteHTML("<br>");
                range.select();
                addedBr = true;
            }
        }

        // If successful, prevent the browser's default handling of the keypress
        if (addedBr) {
            if (typeof evt.preventDefault != "undefined") {
                evt.preventDefault();
            } else {
                evt.returnValue = false;
            }
        }
    }
}


$(document).ready(function () {
    $('#topAlert').hide();
    loadAutoReply();

    var el = document.getElementById("msgEditor");
    if (typeof el.addEventListener != "undefined") {
        el.addEventListener("keypress", enterKeyPressHandler, false);
    } else if (typeof el.attachEvent != "undefined") {
        el.attachEvent("onkeypress", enterKeyPressHandler);
    }

    $('body').tooltip({
        selector: '[rel=tooltip]'
    });
    $('#main').on('click', '.btnEditReply', function() {
        mpReplyId = $(this).parents('.bs-callout').attr('id').substring(4);
        mpReplyId = Number(mpReplyId);
        msgCtrl.initModal(mpReplyId);
    });
    $('#main').on('click', '.btnDelReply', function() {
        mpReplyId = $(this).parents('.bs-callout').attr('id').substring(4);
        mpReplyId = Number(mpReplyId);
    });
    $.ajaxSetup({
        complete: function(XMLResponse,status) {
            if (status != "success")
            {
                if (status=='error') {
                    alert("啊呀呀，出错了，5555555...再试一遍吧。。\n错误码：" + XMLResponse.status);
                }
                else
                    alert("哎呀呀，出错了！再试一遍吧 T_T\n错误信息: " + status);
            }
        }
    });
});

var mpReplyId;
var closeAlertTimer;
var prevNewsText = "";