<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>绑定学号</title>
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
            padding-top: 70px;
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

        .centerclass > .glyphicon-user {
            margin-top: 60px;
            font-size: 100px;
            color: #555555;
        }

        .texts {
            text-align: left;
        }

        .bindingTitle {
            margin-bottom: 20px;
        }

        .p1 {
            font-size: 25px;
        }

        .visible-in-xs {
            background-color: #ffffff !important;
        }

        .img-md{
            margin-top: 30px;
        }

        .btn-xsmall{
            width: 100%;
        }
    </style>
</head>
<body>
<!--头部-->
@include('layout.nav')
<div class="container mainHeight hidden-xs">
    <div class="field clearfix">
        <div class="centerclass">
            <span class="glyphicon glyphicon-user col-md-5 img-md"></span>
        </div>
        <div class="texts col-md-6">
            <h2 class="col-sm-offset-2 col-sm-10 bindingTitle">绑定学号</h2>
            <form class="form-horizontal" role="form" action="stuinfo" method="post">
                <div class="form-group">
                    <label for="inputSno" class="col-sm-2 control-label">学号</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputSno" name="stu_id" placeholder="请输入您的学号">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="stu_name" placeholder="请输入您的姓名">
                        <p class="help-block">
                            请填写<strong>本人</strong>的学号和姓名，这是领取活动奖品的唯一依据，绑定后无法修改和解绑！
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mainHeight visible-xs-block visible-in-xs">
    <div class="centerclass">
        <span class="glyphicon glyphicon-user col-xs-12"></span>
    </div>
    <br>
    <div class="texts col-xs-12">
        <br>

        <p class="p1 text-center">绑定学号</p>

        <form class="form-horizontal" role="form" action="stuinfo" method="post">
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="stu_id" placeholder="学号">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="stu_name" placeholder="姓名">
                    <p class="help-block">
                        请填写<strong>本人</strong>的学号和姓名，这是领取活动奖品的唯一依据，绑定后无法修改和解绑！
                    </p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-xsmall">提交</button>
                </div>
            </div>
        </form>
    </div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
</body>
</html>
