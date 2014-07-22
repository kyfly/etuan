<!DOCTYPE html>
<html>
<head>
	<title>default title</title>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<body>
	<div class='container'>
		<form method='post' action='message' role='form'>
			<div class='form-group'>
				<label for='to_org_uid'>发给谁</label>
				<input type='text' class='form-control' name='to_org_uid' placehodler='please enter your to_org_uid!'/>
			</div>
			<div class='form-group'>
				<label for='title'>标题</label>
				<input type='text' class='form-control' name='title' placehodler='please enter your title!'/>
			</div>
			<div class='form-group'>
				<label for='content'>内容</label>
				<input type='text' class='form-control' name='content' placehodler='please enter your content!'/>
			</div>
			<input type='submit' value='发送' class='btn btn-default'/>
		</form>
	</div>
</body>
<script src="<?php echo URL::to('js/jquery-2.1.0.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>