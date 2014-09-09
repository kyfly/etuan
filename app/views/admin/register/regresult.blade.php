<!doctype html>
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
        <!--查看结果-->
        <div class="tab-pane active in" id="regresult">
          <ul class="nav nav-tabs" role="tablist">
<!--            <li class="active"><a href="#tongji" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list"></span>&nbsp;统计报表</a></li>-->
<!--            <li><a href="#dantiao" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-list"></span>&nbsp;单张详情</a></li>-->
            <li class="active"><a href="#biaoge" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;总体详情</a></li>
            <li><a href="#xiazai" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-download"></span>&nbsp;下载结果</a></li>
            </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="biaoge" style="padding-top: 10px">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                          @foreach ($results['questions'] as $question)
                          <th>{{$question}}</th>
                          @endforeach
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($results['answers'] as $answers)
                    <tr>
                        @foreach($answers as $answer)
                        <td>{{$answer}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                      </tbody>
                    </table>
                </div>
            <div class="tab-pane text-center" id="xiazai" style="padding-top: 60px">
               <div class="col-md-12"><img src="/img/excel.png"> </div>
               <button type="button" id="downloadXls" class="btn btn-primary btn-lg btn-block" style="width: 200px">导出为Excel电子表格</button>
               <!--<button type="button" class="btn btn-info btn-lg btn-block">导出为pdf格式</button>-->
            </div>
          </div>
        </div>
    </div>
</div>
</div>
</div>
@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $('#downloadXls').click(function () {
            window.location.href = '/registration/downloadxls';
        })
    })
</script>
</body>
</html>
