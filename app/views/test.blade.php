<!DOCTYPE html>
<html>
<head>
    <title>default title</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo URL::to('css/bootstrap.css');?>">
</head>
<body>
<div class='container'>
    <form method='post' action='/data/autoreply' role='form'>
   关键字 <input type='text' class='form-control' name='keyword' placehodler='please enter your username!'/>
   信息类型 <input type='text' class='form-control' name='msg_type' placehodler='please enter your username!'/>
   信息id <input type='text' class='form-control' name='msg_id' placehodler='please enter your username!'/>
   社团id <input type='text' class='form-control' name='org_uid' placehodler='please enter your username!'/>
   <input type='submit' class='form-control' placehodler='please enter your username!'/>

</div>
</body>
<script src="<?php echo URL::to('js/jquery-2.1.0.js');?>"></script>
<script src="<?php echo URL::to('js/bootstrap.js');?>"></script>
</html>