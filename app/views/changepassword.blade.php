<!DOCTYPE html>
<html>
<head>
	<title>default title</title>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<body>
	<div class='container'>
		<form method='post' action='changepassword' role='form'>
			<div class='form-group'>
				<label for='username'>旧密码</label>
				<input type='text' class='form-control' name='oldPassword' placehodler='please enter your username!'/>
			</div>
			<input type='hidden' value='<?php echo csrf_token();?>' name='_token'>
			<div class='form-group'>
				<label for='password'>新密码</label>
				<input type='text' class='form-control' name='newPassword' placehodler='please enter your password!'/>
			</div>
			<input type='submit' value='修改密码' class='btn btn-default'/>
		</form>
	</div>
</body>
<script src="<?php echo URL::to('js/jquery-2.1.0.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>