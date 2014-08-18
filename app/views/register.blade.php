<!DOCTYPE html>
<html>
<head>
	<title>default title</title>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<body>
	<div class='container'>
		<form method='post' action='register' role='form'>
			<div class='form-group'>
				<label for='username'>邮箱</label>
				<input type='text' class='form-control' name='email' placehodler='please enter your username!'/>
			</div>
			<div class='form-group'>
				<label for='password'>密码</label>
				<input type='text' class='form-control' name='password' placehodler='please enter your password!'/>
			</div>
			<div class='form-group'>
				<label for='phone_long'>长号</label>
				<input type='text' class='form-control' name='phone_long' placehodler='please enter your password!'/>
			</div>
			<div class='form-group'>
				<label for='phone_short'>短号</label>
				<input type='text' class='form-control' name='phone_short' placehodler='please enter your password!'/>
			</div>
			<input type='submit' value='注册' class='btn btn-default'/>
		</form>
	</div>
</body>
<script src="<?php echo URL::to('js/jquery-2.1.0.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>