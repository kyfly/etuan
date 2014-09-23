<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css"/>
    <title></title>
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
    <style>
        body {
            font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
            background-color: #ccc;
        }
        .no-padding {
            padding: 0;
        }
        .intro-single-input {
            border-width:0;
            height: 100px;
            width: 100%;
        }
        .intro-double-input {
            border-width:0;
            height: 200px;
            width: 100%;
        }

        @media (min-width: 1366px) {
            .intro-single-input {
                border-width:0;
                height: 100px;
                width: 100%;
            }
            .intro-double-input {
                border-width:0;
                height: 200px;
                width: 100%;
            }
            .cover {
                font-size: 60px;
                text-align: center;
                color: #fff;
            }

            .blank {
                font-size: 40px;
                text-align: left;
                color: #000;
                background-color: #fff;
            }

            .single-line {
                height: 100px;
            }

            .double-line {
                height: 200px;
            }

            #title {
                margin-top: 60px;
                font-size: 50px;
            }

            #titlelogo {
                width: 70px;
                height: 70px;
                vertical-align: middle
            }

            #infoarea {
                font-size:25px;
            }

            #userinfo{margin-top: 30px}

            #useravatar {
                width: 35px;
                height:35px;
                vertical-align: middle
            }
        }
        @media (max-width: 1365px){
            .cover {
                font-size: 30px;
                text-align: center;
                color: #fff;
            }

            .blank {
                font-size: 20px;
                text-align: left;
                color: #000;
                background-color: #fff;
            }

            .single-line {
                height: 50px;
            }

            .double-line {
                height: 100px;
            }
            .intro-single-input {
                border-width:0;
                height: 50px;
                width: 100%;
            }
            .intro-double-input {
                border-width:0;
                height: 100px;
                width: 100%;
            }
            #infoarea {
                font-size: 12px;
            }

            #userinfo{
                margin-top: 10px;
                font-size: 18px;
            }

            #title {
                margin-top: 25px;
                font-size: 30px;
            }

            #titlelogo {
                width: 40px;
                height: 40px;
                vertical-align: middle;
            }

            #useravatar {
                width: 30px;
                height: 30px;
                vertical-align: middle;
            }
        }
    </style>
</head>
<body>
<div class="container no-padding">
    <div id="titlearea" class="col-xs-12 no-padding double-line cover" style="background-color: #66f">
        <p id="title"></p>
    </div>
    <div id="infoarea" class="col-xs-12 no-padding double-line cover" style="background-color: #fff;color:#000">

        <p id="userinfo">
            <img id="useravatar" src="{{{Weixin::info()->headimgurl}}}" class="img-circle"/>
            &ensp;{{{Weixin::info()->nick_name}}}&ensp;
            <a id="logout" href="/weixin/login/quit">
                <span class="glyphicon glyphicon-log-out" style="vertical-align: middle"></span>
                退出
            </a>
        </p>
        <p id="timeinfo"></p>
        <a id="orginfo" href="javascript:void(0)" target="_blank">想了解更多信息？请点击这里</a>

    </div>
    <div id="regform">
    <!--表项-->
    </div>
    <div class="col-xs-12 no-padding single-line" style="background-color: #fff">
    </div>
    <div id="regbutton" class="col-xs-12 no-padding single-line cover" style="background-color: #66f;color:#fff">
        <button id="submit" style="height:100%;width:100%;background-color:rgba(0,0,0,0);border-width:0px">
            【&ensp;<span class="glyphicon glyphicon-envelope" style="vertical-align: middle"></span>&ensp;提交！&ensp;】
        </button>
    </div>
    <div class="col-xs-12 no-padding single-line" style="background-color: #fff">
    </div>
    <div id="regfooter" class="col-xs-12 no-padding cover" style="height: 100px;background-color: #fff;color:#000">
        <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
    </div>
</div>

<script>
    _activityId = {{$activityId }};
    _stuId = {{Weixin::info()->stu_id}};
    _stuName = '{{Weixin::info()->stu_name}}'
    _IsTime = {{$isTime}};
    _IsGrade = {{$isGrade}};
</script>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/baomingpage1.js"></script>
<script src="/js/baoming2.js"></script>

</body>
</html>