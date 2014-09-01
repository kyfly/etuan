<!DOCTYPE html>
<html>
@include('admin.layout.head')
<body>
@include('admin.layout.nav')
<div class="container">
    <div class="adminField clearfix">
        <!--侧边栏-->
@include('admin.layout.sidebar')
        <!--主体-->

        <div id="main" class="col-lg-9 col-md-9">
            <div class="tab-content">
                <form method="post" class="form-horizontal" action="change-organization-user">
                    <div class="tab-pane fade active in" id="newid">
                        <div class="form-group has-feedback" id="inputbox1">
                            <label for="inputEmail" class="col-sm-2 control-label">电子邮箱</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputEmail" name="email" disabled="disabled" value="<?php echo $organization_user->email; ?>">
                                    <span id="span1"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span1-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            </div>
                            <span id="span1-2" class="col-sm-4 errorspan  hidespan">邮箱格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox2">
                            <label for="inputPassword" class="col-sm-2 control-label">密码</label>

                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword" name="password">
                                    <span id="span2"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span2-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">请输入6-16位非空格字符</span>
                            </div>
                            <span id="span2-2" class="col-sm-4 errorspan  hidespan">密码格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox3">
                            <label for="inputPassword2" class="col-sm-2 control-label">确认密码</label>

                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="inputPassword2">
                                    <span id="span3"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span3-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            </div>
                            <span id="span3-2" class="col-sm-4 errorspan  hidespan">两次输入密码不一致</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox4">
                            <label for="inputPhone" class="col-sm-2 control-label">手机号码</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputPhone" name="phone_long" value="<?php echo $organization_user->phone_long; ?>">
                                    <span id="span4"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span4-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">请输入11位手机号码</span>
                            </div>
                            <span id="span4-2" class="col-sm-4 errorspan  hidespan">手机号码格式不正确</span>
                        </div>
                        <div class="form-group has-feedback" id="inputbox5">
                            <label for="inputPhone2" class="col-sm-2 control-label">移动短号</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputPhone2" name="phone_short" value="<?php echo $organization_user->phone_short; ?>">
                                    <span id="span5"
                                          class="glyphicon glyphicon-exclamation-sign form-control-feedback hidespan"></span>
                                    <span id="span5-1"
                                          class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                                <span class="help-block">移动用户请输入6位短号（选填）</span>
                            </div>
                            <span id="span5-2" class="col-sm-4 errorspan  hidespan">短号格式不正确</span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-primary btn-lg">提交</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--tab-content-->
        </div>
        <!--col-md-9-->
    </div>
    <!--container-->

</div>
@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/adminregdit.js"></script>
</body>
</html>