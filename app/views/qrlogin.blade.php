<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>二维码登录</title>
</head>
<body>


<img src= "http://www.etuan.local/weixin/login/code">
{{$token}}
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script>
    var token = "{{$token}}";
    function checkStatus()
    {
        $.get("/weixin/login/check", {state : token}, function (data, status) {
            if (data != "false" && status == "success")
                window.location.href = data;
        });
    }

    $(document).ready(
        setInterval("checkStatus()", 1000)
    )
</script>
</body>
</html>