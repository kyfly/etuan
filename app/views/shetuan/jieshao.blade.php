<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{{$orgInfo->name}}} 介绍 - 团团一家</title>
    <link href="http://cdn.kyfly.net/lib/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        body {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
        }

        .box1 {
            padding: 15px;
            background-color: #ff9933;
        }

        .box1 > .container {
            text-align: center;
        }

        .container {
            background-color: #fff;
            height: 100%;
            padding: 10px 30px;
        }

        .box1 > .container > p {
            color: #ff9933;
            display: inline;
            line-height: 32px;
            font-size: 32px;
        }

        .box2 {
            padding: 15px;
            background-color: #ffcc33;
        }

        .box2 > .container > h3 {
            color: #ffcc33;
        }

        .box2 > .container > p {
            text-indent: 2em;
            font-size: 18px;
        }

        .box3 {
            padding: 18px;
            background-color: #eded00;
        }

        .box3 > .container > h3 {
            color: #eded00;
        }

        .dl-horizontal > .intro {
            color: #66cc00;
            font-size: 20px;
        }

        .dl-horizontal > p, .dl-horizontal > dd {
            font-size: 18px;
        }

        .dl-horizontal > dt {
            color: #3333cc;
            font-size: 18px;
        }

        .box4 {
            padding: 18px;
            background-color: #99ccff;
        }

        .box4 > .container > h3 {
            color: #99ccff;
            margin-bottom: 18px;
        }

        .box4 > .container > a > img {
            width: 100%;
            margin-bottom: 18px;
        }

        .box5 {
            background-color: #ffcc33;
            padding: 25px 0;
        }

        .box5 > h2 {
            display: inline;
            vertical-align: middle;
            color: #000000
        }
    </style>
</head>
<body>
<div class="box1">
    <div class="container" style="padding: 20px 10px">
        <p><img src="{{{$orgInfo->logo_url}}}@50w_50h.png" height="50px" width="50px">&nbsp;{{{$orgInfo->name}}}</p>
    </div>
</div>

<div class="box2">
    <div class="container">
        <h3>介绍</h3>
        <p>{{{$orgInfo->description}}}</p>
    </div>
</div>

<div class="box3">
    <div class="container">
        <h3>部门简介</h3>
        <dl class="dl-horizontal">
            @foreach ($department as $depart)
            <p class="intro">{{{$depart->name}}}</p>

            <p>{{{$depart->description}}}</p>
            <hr>
            @endforeach
        </dl>
    </div>
</div>

<div class="box4">
    <div class="container">
        <h3>个性展区</h3>
        <a href="{{{$orgInfo->pic_url1}}}"><img src="{{{$orgInfo->pic_url1}}}@1000w_80Q.jpg"></a>
        <a href="{{{$orgInfo->pic_url2}}}"><img src="{{{$orgInfo->pic_url2}}}@1000w_80Q.jpg"></a>
        <a href="{{{$orgInfo->pic_url3}}}"><img src="{{{$orgInfo->pic_url3}}}@1000w_80Q.jpg"></a>
    </div>
</div>

<a href="{{{$regUrl}}}" target="_blank" style="text-decoration: none">
    <div class="box5 text-center">
        <h2>我要报名！<img src="/img/arrow.png"></h2>
    </div>
</a>

<div class="box1 text-center">
    <h4 style="color: #ffffff"><a href="http://www.etuan.org/"><img src="http://img.kyfly.net/common/logo/etuan-logo-word.png@40h.png" height="20px"></a>
        &nbsp;提供技术支持</h4>
</div>
<script>
    window._bd_share_config = {
        common: {
            bdText: '{{{$orgInfo->name}}} 介绍 - 团团一家',
            bdDesc: '{{{str_replace(["\n", "\r"], " ", $orgInfo->description)}}}',
            bdUrl: 'http://www.etuan.org/shetuan/{{{$orgInfo->org_id}}}',
            bdPic: '{{{$orgInfo->logo_url}}}',
            bdMiniList: ['tsina', 'qzone', 'weixin', 'sqq', 'tqq', 'renren', 'tieba', 'hi', 'mail', 'copy']
        },
        share: [
            {
                "bdSize": 16
            }
        ],
        slide: [
            {
                bdImg: 0,
                bdPos: "right",
                bdTop: 100
            }
        ],
        image: [
            {
                viewType: 'list',
                viewPos: 'top',
                viewColor: 'black',
                viewSize: '16',
                viewList: ['qzone', 'tsina', 'weixin', 'sqq', 'renren']
            }
        ],
        selectShare : [{
            "bdSelectMiniList" : ['qzone', 'tsina', 'weixin', 'sqq', 'renren']
        }]
    }
    with (document)0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion=' + ~(-new Date() / 36e5)];
</script>

</body>
</html>
