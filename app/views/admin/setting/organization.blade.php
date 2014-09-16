<!DOCTYPE html>
<html>
@include('admin.layout.head', array('css'=>['css/adminreg.css']))
<body>
@include('admin.layout.nav')
<div class="container">
    <div class="adminField clearfix">
        <!--侧边栏-->
@include('admin.layout.sidebar')
        <!--主体-->

        <div id="main" class="col-lg-9 col-md-9">
            <div class="tab-content">
                <form method="post" class="form-horizontal" action="change-organization" enctype="multipart/form-data">
                    <div class="form-group has-feedback" id="inputbox6">
                        <label for="inputShetuan" class="col-sm-2 control-label">社团名称</label>

                        <div class="col-sm-6">
                            <input name="name" type="text" class="form-control" id="inputShetuan" value="<?php echo $organization->name ?>">
                            <span id="span6-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">类别</label>

                        <div class="col-sm-6">
                            <select class="form-control" id="inputType" name="type">
                                <option id="xiaojioption" value="1"><?php echo $organization->type;?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputXueyuan" class="col-sm-2 control-label">所属学院</label>

                        <div class="col-sm-6">
                            <select name="school" class="form-control" id="inputXueyuan">
                                <option value="0"><?php echo $organization->school;?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group has-feedback" id="inputbox7">
                        <label for="inputIntro" class="col-sm-2 control-label">社团介绍</label>

                        <div class="col-sm-6">
                            <textarea id="inputIntro" name="description" class="form-control" rows="7"><?php echo $organization->description; ?></textarea>
                            <span id="span7-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            <span class="help-block">200字以内</span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" id="inputbox8">
                        <label for="inputWeixin" class="col-sm-2 control-label">微信公众号</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="inputWeixin" name="wx" value="<?php echo $organization->wx; ?>">
                            <span id="span8-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
                            <span class="help-block">您的社团公众号，数字与字母（选填）</span>
                        </div>
                    </div>
                    <div class="help-block" style="padding-left: 140px">以下图片单张大小请不要超过<strong>1MB</strong>，否则无法上传。</div>
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
                            <button type="submit" class="btn btn-primary btn-lg">提交</button>
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

<script>

</script>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/adminregdit.js"></script>
</body>
</html>