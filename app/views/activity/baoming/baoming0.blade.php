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
            background-color: #494949;
        }

        .dark-blank {
            background-color: #444;
        }

        .light-blank {
            background-color: #555;
        }

        .single-line {
            height: 100px;
        }

        .double-line {
            height: 200px;
        }

        .triangle {
            position: absolute;
            top: 30px;
            left: 0px;
            width: 0;
            height: 0;
            line-height: 0;
            border-color: transparent;
            border-style: dashed dashed dashed solid;
            border-width: 20px
        }

        @media (min-width: 1366px) {
            .left-tag {
                margin-top: 30px;
                color: #ffffff;
                font-size: 30px;
                text-align: center;
            }
            #title {
                margin-top: 60px;
                font-size: 50px;
            }

            #titlearea {
                height: 200px;
            }

            #titlelogo {
                width: 60px;
                height: 60px;
                vertical-align: middle
            }

            #infoarea {
                height: 200px;
                font-size: 25px;
            }

            #timeinfo{
                margin-top: 20px;
                font-size: 25px;
            }

            #userinfo {
                margin-top: 30px;
                font-size: 30px;
            }

            #useravatar {
                width: 40px;
                height: 40px;
                vertical-align: middle
            }

            #regform {
                margin-top: 400px;
            }
        }

        @media (max-width: 1365px) {
            .left-tag {
                margin-top: 30px;
                color: #ffffff;
                font-size: 15px;
                text-align: center;
            }

            #title {
                font-size: 20px;
            }

            #titlearea {
                height: 100px;
            }

            #titlelogo {
                width: 40px;
                height: 40px;
                vertical-align: middle;
            }

            #infoarea {
                height: 100px;
                font-size: 12px;
            }

            #userinfo {
                margin-top: 5px;
                font-size: 18px;
            }
            #timeinfo{
                margin-top: 10px;
                font-size: 12px;
            }

            #useravatar {
                width: 30px;
                height: 30px;
                vertical-align: middle;
            }

            #regform {
                margin-top: 200px;
            }
        }

        .intro-single-input {
            position: absolute;
            top: 25px;
            left: 40px;
            height: 50px;
            width: 80%;
        }

        .intro-double-input {
            position: absolute;
            top: 25px;
            left: 40px;
            height: 150px;
            width: 80%;
        }

        .no-padding {
            padding: 0;
        }

        .transparent-div {
            background-color: rgba(0, 0, 0, 0);
            color: #ccc;
        }
    </style>
</head>
<body>
<div class="container no-padding">
    <div id="titlearea" class="col-xs-12 dark-blank" style="text-align: center">
        <p id="title" class="left-tag"></p>
    </div>
    <div id="infoarea" class="col-xs-12 light-blank">
        <p id="userinfo" class="left-tag">
            <img id="useravatar" src="{{{Weixin::info()['headimgurl']}}}" class="img-circle"/>
            &ensp;{{{Weixin::info()->nick_name}}}&ensp;
            <a id="logout" class="transparent-div" href="/weixin/login/quit">
                <span class="glyphicon glyphicon-log-out" style="vertical-align: middle"></span>
                退出
            </a>
        </p>
        <p id="timeinfo" class="left-tag"></p>
        <p class="text-center"><a id="orginfo" href="javascript:void(0)" target="_blank">想了解更多信息？请点击这里</a></p>
    </div>
    <div id="regform" class="clearfix">
    <!--表项-->
    </div>
    <div id="regbutton" class="col-xs-12 single-line no-padding text-center" style="color: #fff;font-size: 30px">
        <button type="button" id="submit" class="btn btn-danger btn-lg" style="width:60%;margin-top: 20px">
            <h4><span class="glyphicon glyphicon-envelope" style="vertical-align: middle"></span>&ensp;提交</h4>
        </button>
    </div>
    <div id="regfooter" class="col-xs-12 single-line no-padding" style="color: #fff">
        <h4 class="text-center"><a href="http://www.etuan.org/"><img src="http://img.kyfly.net/common/logo/etuan-logo-word.png@40h.png" height="20px"></a>
                &nbsp;提供技术支持</h4>
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
<script src="/js/baoming0.js"></script>

</body>
</html>