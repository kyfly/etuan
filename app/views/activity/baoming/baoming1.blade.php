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
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
        }

        .bold-label {
            font-weight: bold;
        }
        #titlelogo{
            width:120px; height:120px; margin-top:20px;
        }
        #useravatar {
            width: 30px;
            height: 30px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-xs-12 text-center"
         style="background-color: rgba(255,255,255,0.5)">
        <div id="titlearea">
            <h2 id="title"></h2>
        </div>
        <hr>
        <div id="infoarea">
            <p id="userinfo">
                <img id="useravatar" src="{{{Weixin::info()->headimgurl}}}" class="img-circle"/>
                &ensp;{{{Weixin::info()->nick_name}}}&ensp;
                <a id="logout" class="btn btn-default" href="/weixin/login/quit">
                    <span class="glyphicon glyphicon-log-out" style="vertical-align: middle"></span>
                    退出
                </a>
            </p>
            <p id="timeinfo"></p>
            <a id="orginfo" href="javascript:void(0)" target="_blank">想了解更多关于社团的信息？请点击这里</a>
        </div>
        <hr>
    </div>
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12"
         style="background-color: rgba(255,255,255,0.5)">
        <form class="form-horizontal" role="form">
            <div id="regform">
                <!--表项-->
            </div>
            <div class="form-group">
                <br>
                <div id="regbutton" class="col-xs-12">
                    <button type="button" id="submit" class="btn btn-lg btn-block btn-danger">
                        <span class="glyphicon glyphicon-envelope"></span>&ensp;提交
                    </button>
                </div>
            </div>
            <div class="form-group">
                <hr>
                <div id="regfooter">
                    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    _activityId = {{$activityId }};
    _stuId = {{Weixin::info()->stu_id}};
    _stuName = '{{Weixin::info()->stu_name}}';
    _IsTime = {{$isTime}};
    _IsGrade = {{$isGrade}};
</script>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/baomingpage1.js"></script>
<script src="/js/baoming1.js"></script>
<script></script>

</body>
</html>