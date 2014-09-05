$(document).ready(function(){
    //预用函数
    //随机颜色生成器
    function randomColorPick(num){
        var pickPool = ["rgb(204, 204, 102)","rgb(204, 102, 102)","rgb(204, 102, 204)","rgb(102, 102, 204)","rgb(102, 204, 204)","rgb(102, 204, 102)"];
        var rdm = parseInt(Math.random()*1000);
        var a = pickPool[rdm%6];
        if(num !== 1){
            var c = $("#type"+(num-1).toString()).css("background-color");
            if(a===c){
                a = pickPool[(rdm+1)%6];
            }
        }
        return a;
    }
    //单双行判断
    function IsSingle(tn){
        return (tn !== "textarea");
    }

    //控制css样式生成
    //$("#title")[0].innerText = document.title;
    var titletext = document.createTextNode(" "+document.title);
    var titlelogo = document.createElement("img");
    titlelogo.setAttribute("id","titlelogo");
    titlelogo.setAttribute("class","img-rounded");
    titlelogo.setAttribute("src","../img/avatar.jpg");
    titlelogo.setAttribute("alt",document.title);
    document.getElementById("title").appendChild(titlelogo);
    document.getElementById("title").appendChild(titletext);
    $("#regform").addClass("clearfix");
    var n = $("#regform").children().length;
    for(var i = 1; i <= n; i++){
        var questionid = "#question" + i.toString();
        var typeid = "#type" + i.toString();
        var introid = "#intro" + i.toString();
        var contentid = "#content" + i.toString();
        var answerid = "#answer" + i.toString();
        var randomColor = randomColorPick(i);
        $(questionid).addClass("strip");
        $(typeid).addClass("col-xs-12").addClass("no-padding").addClass("cover");
        $(contentid).addClass("col-xs-12").addClass("no-padding").addClass("blank");
        $(typeid).css("background-color",randomColor);
        if(IsSingle($(answerid)[0].tagName.toLowerCase())){
            $(questionid).addClass("single-line");
            $(typeid).addClass("single-line");
            $(contentid).addClass("single-line");
            $(answerid).addClass("intro-single-input");
        }
        else{
            $(questionid).addClass("double-line");
            $(typeid).addClass("double-line");
            $(contentid).addClass("double-line");
            $(answerid).addClass("intro-double-input");
        }
    }
    $("#regbutton").mouseover(function(){$(this).css("background-color","#f66")});
    $("#regbutton").mouseout(function(){$(this).css("background-color","#66f")});
    //控制覆盖层面
	$(".blank").hide();
	$(".strip").click(function(){
		$(".blank").hide();
		$(".cover").show();
		$(this).find(".blank").show();
		$(this).find(".cover").hide();
		$(this).find(".blank").find("input").focus();
		$(this).find(".blank").find("textarea").focus();
	});
});