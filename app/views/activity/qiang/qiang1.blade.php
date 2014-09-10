<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css"/>
    <title>杭电20M闪讯免费抢！</title>
    <!--[if lt IE 9]>
    <script>
        document.write('<h2>您的浏览器版本过低</h2><p>本网站不支持IE8及以下版本，请更换浏览器！</p><p>若已使用高版本浏览器，请关闭兼容模式。</p>');
        document.execCommand("stop");
    </script>
    <![endif]-->
    <style>
        body {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
        }

        body {
            background: black url("<?php echo URL::asset('/img/qiang/time_sm.jpg')?>");
            background-position: 50% 0%;
            background-repeat: no-repeat;
            background-size: 120% auto;
        }

        @media (min-width: 768px) {
            body {
                background: black url("<?php echo URL::asset('/img/qiang/time_lg.jpg')?>");
                background-position: 50% 30%;
                background-repeat: no-repeat;
                background-size: cover;
            }
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?18a33d5e0bee3d92c20e7173809e5cb4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top" style="height: 40px;" id="snoBar">
    <div class="container-fluid">
        <div class="navbar-header">
            <p class="navbar-brand">他们抢到啦:</p>

            <p class="navbar-text" style="color: #ffffff">
                <marquee Width="1000px" behavior="scroll" onMouseOut="this.start()" onMouseOver="this.stop()"
                         id="snoList">
                    现在还没有人抢到！
                </marquee>
            </p>
        </div>
    </div>
</div>

<div class="container" style="margin-top:2%">
    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12"
         style="margin-top:1%">
        <form class="form-horizontal" style="margin-top: 100px">
            <div class="form-group">
                <div class="text-center"><img src="/img/qiang/shanxun.png" alt="时光之书LOGO" class="img-circle"/></div>
            </div>
            <div class="form-group">
                <h3 class="text-center" style="color: #ffffff;">杭电20M闪讯免费抢</h3>
            </div>
            <div>
                <div class="form-group" id="msgBig">
                    <h3 class="text-center" style="color:white;">9月10日 21:00 开抢</h3>
                </div>
                <div class="form-group" id="msgSmall">
                    <h5 class="text-center" style="color: #ffffff;">当前学号：-------- <a href="javascript:void(0)">更改</a>
                    </h5>
                </div>
                <div class="form-group" id="btnDiv">
                    <div class="col-xs-10 col-xs-offset-1">
                        <button type="button" class="btn btn-block btn-warning" disabled="disabled" id="btnGetTicket">即将开始</button>
                    </div>
                </div>
                <div class="form-group" id="divReg">
                    <div class="input-group col-xs-10 col-xs-offset-1">
                        <input type="text" class="form-control" id="inputStuId" placeholder="请输入您的学号"
                               style="background-color: transparent; color: #ffffff">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" id="btnReg">进入</button>
                    </span>
                    </div>
                </div>
            </div>
        </form>
        <div>
            <a href="http://www.kyfly.net/wx/buy.html">
                <p class="text-center myft" style="margin-top:5%;color:white">
                    <strong>杭电电信工作室提供赞助</strong>
                </p>
            </a>
        </div>
    </div>
</div>
<script>
    <?php $sxInfo = DB::table('ticket_1')->where('wx_uid', Weixin::user())->first(); ?>
    var ticketId = 1;
    var wordSorry = "9月12日和13日还有哦~~";
    var wordGet = "帐号：{{$sxInfo->shanxun_id}} 密码：{{$sxInfo->shanxun_pwd}}";
    var stuId = {{Weixin::info()->stu_id}};
</script>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="/js/getTicket.js"></script>
</body>
</html>