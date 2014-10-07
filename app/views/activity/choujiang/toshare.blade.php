<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>分享奖品</title>
    <!--[if lt IE 9]>
    <script>
        document.write('<h2>您的浏览器版本过低</h2><p>本网站不支持IE8及以下版本，请更换浏览器！</p><p>若已使用高版本浏览器，请关闭兼容模式。</p>');
        document.execCommand("stop");
    </script>
    <![endif]-->
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?18a33d5e0bee3d92c20e7173809e5cb4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <style>
        body {
            background-image: url(/img/choujiang/share_back.png);
            background-repeat:no-repeat;
            background-size: 720px 1280px;
            text-align: center;
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
            color: #ffffff;
        }

        .click-to-share {
            text-align: right;
        }

        .click-to-share > img {
            width: 140px;
            height: 65px;
            margin-right: 5px;
        }

        .pic-gift {
            margin-top: 40px;
        }

        .pic-gift > img {
            width: 100px;
            height: 100px;
        }

        .text-share {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="click-to-share">
        <img src="/img/choujiang/click_share.png">
    </div>
    <div class="pic-gift">
        <img src="/img/choujiang/gift.png">
    </div>
    <div class="text-get">
        <h3>恭喜您，获得了<span id="itemName">----</span>！</h3>
    </div>
    <div class="text-share">
        <p>独乐乐不如众乐乐，<br>
        <strong>分享到朋友圈</strong>以后才能领奖哦！</p>
    </div>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/WeixinApi.min.js"></script>
<script>

    var lotteryId = {{$lotteryId}};
    var itemName = '';

    $(document).ready(function() {
        $('body').css('background-size', $(window).width() + 'px ' + $(window).height() + 'px');

        $.getJSON('/jiang/myresult/'+lotteryId, function(data, status) {
            if (status == 'success')
            {
                if (data.item_name != '谢谢惠顾' && data.gotten){
                    $('#itemName').text(data.item_name);
                    itemName = '我抽中了' + data.item_name + '!';
                }
            }
        });

    });

    WeixinApi.ready(function(Api) {

        // 微信分享的数据
        var wxData = {
            "appId": "", // 服务号可以填写appId
            "imgUrl" : 'http://img.kyfly.net/etuan/weixin/icon/prize.png',
            "link" : 'http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202367217&idx=2&sn=87544f6e384cf217da89a235f282bbf4#rd',
            "desc" : "在线报名杭电组织和社团，还有神秘大奖！" + itemName,
            "title" : "在线报名杭电组织和社团，还有神秘大奖！" + itemName
        };

        // 分享的回调
        var wxCallbacks = {
            cancel : function() {
                alert("啊哦，你取消了分享，只有分享到朋友圈以后才能领奖哦！");
            },
            fail : function() {
                alert("啊哦，分享失败了，再试一次吧！");
            },
            confirm : function() {
                $.getJSON('/jiang/shared/' + lotteryId, function(data, status) {
                    if (status == 'success')
                    {
                        if (data.status == 'success')
                        {
                            alert("分享成功，我们将会在10月底发放奖品，请留意团团一家服务号通知！");
                            WeixinJSBridge.call('closeWindow');
                        }
                        else
                            alert("啊哦，出错了，再分享一次试试看吧！错误信息：" + data.message);
                    }
                });
            }
        };
        // 点击分享到朋友圈，会执行下面这个代码
        Api.shareToTimeline(wxData, wxCallbacks);
    });
</script>
</body>
</html>