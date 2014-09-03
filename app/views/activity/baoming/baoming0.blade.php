<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css"/>
    <title></title>
    <style>
        body{
            font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
            background-color: #494949;
        }
        .dark-blank{ background-color: #444; }
        .light-blank{ background-color: #555; }
        .single-line{ height: 100px; }
        .double-line{ height: 200px; }
        .triangle{
            position: absolute;
            top: 30px;
            left: 0px;
            width:0; height:0;
            line-height: 0;
            border-color: transparent;
            border-style: dashed dashed dashed solid;
            border-width: 20px
        }
        .left-tag{
            margin-top: 30px;
            color: #ffffff;
            font-size: 30px;
            text-align: center;
            vertical-align: middle;
        }
        .intro-single-input{
            position: absolute;
            top: 25px;
            left: 40px;
            height: 50px;
            width: 80%;
        }
        .intro-double-input{
            position: absolute;
            top: 25px;
            left: 40px;
            height: 150px;
            width: 80%;
        }
        .no-padding{
            padding: 0;
        }
        .transparent-div{
            background-color: rgba(0,0,0,0);
            color: #cccccc;
        }
    </style>
</head>
<body>
<div class="container no-padding">
    <div class="col-xs-12 light-blank double-line">
        <p id="title" class="left-tag" style="margin-top: 80px">标题</p>
    </div>
    <div id="regform" class="clearfix">
    <!--表项-->
    </div>
    <div id="regbutton" class="col-xs-12 single-line no-padding text-center">
        <button type="button" id="submit" class="btn btn-danger btn-lg" style="width:60%;margin-top: 20px">
            <h4>我要提交 <span class="glyphicon glyphicon-envelope"></span></h4>
        </button>
    </div>
    <div id="regfooter" class="col-xs-12 single-line no-padding">
        <p class="left-tag" style="margin-top: 30px">团团一家</p>
    </div>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../js/baomingpage.js"></script>
<script src="../js/baoming0.js"></script>
<script>_activityId = 0;</script>
</body>
</html>