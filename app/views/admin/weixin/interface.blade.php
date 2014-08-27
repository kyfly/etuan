<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/admin.css" rel="stylesheet">
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
                <a><img src="../../../img/brand.png" id="brandpic"></a>
            </div>
            <div class="collapse navbar-collapse" id="nav-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a><img id="avatar" class="img-circle" src="../../../img/avatar.jpg"> 用户</a></li>
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

    <div id="main" class="col-lg-9 col-md-9">
        <h3>微信接口</h3>
        <hr>
        <div class="col-sm-1 textToCopyLabel">URL</div>
        <div class="col-sm-8 textToCopy" id="interfaceUrl">
            加载中...
        </div>
        <div class="col-sm-2">
            <button id="btnCopyUrl" class="btn btn-primary btn-sm">复制</button>
        </div>
        <br>
        <br>
        <div class="col-sm-1 textToCopyLabel">Token</div>
        <div class="col-sm-8 textToCopy" id="interfaceToken">
            加载中...
        </div>
        <div class="col-sm-2">
            <button id="btnCopyToken" class="btn btn-primary btn-sm">复制</button>
        </div>
        <br>
        <br>
        <h3>使用说明</h3>
        <hr>
        <h4>什么是微信接口？</h4>
        <p>
            很简单，微信接口就是让你的公众号变的高大上的东西！那些功能丰富多彩的公众号，都是依靠接口实现的。<br>
            团团一家为您<strong>免费</strong>提供了接口！
            只要按照下面的提示绑定接口，就可以<strong>一键添加报名表</strong>到公众号，然后用户就可以通过你的公众号报名了！
        </p>
    </div>
</div>
</div>

<footer id="footer" class="panel-footer margintop">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../../js/admin.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('/weixin/org/show-mp', function(data, status) {
            if (status == 'success')
            {
                data = data[0];
                $('#interfaceUrl').text(data.interface_url);
                $('#interfaceToken').text(data.interface_token);
            }
        })
    })
</script>
</body>
</html>