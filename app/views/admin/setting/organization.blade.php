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
                <form method="post" class="form-horizontal" action="change-organization">
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
                                <option value="1"><?php echo $organization->school;?></option>
<!--                            <option value="全校">全校</option>
                                <option value="机械工程学院">机械工程学院</option>
                                <option value="电子信息学院">电子信息学院</option>
                                <option value="通信工程学院">通信工程学院</option>
                                <option value="自动化学院">自动化学院</option>
                                <option value="计算机学院">计算机学院</option>
                                <option value="生命信息与仪器工程学院">生命信息与仪器工程学院</option>
                                <option value="材料与环境工程学院">材料与环境工程学院</option>
                                <option value="软件工程学院">软件工程学院</option>
                                <option value="理学院">理学院</option>
                                <option value="经济学院">经济学院</option>
                                <option value="管理学院">管理学院</option>
                                <option value="会计学院">会计学院</option>
                                <option value="外国语学院">外国语学院</option>
                                <option value="数字媒体与艺术设计学院">数字媒体与艺术设计学院</option>
                                <option value="人文与法学院">人文与法学院</option>
                                <option value="马克思主义学院">马克思主义学院</option>
                                <option value="卓越学院">卓越学院</option>
                                <option value="信息工程学院">信息工程学院</option>
                                <option value="国际教育学院">国际教育学院</option>
                                <option value="继续教育学院">继续教育学院</option>  -->
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
                            <span class="help-block">（选填）</span>
                        </div>
                    </div>
                    <div class="form-group has-feedback" id="inputbox9">
                        <label for="inputLogo" class="col-sm-2 control-label">上传logo</label>

                        <div class="col-sm-6">
                            <input name="logo" type="file" id="inputLogo">
                            <span id="span9-1" class="glyphicon glyphicon-ok form-control-feedback hidespan"></span>
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

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script src="/js/adminregdit.js"></script>
</body>
</html>