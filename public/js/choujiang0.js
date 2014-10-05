$(function () {

    function isWeiXin() {
        var ua = window.navigator.userAgent.toLowerCase();
        return ua.match(/MicroMessenger/i) == 'micromessenger';
    }

    if (!isWeiXin())
    {
        alert("请在团团一家微信服务号上进行抽奖！");
        window.location.href
            = "http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202239029&idx=1&sn=b1cb7de21413986193491c008b0d5435#rd";
    }

    $.get('/oauth/checksub', function (data, status) {
        if (status == 'success') {
            if (data != '1')
            {
                alert('您必须关注团团一家服务号才能参加！微信号：e-tuan');
                window.location.href
                    = "http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202239029&idx=1&sn=b1cb7de21413986193491c008b0d5435#rd";
            }
        }
    });


    $.getJSON('/jiang/myresult/'+lotteryId, function(data, status) {
        if (status == 'success')
        {
            if (!data.shared && data.gotten)
            {
                location.href = '/jiang/toshare/' + lotteryId;
            }
            else if (data.item_name != '谢谢惠顾')
            {
                $('#myResultName').text(data.item_name);
                $('#myResult').show();
            }
        }
    });


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
        $.getJSON('/jiang/get/' + lotteryId, function(data, status) {
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
                                $.get('/jiang/sendmsg/'+lotteryId);
                                location.href = '/jiang/toshare/' + lotteryId;
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
            if (data)
                for (var i = 0; i < data.length; i++)
                {
                    if (data[i].item_name != '谢谢惠顾')
                        list += '<p>' + data[i].name + ' 获得了 ' + data[i].item_name + '</p>'
                }
            if (list == '')
                list = '<p>现在还没有人中奖呢！快来吧，也许第一个中奖的就是你！</p>';
            $('#lotteryResult').html(list);
        }
    });
});