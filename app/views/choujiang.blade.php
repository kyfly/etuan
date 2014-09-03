<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <title>幸运大转盘抽奖</title>
    <link href="/css/choujiang.css" rel="stylesheet">
</head>

<body class="activity-lottery-winning">
<div class="main">
    <div id="outercont">
        <div id="outer-cont">
            <div id="outer" style="-webkit-transform: rotate(0deg);"><img src="/img/activity-lottery-1.png"
                                                                          width="310px"></div>
        </div>
        <div id="inner-cont">
            <div id="inner"><img src="/img/activity-lottery-2.png"></div>
        </div>
    </div>
    <div class="content">
        <div class="boxcontent boxyellow" id="result" style="display:none">
            <div class="box">
                <div class="title-orange"><span>恭喜你中奖了</span></div>
                <div class="Detail">
                    <a class="ui-link" href="http://www.weixinjia.net/mobile/showresult.html" id="opendialog"
                       style="display: none;" data-rel="dialog"></a>

                    <p>你中了：<span class="red" id="prizetype">一等奖</span></p>

                    <p>你的兑奖SN码：<span class="red" id="sncode"></span></p>

                    <p class="red">本次兑奖码已经关联你的微信号，你可向公众号发送 兑奖 进行查询!</p>

                    <p>
                        <input name="" class="px" id="tel" type="text" placeholder="输入您的手机号码">
                    </p>

                    <p>
                        <input class="pxbtn" id="save-btn" name="提 交" type="button" value="提 交">
                    </p>
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow">
            <div class="box">
                <div class="title-green"><span>奖项设置：</span></div>
                <div class="Detail">
                    <p>一等奖：香蕉雨伞。奖品数量：10 </p>

                    <p>二等奖：按键水杯。奖品数量：40 </p>

                    <p>三等奖：团团一家鼠标垫。奖品数量：1000 </p>
                    <br>
                    <p>说明：只有参与过社团在线报名的新生才能参加，每人仅限参加一次！</p>
                </div>
            </div>
        </div>
        <div class="boxcontent boxyellow">
            <div class="box">
                <div class="title-green">中奖名单</div>
                <div class="Detail" >
                    <marquee id="lotteryResult" direction="up" scrolldelay="150">
                        <p>中奖名单加载中...</p>
                    </marquee>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="/js/jQueryRotate.2.2.js"></script>
<script>
$(function () {
    function random(min, max) {
        return Math.floor(min + Math.random() * (max - min));
    }
    var itemToDeg = [11, 3, 7];
    var rotateDeg = [15, 45, 75, 105, 135, 165, 195, 225, 255, 285, 315, 345];
    do {
        var thanks = random(0, 11);
        var found = false;
        for (var i = 0 ; i < itemToDeg.length; i++)
        {
            if ( thanks == itemToDeg[i] )
            {
                found = true;
                break;
            }
        }
    } while (found);
    itemToDeg.push(thanks);
    $("#inner").click(function () {
        $('#inner').unbind('click');
        $.getJSON('/jiang/get/1', function(data, status) {
            if (status == 'success')
            {
                if (data.status == 'fail')
                {
                    alert(data.message);
                }
                else
                {
                    var item = itemToDeg[data.item_id - 1];		//通过改变这个数字0到11改变区间
                    if (item < 11) {
                        var destination = random(rotateDeg[item] + 4, rotateDeg[item + 1] - 2);
                    }
                    else {
                        destination = random(-11, 14);		//一等奖i == 11
                    }
                    $("#outer").rotate({
                        duration: 10000,
                        angle: 0,
                        animateTo: 2160 + destination,
                        callback: function() {
                            if (data.item_name != '谢谢惠顾')
                            {
                                alert("恭喜您中奖了！您获得了" + data.item_name + "!");
                            }
                            else
                            {
                                alert("很遗憾，您没有中奖，非常感谢您的参与！");
                            }

                        }
                    });
                    setTimeout(function () {
                        $('#inner').click(function () {
                            alert("您已经抽过奖了亲~~");
                        })
                    }, 10000);
                }
            }
        })
    });
    $.get('/jiang/result/1', function(data, status) {
        if (status == 'success') {
            data = eval(data);
            var list = '';
            for (var i = 0; i < data.length; i++)
            {
                if (data[i].item_name != '谢谢惠顾')
                    list += '<p>' + data[i].name + ' 抽中了 ' + data[i].item_name + '</p>'
            }
            if (list == '')
                list = '<p>现在还没有人中奖呢！快来吧，也许第一个中奖的就是你！</p>';
            $('#lotteryResult').html(list);
        }
    });
});
</script>
</body>
</html>