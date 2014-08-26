<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::to('css/admin.css')}}" rel="stylesheet">
    <link href="{{URL::to('css/adminreg.css')}}" rel="stylesheet">
    <title>“团团一家”管理后台</title>
</head>
<body>
<nav id="nav" class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-collapse">
                    <span class="sr-only">导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a><img src="../../img/brand.png" id="brandpic"></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a><img id="avatar" class="img-circle" src="../../img/avatar.jpg"> 用户</a></li>
                    <li><a><span class="glyphicon glyphicon-off"></span>退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
    <div class="adminField clearfix">
        <!--侧边栏-->
        <div id="sidebar" class="col-lg-3 col-md-3"></div>
        <!--主体-->

        <div id="main" class="col-lg-9 col-md-9">
            <div class="tab-content">
                <form method="post" class="form-horizontal">
                    <div class="tab-pane fade active in" id="newid">
                        <div class="form-group has-feedback" id="inputbox1">
                            <label for="inputEmail" class="col-sm-2 control-label">电子邮箱</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputEmail" name="email" disabled="disabled">
                                    <span id="span1"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span1-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            </div>
                            <span id="span1-2" class="col-sm-4 errorspan  hidespan">邮箱格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox2">
                            <label for="inputPassword" class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword" name="password">
                                    <span id="span2"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span2-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">请输入6-16位非空格字符</span>
                            </div>
                            <span id="span2-2" class="col-sm-4 errorspan  hidespan">密码格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox3">
                            <label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>

                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword2">
                                    <span id="span3"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span3-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            </div>
                            <span id="span3-2" class="col-sm-4 errorspan  hidespan">两次输入密码不一致</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox4">
                            <label for="inputPhone" class="col-sm-2 control-label">手机号码</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputPhone" name="phone_long">
                                    <span id="span4"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span4-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">请输入11位手机号码</span>
                            </div>
                            <span id="span4-2" class="col-sm-4 errorspan  hidespan">手机号码格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox5">
                            <label for="inputPhone2" class="col-sm-2 control-label">移动短号</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputPhone2" name="phone_short">
                                    <span id="span5"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span5-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">移动用户请输入6位短号（选填）</span>
                            </div>
                            <span id="span5-2" class="col-sm-4 errorspan  hidespan">短号格式不正确</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-primary btn-lg">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--tab-content-->
        </div>
        <!--col-md-9-->
    </div>
    <!--container-->

</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/adminregdit.js"></script>
</body>
</html>