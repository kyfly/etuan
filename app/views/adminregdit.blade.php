<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>社团管理员注册</title>
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
        background: url(<?php echo URL::to('img/bg.gif')?>);
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
        border: 1px solid #e5e5e5;
        background-color: #fff;
    }

    .nav-pills > li > a {
        border-radius: 0;
        text-align: center;
    }

    a:focus, a:active, a:hover {
        outline: none;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .errorspan {
        padding-top: 7px;
        color: #bb4442;
    }

    .form-control-feedback {
        right: -20px !important;
    }

    .glyphicon-ok {
        top: 0 !important;
    }

    .addimgtxt {
        height: 70px;
        border: 2px dotted #ddd;
        text-align: center;
        font-size: 50px;
        line-height: 65px;
        color: #b2b2b2;
        cursor: pointer;
    }

    .addimgtxt:hover {
        color: #373636;
    }

    .hidespan {
        display: none;
    }
</style>
<body>
<!--头部-->
<header id="nav">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse"
                            type="button">
                        <span class="hidespan">导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h5>
                        <a href="index.html">
                            <img src="../img/brand.png">
                        </a>
                    </h5>
                </div>
                <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="index.html">首页</a>
                        </li>
                        <li>
                            <a href="#">报名</a>
                        </li>
                        <li>
                            <a href="#">抢票</a>
                        </li>
                        <li>
                            <a href="#">投票</a>
                        </li>
                        <li>
                            <a href="#">抽奖</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="container" id="mainHeight">
<div class="field clearfix">
<p class="headtitle">社团管理员注册</p>
<hr>
<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked" role="tablist">
        <li class="active"><a href="#newid" role="pill" data-toggle="pill" id="next1-1">1. 创建账号</a></li>
        <li><a href="#shetuaninfo" role="pill" data-toggle="pill" id="next1-2">2. 社团信息</a></li>
        <li><a href="#bumeninfo" role="pill" data-toggle="pill" id="next1-3">3. 部门简介</a></li>
    </ul>
</div>
<form class="form-horizontal" role="form" method="post" action="register" enctype="multipart/form-data">
<div class="tab-content col-xs-9">
<!--创建账号-->
<div class="tab-pane fade active in" id="newid">
    <div class="form-group has-feedback" id="inputbox1">
        <label for="inputEmail" class="col-sm-2 control-label">电子邮箱</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputEmail" name="email">
            <span id="span1" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span1-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
        <span id="span1-2" class="col-sm-4 errorspan  hidespan">邮箱格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox2">
        <label for="inputPassword" class="col-sm-2 control-label">密码</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword" name="password">
            <span id="span2" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span2-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请输入6-16位非空格字符</span>
        </div>
        <span id="span2-2" class="col-sm-4 errorspan  hidespan">密码格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox3">
        <label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword2">
            <span id="span3" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span3-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
        <span id="span3-2" class="col-sm-4 errorspan  hidespan">两次输入密码不一致</span>
    </div>
    <div class="form-group has-feedback" id="inputbox4">
        <label for="inputPhone" class="col-sm-2 control-label">手机号码</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputPhone" name="phone_long">
            <span id="span4" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span4-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请输入11位手机号码</span>
        </div>
        <span id="span4-2" class="col-sm-4 errorspan  hidespan">手机号码格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox5">
        <label for="inputPhone2" class="col-sm-2 control-label">移动短号</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputPhone2" name="phone_short">
            <span id="span5" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span5-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">移动用户请输入6位短号（选填）</span>
        </div>
        <span id="span5-2" class="col-sm-4 errorspan  hidespan">短号格式不正确</span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next1" type="button" class="btn btn-primary btn-lg">下一步</button>
        </div>
    </div>
</div>
<!--社团介绍-->
<div class="tab-pane fade" id="shetuaninfo">
    <div class="form-group has-feedback" id="inputbox6">
        <label for="inputShetuan" class="col-sm-2 control-label">社团名称</label>

        <div class="col-sm-6">
            <input name="name" type="text" class="form-control" id="inputShetuan">
            <span id="span6-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputType" class="col-sm-2 control-label">类别</label>

        <div class="col-sm-6">
            <select class="form-control" id="inputType" name="type">
                <option id="xiaojioption" value="1">校级组织</option>
                <option value="2">院级组织</option>
                <option value="3">校级社团</option>
                <option value="4">院级社团</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputXueyuan" class="col-sm-2 control-label">所属学院</label>

        <div class="col-sm-6">
            <select name="school" class="form-control" id="inputXueyuan">
                <option value="1"></option>
                <option value="全校">全校</option>
                <option value="机械工程学院">机械工程学院</option>
                <option value="电子信息学院">电子信息学院</option>
                <option value="通信工程学院">通信工程学院</option>
                <option value="自动化学院">自动化学院</option>
                <option value="计算机学院">计算机学院</option>
                <option value="生命信息与仪器工程学院">生命信息与仪器工程学院</option>
                <option value="材料与环境工程学院">材料与环境工程学院</option>
                <option value="软件工程学院">软件工程学院</option>
                <option value="理学院">理学院</option>
                <option value="经济学院">经济学院</option>
                <option value="管理学院">管理学院</option>
                <option value="会计学院">会计学院</option>
                <option value="外国语学院">外国语学院</option>
                <option value="数字媒体与艺术设计学院">数字媒体与艺术设计学院</option>
                <option value="人文与法学院">人文与法学院</option>
                <option value="马克思主义学院">马克思主义学院</option>
                <option value="卓越学院">卓越学院</option>
                <option value="信息工程学院">信息工程学院</option>
                <option value="国际教育学院">国际教育学院</option>
                <option value="继续教育学院">继续教育学院</option>
            </select>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox7">
        <label for="inputIntro" class="col-sm-2 control-label">社团介绍</label>

        <div class="col-sm-6">
            <textarea id="inputIntro" name="description" class="form-control" rows="7"></textarea>
            <span id="span7-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">200字以内</span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox8">
        <label for="inputWeixin" class="col-sm-2 control-label">微信公众号</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputWeixin">
            <span id="span8-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">（选填）</span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox9">
        <label for="inputLogo" class="col-sm-2 control-label">上传logo</label>

        <div class="col-sm-6">
            <input name="logo" type="file" id="inputLogo">
            <span id="span9-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox10">
        <label for="inputPic1" class="col-sm-2 control-label">展示照片1</label>

        <div class="col-sm-6">
            <input name="pic1" type="file" id="inputPic1">
            <span id="span10-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox11">
        <label for="inputPic2" class="col-sm-2 control-label">展示照片2</label>

        <div class="col-sm-6">
            <input name="pic2" type="file" id="inputPic2">
            <span id="span11-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox12">
        <label for="inputPic3" class="col-sm-2 control-label">展示照片3</label>

        <div class="col-sm-6">
            <input name="pic3" type="file" id="inputPic3">
            <span id="span12-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next2" type="button" class="btn btn-primary btn-lg">上一步</button>
            <button id="next3" type="button" class="btn btn-primary btn-lg col-sm-offset-1">下一步</button>
        </div>
    </div>
</div>
<!--部门简介-->
<div class="tab-pane fade" id="bumeninfo">
    <div id="addablebox">
        <div class="form-group">
            <label class="col-sm-2 control-label">部门名称</label>

            <div class="col-sm-6">
                <input type="text" class="form-control" name="department_name[]">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">部门介绍</label>

            <div class="col-sm-6">
                <textarea class="form-control"  name="department_description[]" rows="3"></textarea>
                <span class="help-block">50字以内</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-6">
            <div id="minuselement" class="addimgtxt col-sm-5" onMouseOver="this.style.border='2px dotted #ccc'"
                 onMouseOut="this.style.border='2px dotted #ddd'">
                -
            </div>
            <div id="addelement" class="addimgtxt col-sm-5 col-sm-offset-2"
                 onMouseOver="this.style.border='2px dotted #ccc'"
                 onMouseOut="this.style.border='2px dotted #ddd'">
                +
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next4" type="button" class="btn btn-primary btn-lg">上一步</button>
            <button type="submit" class="btn btn-warning btn-lg col-sm-offset-1">完成注册</button>
        </div>
    </div>
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
<script src="<?php echo URL::to('js/adminregdit.js');?>"></script>
</body>
</html>
