<html>
<head>
<title>报名结果</title>
<style>
    .question {
        text-align: right;
        width: 30%;
    }

    .space {
        text-align: center;
        color: #a8a8a8;
        width: 2%;
    }

    .answer {
        width: 68%;
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