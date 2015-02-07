<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="杭州电子科技大学,杭电,团团一家,杭电报名招新,杭电抢票,杭电投票,社团服务">
    <meta name="description" content="团团一家是杭电活动服务平台，这里有最新全的组织招新报名、最新的组织活动入口，还有令学校沸腾的抢票、投票活动！">
    <link rel="stylesheet" href="http://cdn.kyfly.net/lib/css/bootstrap.min.css">
    <title>“最美母校”图文网络评比</title>
    <link rel="icon" href="/etuan_logo.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/etuan_logo.ico" type="image/x-icon">
    <style>
        .myft {
            font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
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
        <li>投票时间：2月8日00:00 - 3月26日00:00</li>
        <li>每个微信号限投一次</li>
        <li>最多选择10所学校，否则无法提交</li>
        <li>点击学校名称查看图文</li>
      </ul>
    </div>
  </div>
</div>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>序号</th>
                <th>&nbsp;学校</th>
            </tr>
        </thead>
        <tbody id="school-list">
        </tbody>
    </table>
</div>


<div class="well">
    <div class="container">
        <div class="col-xs-12 col-sm-3">
            <h4>当前已选：<strong id="current_choice">0</strong></h4>
        </div>
        <div class="col-xs-12 col-sm-3">
            <h4>最多可选：<strong>10</strong></h4>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" id='submit'>提 交</button>
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

<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script>
	var _activityId = 4;
	var _type = "text";
	var _total_item = 88; 
	var _limit_choice = 10;
</script>
<script src="/js/vote4.js"></script>
<script src="/js/touparticipator.js"></script>
</body>
</html>