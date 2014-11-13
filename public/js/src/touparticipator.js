$(document).ready(function(){
    $(".checkbox").click(function(){
        
    });
    $("#btn").click(function()
    {
        var participatorInfo = {
            "choices":[]
        };
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
                alert(e.content);
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
    });
});