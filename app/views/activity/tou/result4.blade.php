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
        	width: 50%;
        }
		.modalBtn {
			border: none;
			background-color: inherit;
			color: #428BCA;
		}
		.modalBtn:hover {
			text-decoration: underline;
		}
		.schoolName {
			height: 60px;
			line-height: 60px;
			font-size: 18px;
			font-weight: bold;
		}
		.modal-footer {
			clear: both;
		}
		.description {
			margin-top: 15px;
			font-size: 15px;
		}
		.description > p {
			text-indent: 2em;
		}
		#big_pic > img {
			width: 100%;
			margin-top:15px;
		}
		@media screen and (min-width: 768px){
			.myft > .text-center {
				padding: 35px 0;
			}
		}
		@media screen and (max-width: 768px){
			.myft > .text-center > .container {
				padding: 0;
			}
			.myft > .text-center > .container > .col-md-4 {
				padding: 0;
			}	
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
  <div class="container">
    <div class="col-md-3 col-md-offset-2"><img  class="img-circle" style="width: 150px; height: 150px" src="http://img.kyfly.net/common/logo/hdubadge.png@300w.png" alt="学校LOGO"></div>
    <div class="col-md-4">
      <h3><strong>“最美母校”图文网络评比</strong></h3><br>
      <ul class="text-left">        
        <li>本次活动由杭电招生办主办</li>
        <li>投票时间：2月8日00:00 - 3月26日00:00</li>
        <li>每个微信号限投一次</li>
        <li>最多选择10所学校，否则无法提交</li>
        <li>点击学校名称可查看图文</li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
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


<!--模态框-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">学校介绍</h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-3"><img id="sch-logo" src="" width="60px" height="60px"></div>
        <div class="schoolName col-xs-9"><p id="title"></p></div>
        <div class="col-xs-12 description"><p id="description" class="intro"></p></div>
        <div id="big_pic"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
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
		$('#school-list').append("<tr><td class='firstTd'><button type='button' value='" + i + "' class='modalBtn' data-toggle='modal' data-target='#myModal'>" + schoolName[i-1] + "&nbsp;<span class='glyphicon glyphicon-new-window'></span></button></td><td class='secondTd'><div class='progress'><div class='progress-bar progress-bar-info'></div></div></td></tr>");
	  }
	  
	 $(".modalBtn").click(function(){

    $('#sch-logo').parent(".col-xs-3").show();
    var myvalue=$(this).val();
    $("#big_pic").empty();

    if(myvalue>75&&myvalue<82){
      $('#sch-logo').parent(".col-xs-3").hide();
    }

    $.getJSON('/vote/muxiao/intro_source/' + myvalue +'.json', function(data){
      $('#title').html(data.name);
      $('#description').html(data.description);
    });

    $('#sch-logo').attr('src', 'http://img.kyfly.net/etuan/vote/4/' + myvalue + '-0.jpg');
    $('#img').attr('src', 'http://img.kyfly.net/etuan/vote/4/1' + myvalue + '-0.jpg');
    $('#big_pic').attr('href', 'http://img.kyfly.net/etuan/vote/2/introduce/' + myvalue + '.jpg');

    var picNumber = [4,1,2,1,4,4,3,5,7,4,1,6,8,6,1,6,4,4,1,2,2,3,2,1,3,2,2,4,6,2,3,8,3,2,8,3,5,4,8,2,3,5,2,2,8,7,8,4,1,2,4,2,3,5,8,7,8,2,3,2,1,4,8,7,2,2,1,8,3,1,8,3,6,2,7,8,5,3,6,8,2,5,8,4,4,3,2,8];

    for(var i=1;i<picNumber[myvalue-1]+1;i++) {
      $('#big_pic').append("<img id='img' id='pic" + i + "' style='' src='http://img.kyfly.net/etuan/vote/4/" + myvalue + "-" + i + ".jpg'>");
    }
  });


	});
</script>
<script src="/js/touresult.js"></script>
</body>
</html>