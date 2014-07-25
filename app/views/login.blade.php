<!DOCTYPE html>
<html>
<head>
	<title>default title</title>
	<meta charset="utf-8"> 
	<link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<body>
	<?php echo "<img  src=$imgurl>";
	echo $token;?>
</body>
<script src="<?php echo URL::to('js/jquery-2.1.0.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>