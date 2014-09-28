<!DOCTYPE html>
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
                <!--首页-->
                <div class="tab-pane active in" style="margin-top: 30px">
                    <div class="col-md-5 text-right">
                        <img src="/img/admin/help/qun.png">
                    </div>
                    <div class="col-md-5 text-left">
                        <h3>有问题请联系我们！</h3>
                        <h4>加入团团一家用户群，解答问题，交流经验！</h4>
                        <h4>QQ群号：198204936</h4>
                        <a href="http://jq.qq.com/?_wv=1027&k=VO8jjj" class="btn btn-primary btn-lg" target="_blank">
                            点击加群
                        </a>
                    </div>
                </div>
            </div>	<!--tab-content-->
        </div>	<!--col-md-9-->
    </div>		<!--container-->
</div>

@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('/user/home-info', function(data, status) {
            if (status == 'success') {
                $('#reg_user_number').text(data.reg_user_number);
                $('#reg_number').text(data.reg_number);
                $('#reg_page_view').text(data.reg_page_view);
            }
        })
    })
</script>
</body>
</html>