<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>提示信息</title>
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
            background-color: #e7e8ec;
        }

        .navbar {
            margin-bottom: 0;
        }

        .headtitle {
            color: #7f8c8d;
            font-size: 30px;
        }

        .field {
            margin: 30px;
            padding: 30px;
            border: 1px solid #e5e5e5;
            background-color: #fff;
            min-height: 500px;
        }

        .centerclass {
            text-align: center;
        }

        .centerclass > .glyphicon-ok {
            font-size: 100px;
            color: #009900;
        }

        .centerclass > .glyphicon-exclamation-sign {
            font-size: 100px;
            color: #c30000;
        }

        .texts {
            text-align: center;
            margin-top: 70px;
        }

        .texts-xs {
            text-align: center;
            margin-bottom: 30px;
        }

        .p1 {
            font-size: 25px;
        }

        .visible-in-xs {
            background-color: #ffffff !important;
            padding-top: 20px;
        }

        .img-md {
            margin-top: 60px;
        }

        .img-xs {
            margin-bottom: 40px;
        }

        .img-prize {
            margin-top: 40px;
        }

        .img-prize-xs {
            margin-bottom: 20px;
            width: 100%;
            height: 100%;
        }

        h3 {
            line-height: 36px;
        }

        .btn-xsmall {
            width: 100%;
        }

        @media screen and (min-width: 1300px) {
            .texts {
                text-align: center;
                margin-top: 70px;
            }

            .centerclass {
                text-align: center;
            }

            .centerclass > .glyphicon-ok {
                font-size: 100px;
                color: #009900;
                margin-top: 30px;
            }

            .centerclass > .glyphicon-exclamation-sign {
                font-size: 100px;
                color: #c30000;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
<!--头部-->
@include('layout.nav')
<div class="container mainHeight hidden-xs">
    <div class="field clearfix">
        <div class="centerclass col-md-offset-1 col-md-3 img-md">
            <img src="http://img.kyfly.net/common/qrcode/wx-etuan.jpg@220w_220h.jpg" width="220px" height="220px">
            <h4 class="text-center">扫码关注 微信号e-tuan</h4>
        </div>
        <div class="texts col-md-8">
            <h1>报名成功！</h1>

            <h3>关注“团团一家”微信号（e-tuan），<br>即可赢取奖品还有更多报名！</h3>
            <br>
            <button class="btn btn-warning btn-lg btn-lottery">点击抽奖</button>
            &nbsp;&nbsp;&nbsp;
            <button class="btn btn-info btn-lg btn-more">更多报名</button>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-10 col-md-offset-1">
            <img class="img-prize" src="/img/choujiang/prize_horizontal.jpg">
        </div>
    </div>
</div>

<div class="container mainHeight visible-xs-block visible-in-xs">
    <div class="centerclass">
        <span class="glyphicon glyphicon-ok col-xs-12"></span>
    </div>
    <div class="texts-xs col-xs-12">
        <h2>报名成功！</h2>

        <p class="msg-body">
            关注“团团一家”微信号（e-tuan），<br>赢取奖品，更多报名等着你！
            <a href="http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202239029&idx=1&sn=b1cb7de21413986193491c008b0d5435#rd">
                立即关注>>
            </a>
        </p>

        <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-warning btn-lg btn-xsmall btn-lottery">点击抽奖</button>
        </div>
        <br>

        <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-info btn-lg btn-xsmall btn-more">更多报名</button>
        </div>
    </div>
    <div class="col-xs-12">
        <img class="img-prize-xs" src="/img/choujiang/prize_vertical.jpg">
    </div>
    <div class="centerclass col-xs-12 img-xs">
        <img src="http://img.kyfly.net/common/qrcode/wx-etuan.jpg@220w_220h.jpg" width="220px" height="220px">
        <h4 class="text-center">扫码关注 微信号e-tuan</h4>
    </div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">您未关注团团一家</h4>
            </div>
            <div class="modal-body">
                <p>您需要关注团团一家（微信号：e-tuan)，才可以参与抽奖和更多报名！</p>

                <p class="visible-xs">点击“立即关注”，进入关注页面。</p>

                <div class="centerclass col-xs-12 img-xs hidden-xs">
                    <img src="http://img.kyfly.net/common/qrcode/wx-etuan.jpg@220w_220h.jpg" width="220px"
                         height="220px">
                    <h4 class="text-center">扫码关注 微信号e-tuan</h4>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <a href="http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202239029&idx=1&sn=b1cb7de21413986193491c008b0d5435#rd"
                   type="button" class="btn btn-primary visible-xs-inline">立即关注</a>
            </div>
        </div>
    </div>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script>

    function isWeiXin() {
        var ua = window.navigator.userAgent.toLowerCase();
        return ua.match(/MicroMessenger/i) == 'micromessenger';
    }

    $(document).ready(function () {
        var isSub = false;
        $.get('/oauth/checksub', function (data, status) {
            if (status == 'success') {
                if (data == '1')
                    isSub = true;
            }
        });

        $('.btn-lottery').click(function () {
            if (!isSub) {
                $('#msgModal').modal();
            }
            else {
                if (isWeiXin())
                    window.location.href = '/jiang/1';
                else
                    alert("您已关注团团一家，请在微信中点击“招新季”菜单抽奖！");
            }
        });

        $('.btn-more').click(function () {
            if (!isSub) {
                $('#msgModal').modal();
            }
            else {
                if (isWeiXin())
                    window.location.href = '/baoming.html?from=e-tuan';
                else
                    window.location.href = '/baoming.html';
            }
        });

    })
</script>
</body>
</html>
