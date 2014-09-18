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
                    <form method="post" class="form-horizontal" action="change-department">
                        <?php
                        foreach ($departments as $department) {
                            echo '
                            <div id="addablebox">
                            <div class="form-group">
                            <label class="col-sm-2 control-label">部门名称</label>

                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="department_name[]" value="'.$department->name.'">
                            </div>
                            </div>
                            <div class="form-group">
                            <label class="col-sm-2 control-label">部门介绍</label>

                            <div class="col-sm-6">
                            <textarea class="form-control" name="department_description[]" maxlength="50" rows="3">'.$department->description.'</textarea>
                            <span class="help-block">请保持在50字以内</span>
                            </div>
                            </div>
                            </div>
                            ';
                        }
                        ?>
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
                        <button type="submit" class="btn btn-warning btn-lg">提交</button>
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