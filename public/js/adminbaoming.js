//获得创建报名的各项参数数据
$(document).ready(function(){
	$("#submit").click(function(){
        //检查时间前后的对比，时间格式"2014/09/25 08:05".replace(" ","/").replace(":","/"),split("/");
        var IsTimeBefore = function(strTimeA,strTimeB){
            var timeA = strTimeA.split(/[\s/:]/);
            var timeB = strTimeB.split(/[\s/:]/);

            return ;
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
        //获得报名终止时间
        createActivityJson.start_time=$("#starttime").val().toString().replace("/","-")+":00";
		//获得报名终止时间
		createActivityJson.stop_time=$("#stoptime").val().toString().replace("/","-")+":00";
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
		//获得地址链接的值
		createActivityJson.url = $("#url").val();
		//获得主题选择的值（老方法用于select的貌似不能用了）
		var objTheme = document.getElementsByName("theme");
		for(var j = 0; j <= objTheme.length-1; j++){
			if(objTheme[j].checked === true && createActivityJson.theme === null){
				createActivityJson.theme = objTheme[j].value;
				break;
			}
		}
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
            questionItem.type = label2type(objQuestion[j].innerText);
            questionItem.label = objQuestion[j].innerText;
            questionItem.content = "";
			createActivityJson.questions[j] = questionItem;
		};
		//打包好发送格式的Json
        var sendJson = {activityInfo:JSON.stringify(createActivityJson)};
		//！！！！！！dev阶段采用alert形式表示数据
		console.log(sendJson);
		//利用Ajax把Json用POST上去
		$.ajax({
			type:"POST",
			url:"registration/createactivity",
			data:sendJson
		});
	});
});