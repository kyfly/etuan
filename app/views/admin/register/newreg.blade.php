<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
            <div class="tab-content">
                <!--新建报名-->
                <div class="tab-pane active in" id="newreg">
                    <form role="form">
                        <fieldset>
                            <legend><h2>新建报名表</h2></legend>
                            <div class="form-group">
                                <label for="dtp_input0">报名开始时间</label>

                                <div class="input-group date form_datetime" data-date="2014-09-01T12:00:07Z"
                                     data-link-field="dtp_input1">
                                    <input id="starttime" class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="dtp_input0" value=""/><br/>
                            </div>
                            <div class="form-group">
                                <label for="dtp_input1">报名结束时间</label>

                                <div class="input-group date form_datetime" data-date="2014-09-01T12:00:07Z"
                                     data-link-field="dtp_input1">
                                    <input id="stoptime" class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="dtp_input1" value=""/><br/>
                            </div>
                            <div class="form-group">
                                <label>允许报名年级</label>

                                <div>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="grade"> 大一
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="grade"> 大二
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="grade"> 大三
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="grade"> 大四
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="grade"> 研究生
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="url">报名链接</label>

                                <div class="input-group">
                                    <span class="input-group-addon">http://www.etuan.org/baoming/</span>
                                    <input id="url" type="text" class="form-control" placeholder="请自定义该报名表的链接">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>报名表样式</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="1">
                                    <img src="../../../img/example.png">
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="2">
                                    <img src="../../../img/example.png">
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="3">
                                    <img src="../../../img/example.png">
                                </label>
                            </div>
                        </fieldset>
                    </form>

                    <div id="addform" class="target">
                        <div class="col-md-9">
                            <h3>添加更多表单</h3>
                            <hr>
                            <form id="extraform" class="target">
                                <div style="display: inline" class="form-group">
                                    <label class="baomingitem">学号</label>
                                    <a class="moveup" data-toggle="tooltip" data-placement="right" title="置顶">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                    <a class="movedown" data-toggle="tooltip" data-placement="right" title="置底">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                    <hr>
                                </div>
                                <div style="display: inline" class="form-group">
                                    <label class="baomingitem">姓名</label>
                                    <a class="moveup" data-toggle="tooltip" data-placement="right" title="置顶">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                    <a class="movedown" data-toggle="tooltip" data-placement="right" title="置底">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                    <hr>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <h3>点击添加</h3>
                            <hr>
                            <form class="target extralist">
                                <div id="studentID2" class="form-group" style="display: none">
                                    <h4>学号</h4>
                                </div>
                                <div id="studentname2" class="form-group" style="display: none">
                                    <h4>姓名</h4>
                                </div>
                                <div id="sex2" class="form-group">
                                    <h4>性别</h4>
                                </div>
                                <div id="xueyuan2" class="form-group">
                                    <h4>学院</h4>
                                </div>
                                <div id="major2" class="form-group">
                                    <h4>专业</h4>
                                </div>
                                <div id="specialty2" class="form-group">
                                    <h4>特长</h4>
                                </div>
                                <div id="Email2" class="form-group">
                                    <h4>电子邮箱</h4>
                                </div>
                                <div id="QQ2" class="form-group">
                                    <h4>QQ</h4>
                                </div>
                                <div id="phonenumlong2" class="form-group">
                                    <h4>手机长号</h4>
                                </div>
                                <div id="phonenumshort2" class="form-group">
                                    <h4>手机短号</h4>
                                </div>
                                <div id="origin2" class="form-group">
                                    <h4>籍贯</h4>
                                </div>
                                <div id="wish1-2" class="form-group">
                                    <h4>第一志愿部门</h4>
                                </div>
                                <div id="wish2-2" class="form-group">
                                    <h4>第二志愿部门</h4>
                                </div>
                                <div id="wish3-2" class="form-group">
                                    <h4>第三志愿部门</h4>
                                </div>
                                <div id="tiaoji2" class="form-group">
                                    <h4>是否服从调剂</h4>
                                </div>
                                <div id="zidingyishort2" class="form-group">
                                    <h4>自定义短问题</h4>
                                </div>
                                <div id="zidingyilong2" class="form-group">
                                    <h4>自定义长问题</h4>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="preview" type="button" class="btn btn-warning">预览</button>
                        <button id="submit" type="button" class="btn btn-success">提交</button>
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
<script src="../../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../../js/admin.js"></script>
<script src="../../../js/adminbaoming.js"></script>
<script>
    $('.form_datetime').datetimepicker({
        language: 'en',
        format: 'yyyy/mm/dd hh:ii',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
</script>
</body>
</html>