<html>
<head>
<title>报名结果</title>
<style>

    .logo {
        text-align: right;
    }

    .logo > img {
        height: 15px;
    }

    .question {
        text-align: right;
        width: 25%;
    }

    .space {
        text-align: center;
        color: #a8a8a8;
        width: 2%;
    }

    .answer {
        width: 73%;
    }

    .colorGray {
        background-color: #f6f6f6;
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
<table>
<tbody>
@foreach($answers as $key=>$answer)
    <tr class="@if(!($key%2)) colorGray @endif">
        <td class="question">{{$results['questions'][$key]}}</td>
        <td class="space">|</td>
        <td class="answer">{{$answer}}</td>
    </tr>
@endforeach
</tbody>
</table>
</body>
</html>