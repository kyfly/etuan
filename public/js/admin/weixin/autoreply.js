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


//--- views --------------------------------

//获取界面相关的html代码
function MessageView(msg) {
    this.message = msg;
}

//获取获取图文消息的DIV
MessageView.prototype.getNewsDiv = function () {
    var newsTpl = '<div class="col-md-2">' +
        '<img style="margin-top: 9px" src="{0}" width="80px" height="80px">' +
        '</div> ' +
        '<div class="col-md-8">' +
        '<h5><a href="{1}">[图文消息] {2}</a></h5>' +
        '<p>{3}</p>' +
        '</div>';
    var newsMsg = this.message;
    var msgHtml = String.format(newsTpl, newsMsg.pic_url, newsMsg.url, newsMsg.title, newsMsg.description);
    return msgHtml;
};

//--- controllers ---------------------------

//控制界面元素的显示
function MessageCtrl(msgData) {
    this.msgData = msgData;

    this.loadMsg(msgData.getWelcomeMsg(), $("#welcomeMsgContent"));
    this.loadMsg(msgData.getDefaultMsg(), $("#defaultMsgContent"));
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
    var msg = msgData.getAllKeywordMsg();
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
