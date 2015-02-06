$(document).ready(function(){
	var loadContent = function (pj){
		var max = 0;
		for(var i = 1; i <= pj.length; i++){
			if(pj[i-1].vote_count > max){
				max = pj[i-1].vote_count;
			}
		}
		$("div.progress-bar").each(function(key,val){
			$(this).text(pj[key].vote_count);
			$(this).css("width", ( 10 + pj[key].vote_count / max * 90 )+ "%");
		});
	};
	$.ajax({
        type: "GET",
        dataType: "json",
        url: "/vote/activityresult?activityId=" + _activityId,
        success: function (msg) {
            loadContent(msg);
        },
        error: function (xhr, ts, e) {
            if (ts === "timeout") {
                alert("连接超时，请检查网络");
            }
            else if (ts === "error" || ts === "parseerror") {
                alert("获取失败：" + ts + " " + e.toString());
            }
        }
    });
});