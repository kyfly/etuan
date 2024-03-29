<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>管理员注册</title>
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
            font-size: 80px;
            color: #009900;
        }

        .texts {
            text-align: left;
        }

        .p1 {
            font-size: 25px;
        }

        @media screen and (min-width: 1300px) {
            .texts {
                text-align: center;
            }

            .centerclass {
                text-align: right;
            }

            .centerclass > .glyphicon-ok {
                font-size: 80px;
                color: #009900;
                margin-top: 30px;
            }
        }
    </style>
</head>
<body>
<!--头部-->
@include('layout.nav')
<div class="container" id="mainHeight">
<div class="field clearfix">
    <div class="centerclass">
    	<span class="glyphicon glyphicon-ok col-xs-12 col-md-3"></span>
    </div>
    <div class="texts col-md-9 col-xs-12">
  		<br class="visible-xs-block">
   	    <h1 class="hidden-xs">恭喜您，注册成功！</h1>
        <p class="visible-xs-block p1">恭喜您<br>注册成功！</p>
		<h4 class="hidden-xs"><br>我们已经为您自动生成了美美的介绍页面</h4>
        <p class="visible-xs-block">我们已经为您自动生成了美美的介绍页面</p>
		<a href="/shetuan/{{$org_id}}" target="_blank" class="hidden-xs"><h4>快来看看吧>></h4></a><br>
        <a href="/shetuan/{{$org_id}}" target="_blank" class="visible-xs-block p2">快来看看吧>></a><br>
        <a href="/admin/home" class="btn btn-primary btn-lg">进入管理后台</a>
    </div>
</div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">©2014&nbsp;杭电麒飞软件团队&nbsp;Kyfly&nbsp;Team</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
});
</script>
</body>
</html>
