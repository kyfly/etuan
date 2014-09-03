<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css"/>
    <title></title>
    <style>
        body {
            font-family: "Hiragino Sans GB","Microsoft YaHei","微软雅黑",tahoma,arial,simsun,"宋体";
            background-color: #ccc;
        }
        .no-padding {
            padding: 0;
        }
        .cover {
            font-size: 64px;
            text-align: center;
            color: #fff;
        }
		.blank {
			font-size: 36px;
			text-align:left;
			color:#000;
			background-color:#fff;
		}
		.single-line {
			height: 100px;
		}
		.double-line {
			height: 200px;
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
    </style>
</head>
<body>
<div class="container no-padding">
    <div class="col-xs-12 no-padding double-line cover" style="background-color: #f06">
        <p id="title"></p>
    </div>
    <div id="regform">
    <!--表项-->
    </div>
    <div id="submit" class="col-xs-12 no-padding single-line cover" style="background-color: #fff;color:#6f6">
        <span class="glyphicon glyphicon-envelope"></span>
        提交
    </div>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../js/baomingpage.js"></script>
<script src="../js/baoming2.js"></script>
<script>_activityId = 0;</script>
</body>
</html>