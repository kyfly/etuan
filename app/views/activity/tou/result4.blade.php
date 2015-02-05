<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="杭州电子科技大学,杭电,团团一家,杭电报名招新,杭电抢票,杭电投票,社团服务">
    <meta name="description" content="团团一家是杭电活动服务平台，这里有最新全的组织招新报名、最新的组织活动入口，还有令学校沸腾的抢票、投票活动！">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css">
    <title>投票结果</title>
    <link rel="icon" href="/etuan_logo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/etuan_logo.ico" type="image/x-icon">
    <style>
        .myft {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
        }
        .firstTd {
        	width: 40%;
        }
    </style>
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
            hm.src = "//hm.baidu.com/hm.js?76a5edb5c9902d7c2e38f7a723060cff";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>

<body class="myft">
<div class="text-center well well-sm">
    <div class="text-center">
        <img  class="img-circle" style="width: 150px; height: 150px" src="http://img.kyfly.net/common/logo/hdubadge.png@300w.png" alt="学校LOGO">
    </div>
    <h3><strong>“最美母校”图文网络评比</strong></h3>
    <ul class="text-left">
        <li>投票时间：2月8日00：00 - 3月26日00：00</li>
        <li>每个微信号限投一次</li>
        <li>最多选择10所学校，否则无法提交</li>
        <li>点击学校名称查看图文</li>
    </ul>
</div>

<div class="container-fluid">
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="firstTd">学校</th>
            <th class="secondTd">票数</th>
        </tr>
        </thead>
            <tbody id="school-list">
            </tbody>
    </table>
</div>

<div class="col-xs-12">
    <h4 class="text-center">
        <a href="http://www.etuan.org/">
            <img src="http://img.kyfly.net/common/logo/etuan-logo-word.png@40h.png" height="20px">
        </a>
        &nbsp;提供技术支持
    </h4>
</div>

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script>
	var _activityId = 4;
	
	$(document).ready(function() {
	  var schoolName = ['莱州市第一中学', '侯马一中', '勉县第一中学', '虹桥中学', '浙江省黄岩中学', '海盐高级中学', '福建三明一中', '开化中学', '衢州二中', '浙江省苍南中学', '嘉善高级中学', '浙江省严州中学', '丽水中学', '同煤一中', '春晖中学', '鄞州高中', '新昌中学', '德宏州民族一中', '绵阳中学', '东阳中学', '宜春中学', '宁波二中', '江西师大附中', '河南商丘一高', '河北定州中学', '东阳中学', '柴桥中学', '杭州第四中学', '萧山中学', '浒山中学', '萧山二中', '石家庄精英中学', '缙云中学', '乐清中学', '平顶山一中', '安吉振民高级中学', '浦江中学', '北仑中学', '牌头中学', '海宁市高级中学', '忻州市第一中学 ', '华茂外国语学校高中', '肥东第一中学', '柯桥中学', '台州市第一中学', '灵丘一中', '天台育青中学', '湖州市第二中学', '瓯海区第一中学', '德清一中', '崧厦中学', '大同一中', '松阳县第一中学', '台州中学', '牌头中学', '凤鸣高级中学', '罗浮中学', '余杭第二高级中学', '襄阳市第五中学', '桐乡一中', '嘉兴市第五高级中学', '秀州中学', '草塔中学', '路桥中学', '吴兴高级中学', '兰溪市第三中学', '萧山第五高级中学', '包钢一中', '於潜中学', '越崎中学', '澄潭中学', '海宁市第一中学', '达州市第一中学', '马寅初中学', '会泽县茚旺高级中学', '龙泉市第一中学', '商城高级中学', '赤峰市红旗中学', '经纬中学', '敦煌中学', '南马高中', '南康中学', '仁寿一中', '丹东市第二中学', '东阳二中', '东阳市中天高中', '永康二中', '永康一中'];
	
	  for(var i=1;i<89;i++){
		$('#school-list').append("<tr><td class='firstTd'>" + schoolName[i-1] + "</td><td class='secondTd'><div class='progress'><div class='progress-bar progress-bar-info'></div></div></td></tr>");
	  }

	});
</script>
<script src="/js/touresult.js"></script>
</body>
</html>