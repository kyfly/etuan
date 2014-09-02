<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>d</title>
</head>
<body>
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