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
                                <textarea class="form-control" name="department_description[]" rows="3"></textarea>
                                <span class="help-block">50字以内</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                            <div id="minuselement" class="addimgtxt col-sm-5"
                                 onMouseOver="this.style.border='2px dotted #ccc'"
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
                            <button type="submit" class="btn btn-warning btn-lg">提交</button>
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