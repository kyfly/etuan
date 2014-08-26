<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/admin.css" rel="stylesheet">
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

<div id="main" class="col-lg-9 col-md-9">
  <div class="tab-content">
    <!--首页-->
    <div class="tab-pane active in">
      <div class="col-md-4">
        <div class="panel1 panel">
          <div class="panel-body">
            <p class="p1"><span class="glyphicon glyphicon-user"></span>&nbsp;参与人数</p>
            <p class="p2">100</p>
            </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel2 panel">
          <div class="panel-body">
            <p class="p1"><span class="glyphicon glyphicon-calendar"></span>&nbsp;进行活动</p>
            <p class="p2">15</p>
            </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel3 panel">
          <div class="panel-body">
            <p class="p1"><span class="glyphicon glyphicon-globe"></span>&nbsp;浏览量</p>
            <p class="p2">2</p>
            </div>
          </div>
        </div>
      <div class="col-sm-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>实时公告</th>
              <th>发布时间</th>
              </tr>
            </thead>
          <tbody>
            <tr>
              <td>欢迎使用“团团一家”社团活动服务平台！</td>
              <td>2014-07-08</td>
              </tr>
            <tr>
              <td>报名系统全新上线，新学期招新必备神器！</td>
              <td>2014-07-15</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>	<!--tab-content-->
  </div>	<!--col-md-9-->
</div>		<!--container-->
</div>
  
<footer id="footer" class="panel-footer">
	<p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../js/admin.js"></script>
<script src="../../js/adminbaoming.js"></script>
</body>
</html>