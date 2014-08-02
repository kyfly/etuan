<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>d</title>
</head>
<body>


{{$value}}
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script>
    var token = "{{$token}}";
    var user = "{{$user}}";
    function checkStatus()
    {
        $.get("/weixin/login/wcheck", {state : token,user : user}, function (data, status) {
            if (data == "true" && status == "success")
            {
                alert(data);  //该视图作为微信客户端登陆成功后显示页面。这里只实现功能，其他请前段完成。
                clearInterval(timer);
            }
                
        });
    }

    $(document).ready(
        timer = setInterval("checkStatus()", 1000)
    )
</script>
</body>
</html>