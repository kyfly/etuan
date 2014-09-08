<!doctype html>
<html>
@include('admin.layout.head')
<style>
    @media (max-width: 1199px) {
        .theme {
            width: 180px
        }
    }

    ;
</style>
<body>
@include('admin.layout.nav')
<div class="container">
    <div class="adminField clearfix">
        <!--侧边栏-->
        @include('admin.layout.sidebar')

        <div id="main" class="col-lg-9 col-md-9">
            <div class="tab-content">
                <!--新建报名-->
                <div class="tab-pane active in" id="newreg">
                    <form role="form">
                        <fieldset>
                            <legend><h2>新建报名表<!--编辑报名表--></h2></legend>
                            <div class="form-group">
                                <label for="regname">报名标题</label>
                                <input id="regname" type="text" class="form-control" placeholder="请自定义该报名表的标题">
                            </div>
                            <div class="form-group">
                                <label for="dtp_input0">报名开始时间</label>

                                <div class="input-group date form_datetime" data-date="2014-09-01T12:00:07Z"
                                     data-link-field="dtp_input1">
                                    <input id="starttime" class="form-control" size="16" type="text" value="" readonly>
                                    <span class="input-group-addon"><span
                                            class="glyphicon glyphicon-remove"></span></span>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <input type="hidden" id="dtp_input0" value=""/>
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
                                <input type="hidden" id="dtp_input1" value=""/>
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
                                <label>报名表主题样式</label><br>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="0">
                                    <img class="theme" src="/img/admin/register/theme/00.png" alt="黯矩">
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="1">
                                    <img class="theme" src="/img/admin/register/theme/10.png" alt="清雅">
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="theme" value="2">
                                    <img class="theme" src="/img/admin/register/theme/20.png" alt="六彩">
                                </label>
                            </div>
                        </fieldset>
                    </form>
                    <br>

                    <div id="addform" class="target">
                        <div class="col-md-9">
                            <h3>添加更多表单</h3>
                            <hr>
                            <form id="extraform" class="target">
                                <div style="display: inline" class="form-group">
                                    <label class="baomingitem">学号</label>
                                    <a class="moveup" data-toggle="tooltip" data-placement="right" title="向上移动">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                    <a class="movedown" data-toggle="tooltip" data-placement="right" title="向下移动">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                    <hr>
                                </div>
                                <div style="display: inline" class="form-group">
                                    <label class="baomingitem">姓名</label>
                                    <a class="moveup" data-toggle="tooltip" data-placement="right" title="向上移动">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                    <a class="movedown" data-toggle="tooltip" data-placement="right" title="向下移动">
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
@include('admin.layout.footer')
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-datetimepicker.min.js"></script>
<script src="/js/admin.js"></script>
<!--当前页面的社团号-->
<script>_orgId = {{Session::get('org_id')}};</script>
<!--新建报名表模式-->
<script src="/js/adminbaoming.js"></script>
<!--编辑报名表模式
<script>_activityId = 0;</script>
<script src="/js/admineditbaoming.js"></script>
-->

<script>
    $('.form_datetime').datetimepicker({
        language: 'en',
        format: 'yyyy-mm-dd hh:ii',
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
