$(document).ready(function(){
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
    //奇偶行判断
    function IsLight(num){
        return (num%2 === 0);
    }
    //单双行判断
    function IsSingle(tn){
        return (tn !== "textarea");
    }
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
    if(IsLight(n+1)){
        $("#regbutton").addClass("light-blank");
        $("#regfooter").addClass("dark-blank")
    }
    else{
        $("#regbutton").addClass("dark-blank");
        $("#regfooter").addClass("light-blank");
    }
    for(var i = 1; i <= n; i++){
        var questionid = "#question" + i.toString();
        var typeid = "#type" + i.toString();
        var introid = "#intro" + i.toString();
        var contentid = "#content" + i.toString();
        var answerid = "#answer" + i.toString();
        var randomColor = randomColorPick(i);
        $(contentid).addClass("col-xs-9").addClass("form-group");
        $(typeid).addClass("col-xs-3").addClass("no-padding");
        $(answerid).addClass("transparent-div").addClass("form-control");
        $(introid).addClass("left-tag");
        if(IsSingle($(answerid)[0].tagName.toLowerCase())){
            $(questionid).addClass("single-line");
            $(typeid).addClass("single-line");
            $(answerid).addClass("intro-single-input");
        }
        else{
            $(questionid).addClass("double-line");
            $(typeid).addClass("double-line");
            $(answerid).addClass("intro-double-input");
        }
        if(IsLight(i)){
            $(questionid).addClass("light-blank");
        }
        else{
            $(questionid).addClass("dark-blank");
        }
        $(typeid).css("background-color",randomColor);
        var triangleContent = "<div class=\"triangle\" style=\"border-left-color: "+randomColor+"\"></div>";
        $(contentid).prepend(triangleContent);
    }

});
