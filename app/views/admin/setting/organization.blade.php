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
                            <button type="submit" class="btn btn-primary btn-lg">提交</button>
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