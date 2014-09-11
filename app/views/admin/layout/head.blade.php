<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    @if (isset($css))
        @foreach($css as $cssFile)
            {{HTML::style($cssFile)}}
        @endforeach
    @endif
    <title>团团一家 - 管理后台</title>
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
            hm.src = "//hm.baidu.com/hm.js?18a33d5e0bee3d92c20e7173809e5cb4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>