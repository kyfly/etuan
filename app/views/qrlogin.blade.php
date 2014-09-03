<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
    <title>团团一家 - 用户登录</title>
    <link rel="stylesheet" href="/css/ewmlogin.css">
</head>

<body><div id="login_container">
    <div class="main">
        <div class="loginPanel normalPanel">
            <div class="title">
                <p>微信登录</p>
            </div>
            <div class="waiting panelContent">
                <div class="qrcodeContent" style="position:relative;">
                    <div id="guideTrigger" style="position:absolute;z-index:9999;width:260px;height:100%;left:46%;top:0px;margin-left:-130px;">
                        <img src="/weixin/login/code" style="height: 301px; width: 301px;"></div>
                </div>
                <div class="info">
                    <div class="normlDesc loginTip pngBackground" style="position:relative;">
                        <div class="loginTipL pngBackground"></div>
                        <div class="loginTipR pngBackground"></div>
                        <p>请使用微信扫描二维码以登录</p>
                        <div id="tipTrigger" style="position:absolute;z-index:9999;width:100%;height:100%;left:0px;top:0px;"></div>
                    </div>
                    <img class="guide pngImg" style="z-index:9999;" src="/img/login_guide.png">
                </div>
            </div>
            <div id="mask" class="mask" style="display:none;width:100%;height:100%;" ></div>
        </div>
    </div>
</div>

<div class="footer">
    <a class="btline"></a>
    <p class="webwx"><hr style="border:1px solid #242627; opacity: 0.2;">www.etuan.org&nbsp;&nbsp;团团一家</p>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script>
    (function($, _aoWin) {
        if($("img.guide").length > 0) {
            var _nTimer = 0,
                _oGuide$ = $(".guide"),
                _oGuideTrigger$ = $("#guideTrigger, #tipTrigger"),
                _oMask$ = $(".mask");

            function _back() {
                _nTimer = setTimeout(function() {
                    _oMask$.stop().animate({opacity:0}, function(){$(".mask").hide()});
                    _oGuide$.stop().animate({marginLeft:"-120px",opacity:0}, "400", "swing",function(){
                        _oGuide$.hide();
                    });
                }, 100);
            }

            /*guide*/
            _oGuide$.css({"left":"50%", "opacity":0});
            _oGuideTrigger$.mouseover(function(){
                clearTimeout(_nTimer);
                _oMask$.show().stop().animate({"opacity":0.2});
                _oGuide$.css("display", "block").stop().animate({marginLeft:"+168px", opacity:1}, 900, "swing", function() {
                    _oGuide$.animate({marginLeft:"+153px"}, 300);
                });
                _ossLog();
            }).mouseout(_back);

            _oGuide$.mouseover(function(){
                clearTimeout(_nTimer);
            }).mouseout(_back);
        }
    })(jQuery, window);

    var token = "{{$token}}";
    function checkStatus()
    {
        $.get("/weixin/login/check", {state : token}, function (data, status) {
            if (data != "false" && status == "success")
                window.location.href = data;
        });
    }

    $(document).ready(
        setInterval("checkStatus()", 1000)
    )
</script>
</body>
</html>