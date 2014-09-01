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
            padding-top: 100px;
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
        }

        .p1 {
            font-size: 25px;
        }

        .visible-in-xs {
            background-color: #ffffff !important;
            padding-top: 50px;
        }

        .img-md{
            margin-top: 30px;
        }

        @media screen and (min-width: 1300px) {
            .texts {
                text-align: center;
            }

            .centerclass {
                text-align: right;
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
        <div class="centerclass">
            <span class="glyphicon glyphicon-exclamation-sign col-md-3 img-md msg-status"></span>
        </div>
        <div class="texts col-md-9">
            <h1 class="msg-title"></h1>

            <h3 class="msg-body"></h3>
            <br>
            <button type="button" class="btn btn-primary btn-lg msg-btn">页面跳转中...</button>
        </div>
    </div>
</div>

<div class="container mainHeight visible-xs-block visible-in-xs">
    <div class="centerclass">
        <span class="glyphicon glyphicon-exclamation-sign col-xs-12 msg-status"></span>
    </div>
    <br>
    <div class="texts col-xs-12">
        <br>

        <p class="p1 msg-title"></p>

        <p class="msg-body"></p>
        <br>
        <button type="button" class="btn btn-primary btn-lg msg-btn">页面跳转中...</button>
    </div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script>
    var messageArr = {};
    @foreach($messageArr as $msgKey => $msgValue)
        messageArr.{{$msgKey}} = '{{$msgValue}}';
    @endforeach
    $(document).ready(function () {
        $('.mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
        $('.msg-title').text(messageArr.title);
        $('.msg-body').text(messageArr.body);
        var msgBtn = $('.msg-btn');
        var msgStatus = $('.msg-status');
        if (messageArr.status == 'ok')
        {
            msgStatus.removeClass('glyphicon-exclamation-sign');
            msgStatus.addClass('glyphicon-ok');
        }
        else
        {
            msgStatus.removeClass('glyphicon-ok');
            msgStatus.addClass('glyphicon-exclamation-sign');
        }
        if (messageArr.btn == 'false')
            msgBtn.hide();
        if (messageArr.url)
        {
            setTimeout(function(){
                window.location = messageArr.url;
            }, 5000);

            msgBtn.click(function() {
                window.location = messageArr.url;
            });
        }
        else
            switch (messageArr.action)
            {
                case 'back':
                    msgBtn.click(function() {
                        history.back();
                    });
                    msgBtn.text('返回');
                    break;
                case 'wclose':
                    msgBtn.click(function() {
                        WeixinJSBridge.call('closeWindow');
                    });
                    msgBtn.text('关闭');
                    break;
            }
    });
</script>
</body>
</html>
