<!DOCTYPE html>
<html>
<head>
    <title>default title</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<script type="text/javascript">
function weixinShareTimeline(){
	WeixinJSBridge.invoke('shareTimeline',{
		"title":"dhff",
		"desc":"dcfas",
	});	
}
</script>>
<body>
<div class='container'>
    <button onclick="weixinShareTimeline()">diandf</button>>
</div>
</body>
<script src="<?php echo URL::to('js/weixinapi.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>