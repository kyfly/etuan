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
<!--            <div class="tab-pane active" id="tongji">-->
<!--              <div class="margintop">-->
<!---->
<!---->
<!--              </div>-->
<!--              <div class="margintop">-->
<!---->
<!---->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="tab-pane" id="dantiao">-->
<!--                <ul class="pager">-->
<!--                  <li><a href="#">&larr; 上一个</a></li>-->
<!--                  <li><a href="#">下一个 &rarr;</a></li>-->
<!--                </ul>-->
<!--                <dl>-->
<!--                  <dt><h3>&nbsp;姓名<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">徐敏菊</dd><hr>-->
<!--                  <dt><h3>&nbsp;性别<small>（必填，单选）</small></h3></dt>-->
<!--                  <dd class="margintop">女</dd><hr>-->
<!--                  <dt><h3>&nbsp;籍贯<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">浙江</dd><hr>-->
<!--                  <dt><h3>&nbsp;学院及专业<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">信息工程学院工业设计</dd><hr>-->
<!--                  <dt><h3>&nbsp;特长<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">交际沟通能力</dd><hr>-->
<!--                  <dt><h3>&nbsp;手机号码<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">13777889782</dd><hr>-->
<!--                  <dt><h3>&nbsp;部门志愿<small>（必填，单选）</small></h3></dt>-->
<!--                  <dd class="margintop">-->
<!--                    <table class="table table-striped table-bordered">-->
<!--                      <thead>-->
<!--                        <tr>-->
<!--                          <th>&nbsp;</th>-->
<!--                          <th>组织部</th>-->
<!--                          <th>办公室</th>-->
<!--                          <th>公关部</th>-->
<!--                          <th>学习部</th>-->
<!--                          <th>宣传部</th>-->
<!--                          <th>网络部</th>-->
<!--                          <th>国际交流部</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                      <tbody>-->
<!--                        <tr>-->
<!--                          <td>第一志愿部门</td>-->
<!--                          <td>√</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                          <td>第二志愿部门</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>√</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                          <td>&nbsp;</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                      </table>-->
<!--                    </dd><hr>-->
<!--                  <dt><h3>&nbsp;是否服从调剂<small>（必填，单选）</small></h3></dt>-->
<!--                  <dd class="margintop">是</dd><hr>-->
<!--                  <dt><h3>&nbsp;简答题：你觉得为什么要选择你？<small>（必填）</small></h3></dt>-->
<!--                  <dd class="margintop">我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</dd>-->
<!--                  </dl>-->
<!--            </div>-->
            <div class="tab-pane active" id="biaoge">
                <div class="pages">
                  <ul class="pagination">
                    <li class="disabled"><a href="#">«</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">»</a></li>
                  </ul>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                          <th class="td1">&nbsp;</th>
                          @foreach ($results['questions'] as $question)
                          <th>{{$question}}</th>
                          @endforeach
                      </tr>
                      </thead>
                    <tbody>
                    @foreach ($results['answers'] as $answers)
                    <tr>
                        <td class="td1"><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        @foreach($answers as $answer)
                        <td>{{$answer}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="xiazai">
               <button type="button" class="btn btn-primary btn-lg btn-block">导出为xls格式</button>
               <button type="button" class="btn btn-info btn-lg btn-block">导出为pdf格式</button>
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
