<html>
<head>
<title>报名结果</title>
<style>
    body {
        font-family: "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", tahoma, arial, simsun, "宋体";
    }

    .logo {
        text-align: right;
    }

    .logo > img {
        height: 15px;
    }

    .question {
        margin: 0;
        padding: 0;
        background-color: #d4d4d4
    }

    .answer {
        margin: 0;
    }

    .title {
        text-align: center;
        font-size: 18px;
    }
</style>
</head>
<body>
<div class="title">{{$title}}</div>
<div class="logo">
    <img src="http://img.kyfly.net/common/logo/etuan-logo-word.jpg@90h_100Q.jpg">
    <span class="support">提供技术支持</span>
</div>
@foreach($answers as $key=>$answer)
   <div class="question">{{$results['questions'][$key]}}</div>
   <div class="answer">{{$answer}}</div>
@endforeach
</body>
</html>