var setMsgBig = {
    statusDate: function () {
        var str = "";
        if (serverTime.getFullYear() != startTime.getFullYear())
            str = startTime.getFullYear() + "年";
        str += startTime.getMonth() + 1 + "月" + startTime.getDate() + "日 " + setAutoZero(startTime.getHours())
            + ":" + setAutoZero(startTime.getMinutes());
        $("#msgBig").html("<h3 class=\"text-center\" style=\"color:white;\">" + str + " 开抢</h3>");
    },
    statusTime: function (str) {
        $("#msgBig").html("<h3 class=\"text-center\" style=\"color:white;\">倒计时 " + str + "</h3>");
    },
    statusStarted: function (remain) {
        $("#msgBig").html("<h3 class=\"text-center\" style=\"color:white;\">发放中，余量：" + remain + "</h3>");
    },
    statusCong: function () {
        $("#msgBig").html("<h3 class=\"text-center\" style=\"color:white;\">恭喜您，抢到了！</h3>");
    },
    statusSorry: function () {
        $("#msgBig").html("<h3 class=\"text-center\" style=\"color:white;\">Sorry，抢完了!</h3>");
    }
};

var setSnoBar = {
    barHide: function () {
        $("#snoBar").hide();
    },
    barShow: function () {
        $("#snoBar").show();
    },
    setSnoList: function (list) {
        var str = "";
        for (var i = 0; i < list.length; i++)
            str += list[i] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $("#snoList").html(str);
    },
    changeWidth: function () {
        var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        var listWidth = width - 190;
        $("#snoList").attr("width", listWidth);
    }
};

var setBtn = {
    btn: $("#btnGetTicket"),
    showBtn: function () {
        $("#btnDiv").show();
        $("#divReg").hide();
    },
    disabled: function () {
        this.btn.attr("disabled", "disabled");
    },
    notDisabled: function () {
        this.btn.removeAttr("disabled");
    },
    reg: function () {
        $("#btnDiv").hide();
        $("#divReg").show();
    },
    wait: function () {
        this.showBtn();
        this.disabled();
        this.btn.addClass("btn-warning");
        this.btn.removeClass("btn-danger");
        this.btn.text("即将开始");
    },
    started: function () {
        this.showBtn();
        this.notDisabled();
        this.btn.removeClass("btn-warning");
        this.btn.addClass("btn-danger");
        this.btn.text("我要抢");
    },
    over: function () {
        this.showBtn();
        this.disabled();
        this.btn.removeClass("btn-warning");
        this.btn.addClass("btn-danger");
        this.btn.text("已抢完");
    },
    gotten: function () {
        this.showBtn();
        this.disabled();
        this.btn.removeClass("btn-warning");
        this.btn.addClass("btn-danger");
        this.btn.text("已抢到");
    }
};

var setMsgSmall = {
    msg: $("#msgSmall"),
    msgHide: function () {
        this.msg.hide();
    },
    setHtml: function (str) {
        this.msg.html("<h5 class=\"text-center\" style=\"color: #ffffff;\">" + str + "</h5>");
    },
    showId: function () {
        this.msg.show();
        this.setHtml("当前学号：" + stuId );
    },
    showOk: function () {
        this.msg.show();
        this.setHtml(wordGet);
    },
    showSorry: function () {
        this.msg.show();
        this.setHtml(wordSorry);
    }
};

var ajaxControl = {
    getTime: function () {
        $.getJSON("../../getticket/time",
            {ticketId: ticketId},
            function (time, status) {
                if (status == "success") {
                    time.current += "000";
                    time.start += "000";
                    serverTime.setTime(time.current - 1000);
                    startTime.setTime(time.start);
                    var currentTime = new Date();
                    deltaTime = serverTime - currentTime;
                    $(document).ready(timeTick);
                }
            })
    },
    getSnoList: function () {
        if (remainTime > 0)
            setTimeout("ajaxControl.getSnoList()", 2000);
        else
            $.getJSON("../../getticket/snolist",
                {ticketId: ticketId},
                function (data, status) {
                    if (status == "success") {
                        setSnoBar.setSnoList(data.list);
                        if (!isGotten) setMsgBig.statusStarted(data.remain);
                        setSnoBar.barShow();
                        if (data.remain > 0)
                            setTimeout("ajaxControl.getSnoList()", 10000);
                        else {
                            if (!isGotten)
                            {
                                setMsgBig.statusSorry();
                                setMsgSmall.showSorry();
                                setBtn.over();
                            }
                        }
                    }
                });
    },
    postSubmit: function () {
        setBtn.disabled();
        $.post("../../getticket/get-ticket",
            {
                "ticketId": ticketId
            },
            function (data, status) {
                if (status == "success") {
                    switch (data) {
                        case '1':
                            alert("恭喜您，抢到了！");
                            isGotten = true;
                            setMsgBig.statusCong();
                            setMsgSmall.showOk();
                            setBtn.gotten();
                            cookieControl.setGotten();
                            break;
                        case '2':
                            alert("对不起，抢完了！~>_<~");
                            setMsgBig.statusSorry();
                            setMsgSmall.showSorry();
                            setBtn.over();
                            break;
                        case '3':
                            alert("亲，您已经抢过了！");
                            setBtn.notDisabled();
                            break;
                        case '4':
                            alert("亲，还没到时间呢！");
                            setBtn.notDisabled();
                            break;
                        case '5':
                            alert("亲，学号出错了！");
                            setBtn.notDisabled();
                            break;
                    }
                }
                else
                    setBtn.notDisabled();
            });
    }
};

function setAutoZero(str) {
    return str < 10 ? ("0" + str) : str;
}

function timeTick() {
    var currentTime = new Date();
    currentTime.setTime(currentTime.getTime() + deltaTime);
    remainTime = startTime - currentTime;
    if (remainTime >= 3600000) {
        setMsgBig.statusDate();
        setTimeout("timeTick()", 10000);
        return;
    }
    if (remainTime < 0) {
        if (stuId && !isGotten)
            setBtn.started();
        ajaxControl.getSnoList();
        return;
    }
    //var days = Math.floor(remainTime / (24 * 3600 * 1000));
    var leave1 = remainTime % (24 * 3600 * 1000);
    var hours = Math.floor(leave1 / (3600 * 1000));
    var leave2 = leave1 % (3600 * 1000);
    var minutes = Math.floor(leave2 / (60 * 1000));
    var leave3 = leave2 % (60 * 1000);
    var seconds = Math.floor(leave3 / 1000);
    var strTime = setAutoZero(hours) + ":" + setAutoZero(minutes) + ":" + setAutoZero(seconds);
    setMsgBig.statusTime(strTime);
    if (remainTime > 0) setTimeout("timeTick()", 1000);
}

var cookieControl = {
    setCookie: function (c_name, value, expireDays) {
        var exDate = new Date();
        exDate.setDate(exDate.getDate() + expireDays);
        document.cookie = c_name + "=" + escape(value) +
            ((expireDays == null) ? "" : ";expires=" + exDate.toGMTString());
    },
    getCookie: function (c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start != -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end == -1) c_end = document.cookie.length;
                return unescape(document.cookie.substring(c_start, c_end));
            }
        }
        return "";
    },
    isGotten: function () {
        return (this.getCookie("gotten" + ticketId) == "true");
    },
    setGotten: function () {
        this.setCookie("gotten" + ticketId, "true", 7)
    }
};

$(document).ready(function () {
    setSnoBar.changeWidth();
    setSnoBar.barHide();
    setMsgSmall.showId();
    setBtn.wait();
    if (cookieControl.isGotten()) {
        isGotten = true;
        setMsgBig.statusCong();
        setMsgSmall.showOk();
        setBtn.gotten();
    }
    $("#btnGetTicket").click(function () {
        ajaxControl.postSubmit();
    });
});

$(window).resize(
    setSnoBar.changeWidth
);

var startTime = new Date();
var serverTime = new Date();
//var days = hours = minutes = seconds = 0;
var deltaTime, isGotten = false;
ajaxControl.getTime();