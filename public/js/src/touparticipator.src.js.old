$(document).ready(function(){
    $.ajax({
        type:"GET",
        url:"/vote/check-already-par?activityId="+1,
        success:function (e) {
            if (e === "0"){
            }
            else if (e === "1"){
                window.location.href = "/tou/result/1";
            }
            else {
                window.location.href = "/tou/result/1";
            }
        },
        error: function (xhr, ts, e) {
            if (ts === "timeout") {
                alert("连接超时，请检查网络");
            }
            else if (ts === "error" || ts === "parseerror") {
                alert("失败：" + ts + " " + e.toString());
            }
        }
    });
    $('#current_choice').text($('input.checkbox:checked').length);
    $("input.checkbox").click(function(){
        if($('input.checkbox:checked').length > 3){
            alert("当前所选已达上限");
            $(this).prop("checked",false);
        }
        $('#current_choice').text($('input.checkbox:checked').length);
    });
    $("#submit").click(function()
    {   
        if($('input.checkbox:checked').length === 0){
            alert("你还没有做出自己的选择呢");
        }
        else{
            var participatorInfo = {
                choices:[]
            };
            $('input.checkbox:checked').each(function(key,valu){
                participatorInfo.choices[key] = $(this).val();
            });
            var sendJson = {
                activityId:1,
                participatorInfo:JSON.stringify(participatorInfo)
            };
            $.ajax({
                type: "POST",
                url: "/vote/participateinactivity",
                data: sendJson,
                dataType: "json",
                success: function (e) {
                    if (e.status === "success") {
                        alert(e.content);
                        window.location.href = "/tou/result/1";
                    }
                    else if (e.status === "fail") {
                        alert(e.content);
                    }
                },
                error: function (xhr, ts, e) {
                    if (ts === "timeout") {
                        alert("连接超时，请检查网络");
                    }
                    else if (ts === "error" || ts === "parseerror") {
                        alert("提交失败：" + ts + " " + e.toString());
                    }
                }
            });
        }   
    });
});