<!DOCTYPE html>
<html>
@include('admin.layout.head')
<body>
@include('admin.layout.nav')
<div class="container">

<div class="adminField clearfix">
<!--侧边栏-->
@include('admin.layout.sidebar')

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
  
@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../js/admin.js"></script>
<script src="../../js/adminbaoming.js"></script>
</body>
</html>