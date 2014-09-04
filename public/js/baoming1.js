$(document).ready(function(){
    $("#title")[0].innerText = document.title;
    $("#regform").addClass("clearfix");
    var n = $("#regform").children().length;
    for(var i = 1; i <= n; i++){
        var questionid = "#question" + i.toString();
        var typeid = "#type" + i.toString();
        var introid = "#intro" + i.toString();
        var contentid = "#content" + i.toString();
        var answerid = "#answer" + i.toString();
        $(questionid).addClass("form-group");
        $(typeid).addClass("bold-label");
        //$(contentid).addClass("col-sm-9").addClass("col-xs-9");
        $(answerid).addClass("form-control");
    }
});
