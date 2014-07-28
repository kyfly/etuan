//获得创建报名的各项参数数据
$(document).ready(function(){
	$("#submit").click(function(){
		//预定义一个创建活动对象
		var createActivityJson={
			start_time:"",
			stop_time:"",
			limit_grade:"",
			name:"",
			theme:"",
			url:"",
			questions:[],
		};
		//获得报名终止时间
		createActivityJson.stop_time=$("#stoptime").val().toString().replace("T"," ")+":00";
		//获得年纪限制并且转换为五位二进制数
		var objLimit = document.getElementsByName("grade");
		for(var i = objLimit.length-1; i >= 0; i--){
			if(objLimit[i].checked === true){
				createActivityJson.limit_grade += "1";
			}
			else{
				createActivityJson.limit_grade += "0";
			}
		};
		//获得活动标题（貌似暂时不用，囧）
		//createActivityJson.name = $("#name").val();
		//获得地址链接的值
		createActivityJson.url = $("#url").val();
		//获得主题选择的值（老方法用于select的貌似不能用了）
		//createActivityJson.theme = $("#theme").val();
		var objTheme = document.getElementsByName("theme");
		for(var j = 0; j <= objTheme.length-1; j++){
			if(objTheme[j].checked === true && createActivityJson.theme === null){
				createActivityJson.theme = objTheme[j].value;
				break;
			}
		};
		//未完成的获取关于问题项目的定义
		/*
		var objQuestion = documnt.getElementsByName("question");
		for(var j = 0; j <= objQuestion.length; j++){
			var questionItem = {
				question_id:"",
				type:"",
				label:"",
				content:"",
			};
			questionItem.question_id = j + 1;
			createActivityJson.questions += questionItem;
		};
		*/
		//打包好发送格式的Json
		var sendJson = "{activityInfo:"+$.toJSON(createActivityJson)+"}";
		//dev阶段采用alert形式表示数据
		alert(sendJson);
		/*
		//利用Ajax把Json用POST上去
		$.ajax({
			type:"POST";
			url:"registration/createactivity";
			data:sendJson;
		});
		*/
	});
});