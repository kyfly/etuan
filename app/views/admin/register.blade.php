<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>组织管理员注册</title>
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::to('/css/adminreg.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script>
        document.write('<h2>您的浏览器版本过低</h2><p>本网站不支持IE8及以下版本，请更换浏览器！</p><p>若已使用高版本浏览器，请关闭兼容模式。</p>');
        document.execCommand("stop");
    </script>
    <![endif]-->
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?76a5edb5c9902d7c2e38f7a723060cff";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>
<!--头部-->
@include('layout.nav')
<div class="container" id="mainHeight">
<div class="field clearfix">
<div class="alert alert-info" role="alert" style="display: none" id="topAlert">
    <img src="/img/waiting.gif">&nbsp;&nbsp;正在上传图片并创建帐号，请稍等...
</div>
<h2 class="text-center">组织管理员注册</h2>
<hr>
<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked" role="tablist">
        <li class="active"><a href="#newid" role="pill" data-toggle="pill" id="next1-1">1. 创建账号</a></li>
        <li><a href="#shetuaninfo" role="pill" data-toggle="pill" id="next1-2">2. 填写信息</a></li>
        <li><a href="#bumeninfo" role="pill" data-toggle="pill" id="next1-3">3. 部门简介</a></li>
    </ul>
</div>
<form class="form-horizontal" role="form" method="post" action="register" enctype="multipart/form-data" id="regForm">
<div class="tab-content col-xs-9">
<!--创建账号-->
<div class="tab-pane fade active in" id="newid">
    <div class="form-group has-feedback" id="inputbox1">
        <label for="inputEmail" class="col-sm-2 control-label">电子邮箱</label><?php echo isset($error)?$error:null ?>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputEmail" name="email">
            <span id="span1" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span1-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
        <span id="span1-2" class="col-sm-4 errorspan  hidespan">邮箱格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox2">
        <label for="inputPassword" class="col-sm-2 control-label">密码</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword" name="password">
            <span id="span2" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span2-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请输入6-16位非空格字符</span>
        </div>
        <span id="span2-2" class="col-sm-4 errorspan  hidespan">密码格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox3">
        <label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>

        <div class="col-sm-6">
            <input type="password" class="form-control" id="inputPassword2">
            <span id="span3" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span3-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
        <span id="span3-2" class="col-sm-4 errorspan  hidespan">两次输入密码不一致</span>
    </div>
    <div class="form-group has-feedback" id="inputbox4">
        <label for="inputPhone" class="col-sm-2 control-label">手机号码</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputPhone" name="phone_long">
            <span id="span4" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span4-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请输入11位手机号码</span>
        </div>
        <span id="span4-2" class="col-sm-4 errorspan  hidespan">手机号码格式不正确</span>
    </div>
    <div class="form-group has-feedback" id="inputbox5">
        <label for="inputPhone2" class="col-sm-2 control-label">移动短号</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputPhone2" name="phone_short">
            <span id="span5" class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
            <span id="span5-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">移动用户请输入6位短号（选填）</span>
        </div>
        <span id="span5-2" class="col-sm-4 errorspan  hidespan">短号格式不正确</span>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next1" type="button" class="btn btn-primary btn-lg">下一步</button>
        </div>
    </div>
</div>
<!--社团介绍-->
<div class="tab-pane fade" id="shetuaninfo">
    <div class="form-group has-feedback" id="inputbox6">
        <label for="inputShetuan" class="col-sm-2 control-label">名称</label>

        <div class="col-sm-6">
            <input name="name" type="text" class="form-control" id="inputShetuan">
            <span id="span6-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请输入名称，注册以后不能更改</span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputType" class="col-sm-2 control-label">类别</label>

        <div class="col-sm-6">
            <select class="form-control" id="inputType" name="type">
                <option value="校级组织" selected>校级组织</option>
                <option value="院级组织">院级组织</option>
                <option value="校级社团">校级社团</option>
                <option value="院级社团">院级社团</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="inputXueyuan" class="col-sm-2 control-label">所属学院</label>

        <div class="col-sm-6">
            <select name="school" class="form-control" id="inputXueyuan">
                <option value="全校">全校</option>
            </select>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox7">
        <label for="inputIntro" class="col-sm-2 control-label">介绍</label>

        <div class="col-sm-6">
            <textarea id="inputIntro" name="description" class="form-control" rows="7"></textarea>
            <span id="span7-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">请保持在200字以内</span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox8">
        <label for="inputWeixin" class="col-sm-2 control-label">微信公众号</label>

        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputWeixin" name="wx">
            <span id="span8-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">您的微信公众号，数字与字母（选填）</span>
        </div>
    </div>
    <div class="help-block" style="padding-left: 120px">以下图片单张大小请不要超过<strong>1MB</strong>，否则无法上传。</div>
    <div class="form-group has-feedback" id="inputbox9">
        <label for="inputLogo" class="col-sm-2 control-label">上传logo</label>

        <div class="col-sm-6">
            <input name="logo" type="file" id="inputLogo">
            <span id="span9-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
            <span class="help-block">建议上传1:1比例的高清不带文字logo图</span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox10">
        <label for="inputPic1" class="col-sm-2 control-label">展示照片1</label>

        <div class="col-sm-6">
            <input name="pic1" type="file" id="inputPic1">
            <span id="span10-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox11">
        <label for="inputPic2" class="col-sm-2 control-label">展示照片2</label>

        <div class="col-sm-6">
            <input name="pic2" type="file" id="inputPic2">
            <span id="span11-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group has-feedback" id="inputbox12">
        <label for="inputPic3" class="col-sm-2 control-label">展示照片3</label>

        <div class="col-sm-6">
            <input name="pic3" type="file" id="inputPic3">
            <span id="span12-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next2" type="button" class="btn btn-primary btn-lg">上一步</button>
            <button id="next3" type="button" class="btn btn-primary btn-lg col-sm-offset-1">下一步</button>
        </div>
    </div>
</div>
<!--部门简介-->
<div class="tab-pane fade" id="bumeninfo">
    <div id="addablebox">
        <div class="form-group">
            <label class="col-sm-2 control-label">部门名称</label>

            <div class="col-sm-6">
                <input type="text" class="form-control" name="department_name[]">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">部门介绍</label>

            <div class="col-sm-6">
                <textarea class="form-control" name="department_description[]" maxlength="50" rows="3"></textarea>
                <span class="help-block">请保持在50字以内</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-6">
            <div id="addelement" class="addimgtxt col-sm-12"
                 onMouseOver="this.style.border='2px dotted #ccc'"
                 onMouseOut="this.style.border='2px dotted #ddd'">
                +
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button id="next4" type="button" class="btn btn-primary btn-lg">上一步</button>
            <button type="submit" class="btn btn-warning btn-lg col-sm-offset-1" id="btnSubmit">完成注册</button>
        </div>
    </div>
</div>
</div>
</form>
</div>
</div>
<footer id="footer" class="panel-footer">
    <p class="text-center">杭州电子科技大学麒飞软件开发团队©2014</p>
</footer>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/adminregdit.js"></script>
</body>
</html>
