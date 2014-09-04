$(document).ready(function () {
    function setHeight() {
        var height1 , height2 , maxheight;
        height1 = $('#extraform').outerHeight(true);
        height2 = $('.extralist').outerHeight(true);
        if (height1 > height2) {
            maxheight = height1;
        }
        else {
            maxheight = height2;
        }
        $('#addform').css('height', maxheight + 130 + "px");
        $('#sidebar').height($('#main').outerHeight(true));
    };
    function configExtraForm(){
        //每次绑定事件前首先释放所有的click以免造成过度绑定
        $(".delete").off("click");
        $(".moveup").off("click");
        $(".movedown").off("click");
        $(".delete").off("mouseover");
        $(".moveup").off("mouseover");
        $(".movedown").off("mouseover");
        //删除按钮
        $(".delete").on('click',function () {
            var content0;
            content0 = $(this).parent();
            content0.remove();
        });
        $(".delete").on("mouseover",function(){
            $(this).tooltip("show");
        });
        //上移按钮
        $(".moveup").on("click",function () {
            var content1;
            content1 = $(this).parent();
            content1.insertBefore(content1.prev());
        });
        $(".moveup").on("mouseover",function(){
            $(this).tooltip("show");
        });
        //下移按钮
        $(".movedown").on("click",function () {
            var content2;
            content2 = $(this).parent();
            content2.insertAfter(content2.next());
        });
        $(".movedown").on("mouseover",function(){
            $(this).tooltip("show");
        });
    };
    setHeight();
    configExtraForm();
    //添加元素到左边
    $(".target .extralist h4:not(:contains(\"自定义\"))").click(function (e) {
        var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&emsp;&emsp;&emsp;&emsp;&ensp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
        $("#extraform").append(content);
        setHeight();
        configExtraForm();
    });
    $("#zidingyishort2,#zidingyilong2").click(function(e){
        var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&ensp;<input type=\"text\" placeholder=\"请输入问题描述\">&emsp;&emsp;&emsp;&emsp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
        $("#extraform").append(content);
        setHeight();
        configExtraForm();
    });
    //主题选择动画
    $(".theme").mouseover(function(){
        $(this).prop("src",$(this).prop("src").toString().replace("0.png","1.png"));
    });
    $("img").mouseout(function(){
        $(this).prop("src",$(this).prop("src").toString().replace("1.png","0.png"));
    });
});

//获得创建报名的各项参数数据
$(document).ready(function(){
    //函数将标签转化为类型
    var label2type = function(labelstr){
        var typeback = 0;
        switch(labelstr){
            case "学号":
                typeback = 101;
                break;
            case "姓名":
                typeback = 102;
                break;
            case "性别":
                typeback = 103;
                break;
            case "学院":
                typeback = 104;
                break;
            case "专业":
                typeback = 105;
                break;
            case "特长":
                typeback = 106;
                break;
            case "电子邮箱":
                typeback = 107;
                break;
            case "QQ":
                typeback = 108;
                break;
            case "手机长号":
                typeback = 109;
                break;
            case "手机短号":
                typeback = 110;
                break;
            case "籍贯":
                typeback = 111;
                break;
            case "第一意向部门":
                typeback = 112;
                break;
            case "第二意向部门":
                typeback = 113;
                break;
            case "第三意向部门":
                typeback = 114;
                break;
            case "是否服从调剂":
                typeback = 115;
                break;
            case "自定义短问题":
                typeback = 1;
                break;
            case "自定义长问题":
                typeback = 2;
                break;
            default:
                typeback = 0;
                break;
        };
        return typeback;
    };
    $("#preview").click(function(){
        var previewWindow = window.open("about:blank");
        previewWindow.document.title = $("#regname").val();
        previewWindow.document.write("预览功能正在开发中~");
    });
	$("#submit").click(function(){
        //检查时间前后的对比
        var IsTimeLater = function(dateA,dateB){
            return dateA < dateB ? true : false;
        };
		//预定义一个创建活动对象
		var createActivityJson={
			start_time:"",
			stop_time:"",
			limit_grade:"",
			name:"",
			theme:"",
			url:"",
			questions:[]
		};
        var arrayStartTime = $("#starttime").val().toString().split(/[\s:-]/);
        var arrayStopTime = $("#stoptime").val().toString().split(/[\s:-]/);
        var dateStartTime = new Date(parseInt(arrayStartTime[0]),parseInt(arrayStartTime[1])-1,parseInt(arrayStartTime[2]),parseInt(arrayStartTime[3]),parseInt(arrayStartTime[4]),0);
        var dateStopTime = new Date(parseInt(arrayStopTime[0]),parseInt(arrayStopTime[1])-1,parseInt(arrayStopTime[2]),parseInt(arrayStopTime[3]),parseInt(arrayStopTime[4]),0);
        var IsTimeOutOfBound = IsTimeLater(new Date(2014,8,4,0,0,0),dateStartTime);
        var IsStopTimeBeforeStartTime = IsTimeLater(dateStartTime,dateStopTime);
        if (IsStopTimeBeforeStartTime && IsTimeOutOfBound){
            //获得报名终止时间
            createActivityJson.start_time=""+dateStartTime.getFullYear()+"-"+dateStartTime.getMonth()+"-"+dateStartTime.getDate()+" "+dateStartTime.getHours()+":"+dateStartTime.getMinutes()+":"+dateStartTime.getSeconds();
		    //获得报名终止时间
		    createActivityJson.stop_time=""+dateStopTime.getFullYear()+"-"+dateStopTime.getMonth()+"-"+dateStopTime.getDate()+" "+dateStopTime.getHours()+":"+dateStopTime.getMinutes()+":"+dateStopTime.getSeconds();
        }
        //获得年纪限制并且转换为五位二进制数
		var objLimit = document.getElementsByName("grade");
		for(var i = objLimit.length-1; i >= 0; i--){
			if(objLimit[i].checked === true){
				createActivityJson.limit_grade += "1";
			}
			else{
				createActivityJson.limit_grade += "0";
			}
		}
		//获得报名标题的值
		createActivityJson.name = $("#regname").val();
        //获得主题选择的值
        var objTheme = document.getElementsByName("theme");
        for(var j = 0; j < objTheme.length; j++){
            if(objTheme[j].checked === true){
                createActivityJson.theme = objTheme[j].value;
            }
        }
        //将问题依次添加进其中
 		var objQuestion = document.getElementsByClassName("baomingitem");
		for(var j = 0; j < objQuestion.length; j++){
			var questionItem = {
				question_id:"",
				type:"",
				label:"",
				content:""
			};
			questionItem.question_id = j + 1;
            var thisType = label2type(objQuestion[j].innerText);
            questionItem.type = thisType;
            if(thisType===1 || thisType===2 || thisType===3){
                questionItem.label = objQuestion[j].parentNode.childNodes[2].value;
            }
            else{
                questionItem.label = objQuestion[j].innerText;
            }
            questionItem.content = "";
			createActivityJson.questions[j] = questionItem;
		};
		//打包好发送格式的Json
        var sendJson = {activityInfo:JSON.stringify(createActivityJson)};
		//dev阶段采用alert形式表示数据
		console.log(sendJson);
		//利用Ajax把Json用POST上去
		$.ajax({
			type:"POST",
			url:"/registration/createactivity",
			data:sendJson
		});
	});
});