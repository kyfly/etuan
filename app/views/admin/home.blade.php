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
            <p class="p2" id="reg_user_number">--</p>
            </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel2 panel">
          <div class="panel-body">
            <p class="p1"><span class="glyphicon glyphicon-calendar"></span>&nbsp;进行活动</p>
            <p class="p2" id="reg_number">--</p>
            </div>
          </div>
        </div>
      <div class="col-md-4">
        <div class="panel3 panel">
          <div class="panel-body">
            <p class="p1"><span class="glyphicon glyphicon-globe"></span>&nbsp;浏览量</p>
            <p class="p2" id="reg_page_view">--</p>
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
              <td>
              <a href="http://mp.weixin.qq.com/s?__biz=MzA3NTI4MjQwOA==&mid=201107644&idx=2&sn=19d78187b0d38fba685e9634d8eea710#rd" target="_blank">
                 团团一家招新报名系统介绍
              </a></td>
              <td>2014-09-10</td>
              </tr>
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
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('/user/home-info', function(data, status) {
            if (status == 'success') {
                $('#reg_user_number').text(data.reg_user_number);
                $('#reg_number').text(data.reg_number);
                $('#reg_page_view').text(data.reg_page_view);
            }
        })
    })
</script>
</body>
</html>