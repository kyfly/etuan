<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <title>幸运大转盘抽奖</title>
    <link href="/css/choujiang.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script>
        document.write('<h2>您的浏览器版本过低</h2><p>本网站不支持IE8及以下版本，请更换浏览器！</p><p>若已使用高版本浏览器，请关闭兼容模式。</p>');
        document.execCommand("stop");
    </script>
    <![endif]-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?76a5edb5c9902d7c2e38f7a723060cff";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>

<body class="activity-lottery-winning">
<div class="main">
    <div id="outercont">
        <div id="outer-cont">
            <div id="outer" style="-webkit-transform: rotate(0deg);"><img src="/img/choujiang/activity-lottery-1.png"
                                                                          width="310px"></div>
        </div>
        <div id="inner-cont">
            <div id="inner"><img src="/img/choujiang/activity-lottery-2.png"></div>
        </div>
    </div>
    <div class="content">
        <div class="boxcontent boxyellow" id="myResult" style="display: none">
            <div class="box">
                <div class="title-green">中奖信息</div>
                <div class="Detail" >
                    <p>恭喜您，获得了<span id="myResultName"></span>！</p>
                    <p>我们将在10月底安排发放奖品，请留意团团一家微信服务号通知。</p>
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow">
            <div class="box">
                <div class="title-green"><span>奖项设置：</span></div>
                <div class="Detail">
                    <p>一等奖：香蕉雨伞。奖品数量：10 </p>

                    <p>二等奖：按键水杯。奖品数量：40 </p>

                    <p>三等奖：团团一家鼠标垫。奖品数量：300 </p>
                    <br>
                    <img src="/img/choujiang/prize_vertical.jpg">
                    <p>说明：<br>
                        1. 只有参与过在线报名的14级新生才能参加，每人仅限参加一次！<br>
                        2. 我们将在10月底安排发放奖品，请留意团团一家微信号通知。</p>
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow">
            <div class="box">
                <div class="title-green">中奖名单</div>
                <div class="Detail" >
                    <marquee id="lotteryResult" direction="up" scrolldelay="150">
                        <p>中奖名单加载中...</p>
                    </marquee>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="/js/jQueryRotate.2.2.js"></script>
<script>
    var lotteryId = {{$lotteryId}};
</script>
<script src="/js/choujiang0.js"></script>
</body>
</html>
