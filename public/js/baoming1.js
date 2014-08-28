$(document).ready(function(){
    $("#title")[0].innerText = document.title;
    var n = $("#regform").children().length;
    for(var i = 1; i <= n; i++){
        var questionid = "#question" + i.toString();
        var typeid = "#type" + i.toString();
        var introid = "#intro" + i.toString();
        var contentid = "#content" + i.toString();
        var answerid = "#answer" + i.toString();
        $(questionid).addClass("form-group");
        $(typeid).addClass("col-sm-2").addClass("col-xs-4").addClass("control-label");
        $(contentid).addClass("col-sm-10").addClass("col-xs-8");
        $(answerid).addClass("form-control");
    }
});
