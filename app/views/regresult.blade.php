<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL::to('css/admin.css')?>" rel="stylesheet">
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
      <a><img src="<?php echo URL::to('img/brand.png')?>" id="brandpic"></a>
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
<!--侧边栏-->
<div id="sidebar" class="col-lg-3 col-md-3" style="min-height: 300px;"></div>

<div id="main" class="col-lg-9 col-md-9">
	<div class="tab-content">
        <!--查看结果-->
        <div class="tab-pane active in" id="regresult">
          <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tongji" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list"></span>&nbsp;统计报表</a></li>
            <li><a href="#dantiao" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-th-list"></span>&nbsp;单张详情</a></li>
            <li><a href="#biaoge" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;总体详情</a></li>
            <li><a href="#xiazai" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-download"></span>&nbsp;下载结果</a></li>
            </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="tongji">
              <div class="margintop">
                <div class="onebox">
                  <div class="panel1 panel">
                    <div class="panel-body">
                      <p class="p3">报名人数</p>
                      <p class="p4"><?php echo $data['liulan'][0]?></p>
                    </div>
                  </div>
                </div>
                <div class="onebox">
                  <div class="panel2 panel">
                    <div class="panel-body">
                      <p class="p3">浏览量</p>
                      <p class="p4"><?php echo $data['liulan'][1]?></p>
                    </div>
                  </div>
                </div>
                <div class="onebox">
                  <div class="panel3 panel">
                    <div class="panel-body">
                      <p class="p3">填写率</p>
                      <p class="p4"><?php echo $data['liulan'][2];?></p>
                    </div>
                  </div>
                </div>
                <div class="onebox">
                  <div class="panel4 panel">
                    <div class="panel-body">
                      <p class="p3">平均用时</p>
                      <p class="p4"><?php echo $data['liulan'][3]?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="margintop">
                <dl>
                    <?php
                    if(isset($data['xuehao']))
                    {
                        echo '<dt><h3>学号<small>（必填）</small></h3></dt>
                              <dd>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                    ';
                        foreach($data['xuehao'] as $xuehao=>$count)
                        {
                            echo '<th>'.$xuehao.'级</th>';
                        }
                        echo '      </tr>
                                  </thead>
                                <tbody>
                             <tr>';
                        foreach($data['xuehao'] as $xuehao=>$count)
                        {
                            echo '<th>'.$count.'</th>';
                        }
                    }
                     if(isset($data['sex']))
                     {
                         echo '
                  <dt><h3>性别<small>（必填，单选）</small></h3></dt>
                  <dd>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>性别</th>
                          <th>数量</th>
                          <th>百分比</th>
                        </tr>
                        </thead>
                      <tbody>
                        <tr>
                          <td>男</td>
                          <td>'.$data["sex"][1]["count"].'</td>
                          <td>'.$data["sex"][1]["percent"].'</td>
                        </tr>
                        <tr>
                          <td>女</td>
                          <td>'.$data["sex"][0]["count"].'</td>
                          <td>'.$data["sex"][0]["percent"].'</td>
                        </tr>
                        </tbody>
                    </table>
                  </dd><hr>
                    ';
                     }
                    if(isset($data['xueyuan']))
                    {
                        echo '<dt><h3>学院<small>（必填）</small></h3></dt>
                              <dd>
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                    ';
                        foreach($data['xueyuan'] as $xueyuan)
                        {
                            echo '<th>'.$xueyuan->answer.'</th>';
                        }
                        echo '      </tr>
                                  </thead>
                                <tbody>
                             <tr>';
                        foreach($data['xueyuan'] as $xueyuan)
                        {
                            echo '<th>'.$xueyuan->count.'<br>'.$xueyuan->percent.'</th>';
                        }
                    }
                    if(isset($data['diyibumen']))
                    {
                        echo '
                          <dt><h3>第一志愿<small>（必填，单选）</small></h3></dt>
                          <dd>
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>';
                        echo '<th>&nbsp</th>';
                        foreach($data['diyibumen'] as $bumen)
                        {
                            echo '<th>'.$bumen->answer.'</th>';
                        }
                        echo '
                                </tr>
                               </thead>
                            <tbody>
                           <tr>
                        ';
                        echo '<td>第一志愿</td>';
                        foreach($data['diyibumen'] as $bumen)
                        {
                            echo '<td>'.$bumen->count.'<br>'.$bumen->percent.'</td>';
                        }
                        echo '
                             </tr>
                            </tbody>';
                    }
                    if(isset($data['dierbumen']))
                    {
                        echo '
                          <dt><h3>第二志愿<small>（必填，单选）</small></h3></dt>
                          <dd>
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>';
                        echo '<th>&nbsp</th>';
                        foreach($data['dierbumen'] as $bumen)
                        {
                            echo '<th>'.$bumen->answer.'</th>';
                        }
                        echo '
                                </tr>
                               </thead>
                            <tbody>
                           <tr>
                        ';
                        echo '<td>第二志愿</td>';
                        foreach($data['dierbumen'] as $bumen)
                        {
                            echo '<td>'.$bumen->count.'<br>'.$bumen->percent.'</td>';
                        }
                        echo '
                             </tr>
                            </tbody>';
                    }
                    if(isset($data['disanbumen']))
                    {
                        echo '
                          <dt><h3>第三志愿<small>（必填，单选）</small></h3></dt>
                          <dd>
                            <table class="table table-striped table-bordered">
                              <thead>
                                <tr>';
                        echo '<th>&nbsp</th>';
                        foreach($data['disanbumen'] as $bumen)
                        {
                            echo '<th>'.$bumen->answer.'</th>';
                        }
                        echo '
                                </tr>
                               </thead>
                            <tbody>
                           <tr>
                        ';
                        echo '<td>第三志愿</td>';
                        foreach($data['disanbumen'] as $bumen)
                        {
                            echo '<td>'.$bumen->count.'<br>'.$bumen->percent.'</td>';
                        }
                        echo '
                             </tr>
                            </tbody>';
                    }
                    ?>

                    </table>
                    <?php
                        if(isset($data['tiaoji']))
                        {
                            echo '
                  <dt><h3>是否服从调剂<small>（必填，单选）</small></h3></dt>
                  <dd>
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>选项</th>
                          <th>数量</th>
                          <th>百分比</th>
                        </tr>
                        </thead>
                      <tbody>
                        <tr>
                          <td>是</td>
                          <td>'.$data['tiaoji'][1]->count.'</td>
                          <td>'.$data['tiaoji'][1]->percent.'</td>
                        </tr>
                        <tr>
                          <td>否</td>
                          <td>'.$data['tiaoji'][0]->count.'</td>
                          <td>'.$data['tiaoji'][0]->percent.'</td>
                        </tr>
                        </tbody>
                      </table>
                                ';
                        }
                    ?>
                  </dl>
              </div>
            </div>
            <div class="tab-pane" id="dantiao">
                <ul class="pager">
                  <li><a href="#">&larr; 上一个</a></li>
                  <li><a href="#">下一个 &rarr;</a></li>
                </ul>
                <dl>
                  <dt><h3>&nbsp;姓名<small>（必填）</small></h3></dt>
                  <dd class="margintop">徐敏菊</dd><hr>
                  <dt><h3>&nbsp;性别<small>（必填，单选）</small></h3></dt>
                  <dd class="margintop">女</dd><hr>
                  <dt><h3>&nbsp;籍贯<small>（必填）</small></h3></dt>
                  <dd class="margintop">浙江</dd><hr>
                  <dt><h3>&nbsp;学院及专业<small>（必填）</small></h3></dt>
                  <dd class="margintop">信息工程学院工业设计</dd><hr>
                  <dt><h3>&nbsp;特长<small>（必填）</small></h3></dt>
                  <dd class="margintop">交际沟通能力</dd><hr>
                  <dt><h3>&nbsp;手机号码<small>（必填）</small></h3></dt>
                  <dd class="margintop">13777889782</dd><hr>
                  <dt><h3>&nbsp;部门志愿<small>（必填，单选）</small></h3></dt>
                  <dd class="margintop">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>&nbsp;</th>
                          <th>组织部</th>
                          <th>办公室</th>
                          <th>公关部</th>
                          <th>学习部</th>
                          <th>宣传部</th>
                          <th>网络部</th>
                          <th>国际交流部</th>
                        </tr>
                        </thead>
                      <tbody>
                        <tr>
                          <td>第一志愿部门</td>
                          <td>√</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>第二志愿部门</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>√</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        </tbody>
                      </table>
                    </dd><hr>
                  <dt><h3>&nbsp;是否服从调剂<small>（必填，单选）</small></h3></dt>
                  <dd class="margintop">是</dd><hr>
                  <dt><h3>&nbsp;简答题：你觉得为什么要选择你？<small>（必填）</small></h3></dt>
                  <dd class="margintop">我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</dd>
                  </dl>
            </div>
            <div class="tab-pane" id="biaoge">
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
                        <th class="td2">开始时间</th>
                        <th class="td3">填写用时</th>
                        <th class="td4">姓名</th>
                        <th class="td5">性别</th>
                        <th class="td6">籍贯</th>
                        <th class="td7">学院及专业</th>
                        <th class="td8">特长</th>
                        <th class="td9">手机号码</th>
                        <th class="td10">部门志愿 （第一意向部门）</th>
                        <th class="td11">部门志愿 （第二意向部门）</th>
                        <th class="td12">是否服从调剂？</th>
                        <th class="td13">简答题：你觉得总队为什么要选择你？</th>
                      </tr>
                      </thead>
                    <tbody>
                      <tr>
                        <td class="td1"><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-28 13:13:03</td>
                        <td>9分钟30秒</td>
                        <td>徐敏菊</td>
                        <td>女</td>
                        <td>浙江</td>
                        <td>信息工程学院工业设计</td>
                        <td>交际沟通能力</td>
                        <td>13777889782</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
                      <tr>
                        <td><a href="#">查看</a>&nbsp;<a href="#">删除</a></td>
                        <td>2013-09-26 22:49:53</td>
                        <td>14分钟56秒</td>
                        <td>申屠泳裤</td>
                        <td>男</td>
                        <td>浙江省绍兴县福全镇</td>
                        <td>数字媒体与艺术设计学院，数字媒体技术</td>
                        <td>爱好多，但不特长。。。篮球，游戏，电影，小说	</td>
                        <td>长：13588040951 短：670951</td>
                        <td>组织部</td>
                        <td>宣传部</td>
                        <td>是</td>
                        <td>我觉得我需要一个能锻炼自己胆量的平台，我不想过每天一下课就回寝室的大学生活，正因为我有这份诚意，我觉得总队也需要有着类似诚意的队员的加入。</td>
                      </tr>
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
<footer id="footer" class="panel-footer">
	<p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="../../../js/admin.js"></script>
</body>
</html>
