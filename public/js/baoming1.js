$(document).ready(function () {
    $("#regform").addClass("clearfix");
    var n = $("#regform").children().length;
    for (var i = 1; i <= n; i++) {
        var questionid = "#question" + i.toString();
        var typeid = "#type" + i.toString();
        var answerid = "#answer" + i.toString();
        $(questionid).addClass("form-group");
        $(typeid).addClass("bold-label");
        $(answerid).addClass("form-control");
    }
});
