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
        <h3>微信接口</h3>
        <hr>
        <div class="col-sm-1 textToCopyLabel">URL</div>
        <div class="col-sm-8 textToCopy" id="interfaceUrl">
            加载中...
        </div>
        <br>
        <br>
        <div class="col-sm-1 textToCopyLabel">Token</div>
        <div class="col-sm-8 textToCopy" id="interfaceToken">
            加载中...
        </div>
        <br>
        <br>
        <h3>使用说明</h3>
        <hr>
        <h4>什么是微信接口？</h4>
        <p>
            微信接口就是让你的公众号拥有更多功能的东西！那些功能丰富多彩的公众号，都是依靠接口实现的。<br>
            团团一家为您提供了接口，只要按照下面的提示绑定，就可以使用了。
        </p>
        <p>注：接口是微信的高级功能，如果您对微信公众号不是特别熟悉，不建议使用。</p>
        <img src="/img/admin/weixin/guide.png">
    </div>
</div>
</div>
@include('admin.layout.footer')

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/admin.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('/weixin/org/show-mp', function(data, status) {
            if (status == 'success')
            {
                data = data[0];
                $('#interfaceUrl').text('http://' + document.domain + '/mp/' + data.interface_url);
                $('#interfaceToken').text(data.interface_token);
            }
        })
    })
</script>
</body>
</html>