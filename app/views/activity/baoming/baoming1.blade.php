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
        	}
		.control-label {
			font-weight: bold;
			}
        @media (min-width: 320px){
            body {
                background-image: url(../imgre23/baoming1bg.jpg);
                background-repeat:no-repeat;
                background-position:center;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-lg-6 col-lg-of6fset-3 col-md-6 col-md-offset-3 col-xs-12 text-center" style="background-color: rgba(255,255,255,0.5)">
        <img id="logo" src="../img/avatar.jpg" class="img-circle" style="width:100px; height:100px; margin-top:20px;margin-bottom:20px">
        <h3 id="title"></h3>
        <hr>
    </div>
    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="background-color: rgba(255,255,255,0.5)">
        <form class="form-horizontal" role="form">
            <div id="regform">
            <!--表项-->
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-offset-10 col-xs-offset-4 col-xs-8">
                    <button id="submit" type="submit" class="btn btn-lg btn-danger">我要提交 <span class="glyphicon glyphicon-envelope"></span></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../js/baomingpage.js"></script>
<script src="../js/baoming1.js"></script>
<script>_activityId = 0;</script>
</body>
</html>