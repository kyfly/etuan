<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css"/>
    <title></title>
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
                <img id="useravatar" src="/img/avatar.jpg" class="img-circle"/>
                &ensp;团团一家&ensp;12345678&ensp;
                <a id="logout" class="btn btn-default" href="javascript:void(0)">
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
                    <button id="submit" class="btn btn-lg btn-block btn-danger">
                        <span class="glyphicon glyphicon-envelope"></span>&ensp;提交
                    </button>
                </div>
            </div>
            <div class="form-group">
                <hr>
                <div id="regfooter">
                    <p style="text-align: center"><img src="/img/footer.png" alt="团团一家|红色家园 联合出品"></p>
                </div>
            </div>
        </form>
    </div>
</div>

<script>_activityId=0;</script>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/baomingpage.js"></script>
<script src="/js/baoming1.js"></script>
<script></script>

</body>
</html>