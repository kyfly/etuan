// JavaScript Document

$(document).ready(function () {

	$(window).scroll(toggleScrollTopImg);

	$('#scrollUp').click(function () {
		scrollTopTimer = setTimeout("scrollTop()", 10);
	});

	var flag = new Array();
	var checkeditem = 0;

	for(var i = 0; i < 30;i++){
		flag[i] = 0;
	}

	$(".choosebtn").click(function () {
		var idval = $(this).attr("id");
		var num = idval.substr(6,2);
		if (flag[num-1] == 0) {
			flag[num-1] = 1;
			$(this).parent(".thumbnail").css('border', '1px solid #a8d154');
			$(this).prev(".chosen").css('display', 'block');
			var x = document.getElementById(idval);
			x.innerHTML = "点击取消选定";
			checkeditem ++;
			$('#current_choice').text(checkeditem);
		} else {
			flag[num-1] = 0;
			$(this).parent(".thumbnail").css('border', '1px solid #ddd');
			$(this).prev(".chosen").css('display', 'none');
			var x = document.getElementById(idval);
			x.innerHTML = "点击选定";
			checkeditem --;
			$('#current_choice').text(checkeditem);
		}
	});
	
	$("#submit").click(function()
    {   
        if(checkeditem === 0){
            alert("你还没有做出自己的选择呢");
        }else if(checkeditem > 3){
            alert("当前所选已经超过三个");
        }else{
            var participatorInfo = {
                choices:[]
            };
            $('input.checkbox:checked').each(function(key,valu){
                participatorInfo.choices[key] = $(this).val();
            });
            var sendJson = {
                activityId:_activityId,
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
                        window.location.href = "/tou/result/"+_activityId;
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
	
	$.ajax({
        type:"GET",
        url:"/vote/check-already-par?activityId="+_activityId,
        success:function (e) {
            if (e === "0"){
            }
            else if (e === "1"){
                window.location.href = "/tou/result/"+_activityId;
            }
            else {
                window.location.href = "/tou/result/"+_activityId;
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
	
});

function toggleScrollTopImg() {
	if ($(document).scrollTop() > 0)
		$('#scrollUp').show();
	else
		$('#scrollUp').hide();
};

function scrollTop() {
	var posNow = $(document).scrollTop();
	var scrollStep = 300;
	if (posNow > 0) {
		window.scroll(0, posNow - scrollStep);
		scrollTopTimer = setTimeout("scrollTop()", 10);
	}
	else {
		clearTimeout(scrollTopTimer);
	}
};
