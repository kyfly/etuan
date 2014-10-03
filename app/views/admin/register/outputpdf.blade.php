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
        background-color: #ebebeb
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
<div class="logo">
    <img src="{{URL::to('img/support.png')}}">
</div>
<div class="title">{{$title}}</div>
<br>
@foreach($answers as $key=>$answer)
   <div class="question">{{$results['questions'][$key]}}</div>
   <div class="answer">{{$answer}}</div>
@endforeach
</body>
</html>