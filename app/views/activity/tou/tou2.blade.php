<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>投票</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/toupiao.css" rel="stylesheet">
</head>
<body>
	<!--head-->
    <div class="text-center well well-sm">
        <div class="text-center">
            <img  class="img-circle" style="width: 150px; height: 150px" src="http://img.kyfly.net/common/logo/hdubadge.png@200w.png" alt="">
        </div>
        <h3><strong>*****投票</strong></h3>
        <ul class="text-left">
            <li>投票时间：**月**日00:00~**月**日00:00</li>
            <li>每个微信号限投一次</li>
            <li>最多选择****，否则无法提交</li>
            <li>最终投票结果将在****公布</li>
        </ul>
    </div>
    <!--内容-->
    <div id="main" class="container">
    	<div class="well">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="thumbnail" id="box1">
                   <img src="http://img.kyfly.net/common/logo/hdubadge.png@200w.png" height="150px" width="150px">
                   <a href="#"><img class="viewintro" alt="查看简介" src="img/intro.png"></a>
                   <h4>张三</h4>
                   <p>2013届计算机学院</p>
                   <div class="chosen">
                      <div class="mask2"></div>
                      <img class="chooseimg" alt="已选择" src="img/choose.png">
                   </div>
                   <button id="option1" class="btn btn-warning btn-block choosebtn">点击选定</button>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="thumbnail" id="box2">
                    <img src="http://img.kyfly.net/common/logo/hdubadge.png@200w.png" height="150px" width="150px">
                    <a href="#"><img class="viewintro" alt="查看简介" src="img/intro.png"></a>
                    <h4>张三</h4>
                    <p>2013届计算机学院</p>
                    <div class="chosen">
                       <div class="mask2"></div>
                       <img class="chooseimg" alt="已选择" src="img/choose.png">
                    </div>
                    <button id="option2" class="btn btn-warning btn-block choosebtn">点击选定</button>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="thumbnail" id="box3">
                    <img src="http://img.kyfly.net/common/logo/hdubadge.png@200w.png" height="150px" width="150px">
                    <a href="#"><img class="viewintro" alt="查看简介" src="img/intro.png"></a>
                    <h4>张三</h4>
                    <p>2013届计算机学院</p>
                    <div class="chosen">
                       <div class="mask2"></div>
                       <img class="chooseimg" alt="已选择" src="img/choose.png">
                    </div>
                    <button id="option3" class="btn btn-warning btn-block choosebtn">点击选定</button>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="thumbnail" id="box4">
                    <img src="http://img.kyfly.net/common/logo/hdubadge.png@200w.png" height="150px" width="150px">
                    <a href="#"><img class="viewintro" alt="查看简介" src="img/intro.png"></a>
                    <h4>张三</h4>
                    <p>2013届计算机学院</p>
                    <div class="chosen">
                       <div class="mask2"></div>
                       <img class="chooseimg" alt="已选择" src="img/choose.png">
                    </div>
                    <button id="option4" class="btn btn-warning btn-block choosebtn">点击选定</button>
                </div>
            </div>
            
            <div class="clearfix"></div>
          <div class="row">
                <div class="col-xs-6 col-sm-3">
                    <h4>当前已选：<strong id="current_choice">0</strong></h4>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <h4>最多可选：<strong>3</strong></h4>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" id='submit'>提 交</button>
                    </div>
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

<!--置顶-->
<div class="btn backtop" id="scrollUp" title="TOP" style="position: fixed; display: block;"></div>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script src="http://cdn.kyfly.net/lib/js/bootstrap.min.js"></script>
<script src="/js/touparticipator.js"></script>
<script>
	_activityId = 2;
</script>
</body>
</html>
