// JavaScript Document

$(document).ready(function () {

	$(window).scroll(toggleScrollTopImg);

	$('#scrollUp').click(function () {
		scrollTopTimer = setTimeout("scrollTop()", 10);
	});

	var flag = new Array();
	var _checked_item = 0;

	for(var i = 0; i < _total_item;i++){
		flag[i] = 0;
	}

	if(_type == "pic"){
		$(".choosebtn").click(function () {
			var idval = $(this).attr("id");
			var num = idval.substr(6,2);
			if (flag[num-1] == 0) {
				flag[num-1] = 1;
				$(this).parent(".thumbnail").css('border', '1px solid #a8d154');
				$(this).prev(".chosen").css('display', 'block');
				var x = document.getElementById(idval);
				x.innerHTML = "点击取消";
				_checked_item ++;
				$('#current_choice').text(_checked_item);
			} else {
				flag[num-1] = 0;
				$(this).parent(".thumbnail").css('border', '1px solid #ddd');
				$(this).prev(".chosen").css('display', 'none');
				var x = document.getElementById(idval);
				x.innerHTML = "点击选定";
				_checked_item --;
				$('#current_choice').text(_checked_item);
			}
		});
	}else if (_type == "text"){
		$("input.checkbox").click(function(){
			var num2 = $(this).attr("value");
			if (flag[num2-1] == 0) {
				flag[num2-1] = 1;
				_checked_item ++;
			}else {
				flag[num2-1] = 0;
				_checked_item --;
			}
			$('#current_choice').text(_checked_item);
		});
	}
	
	$("#submit").click(function()
    {   
        if(_checked_item == 0){
            alert("你还没有做出自己的选择呢");
        }else if(_checked_item > _limit_choice){
            alert("当前所选已经超过" + _limit_choice + "个");
        }else{
            var participatorInfo = {
                choices:[]
            };
			
			for(var i = 0; i < _total_item;i++){
				if(flag[i] == 1){
					participatorInfo.choices.push(i+1);
				}
			}
			
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
        type: 'GET',
        url: '/oauth/checksub',
        success: function (data) {
            if (data !== '1')
                window.location.href = "http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=202239029&idx=1&sn=b1cb7de21413986193491c008b0d5435#rd";
        }
    });

	$.ajax({
        type:"GET",
        url:"/vote/check-already-par?activityId="+_activityId,
        success:function (e) {
            if (e !== "0") {
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
