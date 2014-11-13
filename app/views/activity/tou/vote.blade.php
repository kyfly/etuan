<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="<?php echo URL::to('/css/bootstrap.css'); ?>"/>
    <title>“时光之书”晚会投票反馈</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?18a33d5e0bee3d92c20e7173809e5cb4";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body>

<div class="text-center well well-sm">
    <div class="text-center"><img class="img-circle" src="<?php echo URL::to('/ticket/sgzs/pic/logo.jpg'); ?>" /></div>
    <h3>我最喜爱的节目评选</h3>
    <ul class="text-left">
        <li>投票时间：4月25日21:00 - 4月28日23:00</li>
        <li>每个微信号和学号限投一次</li>
        <li>必须选择3个节目，否则无法提交</li>
        <li>中奖名单将在投票结束后公布</li>
    </ul>
</div>

<div class="container-fluid">
    <table class="table table-striped">

        <input type="hidden" name="uid" id="uid" value="<?php echo $uid;?>">
        <tbody>
        <tr id="1">
            <td>1</td>
            <td>开场舞:《时间都去哪儿了》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="1"/></td>
        </tr>
        <tr>
            <td>2</td>
            <td>幼儿园合唱:《让我们荡起双桨》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="2"/></td>
        </tr>
        <tr>
            <td>3</td>
            <td>人偶舞:《童年不同样》</td>
            <td><input type="checkbox" name="item[]" onclick="check()"  value="3"/></td>
        </tr>
        <tr>
            <td>4</td>
            <td>舞蹈:《舞动青春》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="4"/></td>
        </tr>
        <tr>
            <td>5</td>
            <td>声优表演:《音为梦想》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="5"/></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Cups:《课间好时光》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="6"/></td>
        </tr>
        <tr>
            <td>7</td>
            <td>乐队表演:《Butterfly》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="7"/></td>
        </tr>
        <tr>
            <td>8</td>
            <td>警官学校表演:《九月军魂》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="8"/></td>
        </tr>
        <tr>
            <td>9</td>
            <td>主席团话剧:《时光之诗》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="9"/></td>
        </tr>
        <tr>
            <td>10</td>
            <td>全息剧:《超克的时空》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="10"/></td>
        </tr>
        <tr>
            <td>11</td>
            <td>歌曲串烧:《我为歌狂》</td>
            <td><input type="checkbox" name="item[]" onclick="check()" value="11"/></td>
        </tr>
        </tbody>
    </table>
</div>

<div class="well">
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <h4>当前已选：<strong id="current_choice">0</strong></h4>
        </div>
        <div class="col-xs-6 col-sm-3">
            <h4>需要选择：<strong>3</strong></h4>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <input type="text" class="form-control" id="sno" name="sno"
                       placeholder="请输入学号，凭此抽奖" onkeyup="check()">
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="code" name="code" placeholder="请输入验证码" onkeyup="check()">
                    <span class="input-group-btn">
                        <img src="<?php echo URL::to('/php/create_code.php') ?>" onclick="change_code()" id="code_img"/>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" id='btn' disabled>提交</button>
            </div>
        </div>
    </div>
</div>

</div>
<div>
    <a href="<?php echo URL::to('/index.html');?>">
        <p class="text-center">
            <img src="<?php echo URL::to('/pic/ituan-logo-25.png'); ?>"/>
            <strong> 团团一家提供技术支持</strong>
        </p>
    </a>
</div>
<script src="<?php echo URL::to('/js/jquery-2.1.0.min.js')?>"></script>
<script src="<?php echo URL::to('/js/zepto.min.js');?>"></script>
<script>

    if(<?php echo $time_state?>==1)
        alert('还没到投票时间呢');
    else if(<?php echo $time_state?> ==2)
        alert('投票时间已过');

    function check()
    {
        var sno = document.getElementById('sno');
        var code = document.getElementById('code');
        var item = document.getElementsByName('item[]');
        var sum = 0;
        for(var i=0;i<11;i++)
        {
            if(item[i].checked)
                sum++;
        }
        document.getElementById('current_choice').innerHTML = sum;
        if(sum==3&&code.value!=""&&sno.value!="")
            document.getElementById('btn').disabled = false;
        else
            document.getElementById('btn').disabled = true;
    }

    function change_code()
    {
        document.getElementById('code_img').src = "<?php echo URL::to('/php/create_code.php') ?>";
    }



    $(document).ready(function()
    {
       $("#btn").click(function()
       {
           item = new Array();
           x = document.getElementsByName('item[]');
           for(var i= 0,j=0;i<11;i++)
                if(x[i].checked)
                {
                    item[j] = x[i].value;
                    j++;
                }

           code = document.getElementById('code').value;
           uid = document.getElementById('uid').value;
           sno = document.getElementById('sno').value;

           var exp = new RegExp("^((0[8-9])|(1[0-3]))(\\d{6}|\\d{7})$");
           if (!exp.test(sno)) {
               alert("亲，你的学号输错了！");
           }

           $.post("vote/vote",
               {
                    sno:sno,
                    uid:uid,
                   code:code,
                   item:item
               },
               function(data,status){
                   if(status=='success')
                   {
                       change_code();
                       if(data==0)
                           alert("验证码不正确");
                       else if(data==1)
                           alert("暂时没用到");
                       else if(data==2)
                           alert("该学号已经投过票了");
                       else if(data==3)
                       {
                           alert("投票成功咯!");
                           window.location = "showvote";
                       }
                       else if(data==4)
                       {
                           alert("投票时间未到");
                       }
                       else if(data==5)
                       {
                           alert("投票时间已过");
                       }
                   }
               });
       });
    });
</script>
</body>
</html>