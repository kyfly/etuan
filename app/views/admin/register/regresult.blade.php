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
                  <div class="table-responsive">
                  <table class="table table-bordered table-hover">
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
                </div>
            <div class="tab-pane" id="xiazai" style="padding-top: 40px">
               
                <div class="col-md-12" style="margin-top: 30px">
                    <div class="col-md-offset-1 col-md-4 text-center">
                        <img src="/img/icon/excel.png">
                    </div>
                    <div class="col-md-5">
                        <p><br>导出为Excel电子表格，在一张表格中查看全部报名结果，适用于数据分析、总体统计。</p>
                        <a href="/registration/downloadxls" type="button" class="btn btn-info btn-lg btn-block">下载xls文件</a>
                    </div>
                </div>
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
</body>
</html>
