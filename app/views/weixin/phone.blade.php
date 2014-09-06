<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>团团一家 - 正在登录中...</title>
    <style>
        body {
            background-color: #f0f0f0;
            text-align: center;
            padding-top: 150px;
        }
    </style>
</head>
<body>
<h2><img src="/img/waiting.gif">&nbsp;正在登录中...</h2>
<script src="http://cdn.kyfly.net/lib/js/jquery.min.js"></script>
<script>
    var token = "{{$token}}";
    var user = "{{$user}}";
    function checkStatus()
    {
        $.get("/weixin/login/wcheck", {state : token,user : user}, function (data, status) {
            if (data == "true" && status == "success")
            {
                window.location.href='/weixin/login/suc';
            }
        });
    }

    $(document).ready(
        timer = setInterval("checkStatus()", 1000)
    )
</script>
</body>
</html>