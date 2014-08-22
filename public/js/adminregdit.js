
$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
});

$(function(){
    var flag = new Array(5);
    var flag2 = ["1","1","1","1","1"];
    //验证邮箱
    $('#inputEmail').change(function(){
        if(this.value=='' || (this.value!='' && !/.+@.+\.[a-zA-z]{2,4}$/.test(this.value))){
            $('#span1').removeClass("hidespan");
            $('#span1-2').removeClass("hidespan");
            $('#inputbox1').addClass("has-error");
            $('#inputbox1').removeClass("has-success");
            $('#span1-1').addeClass("hidespan");
            flag[0] = 0;
        }else{
            $('#span1-1').removeClass("hidespan");
            $('#span1-2').addClass("hidespan");
            $('#inputbox1').removeClass("has-error");
            $('#inputbox1').addClass("has-success");
            $('#span1').addClass("hidespan");
            flag[0] = 1;
        }
    });
    //验证密码
    $('#inputPassword').change(function(){
        if(this.value=='' || (this.value!='' && !/^[^\s]{6,16}$/.test(this.value))){
            $('#span2').removeClass("hidespan");
            $('#span2-2').removeClass("hidespan");
            $('#inputbox2').addClass("has-error");
            $('#inputbox2').removeClass("has-success");
            $('#span2-1').addeClass("hidespan");
            flag[1] = 0;
        }else{
            $('#span2-1').removeClass("hidespan");
            $('#span2-2').addClass("hidespan");
            $('#inputbox2').removeClass("has-error");
            $('#inputbox2').addClass("has-success");
            $('#span2').addClass("hidespan");
            flag[1] = 1;
        }
    });
    //验证密码一致
    $('#inputPassword2').change(function(){
        if(!$(this).val || $(this).val() != $("#inputPassword").val() )
        {
            $('#span3').removeClass("hidespan");
            $('#span3-2').removeClass("hidespan");
            $('#inputbox3').addClass("has-error");
            $('#inputbox3').removeClass("has-success");
            $('#span3-1').addeClass("hidespan");
            flag[2] = 0;
        }
        else
        {
            $('#span3-1').removeClass("hidespan");
            $('#span3-2').addClass("hidespan");
            $('#inputbox3').removeClass("has-error");
            $('#inputbox3').addClass("has-success");
            $('#span3').addClass("hidespan");
            flag[2] = 1;
        }
    });
    //验证手机号
    $('#inputPhone').change(function(){
        if(this.value=='' || (this.value!='' && !/^0{0,1}[0-9]{11}$/.test(this.value))){
            $('#span4').removeClass("hidespan");
            $('#span4-2').removeClass("hidespan");
            $('#inputbox4').addClass("has-error");
            $('#inputbox4').addClass("has-feedback");
            $('#span4-1').addeClass("hidespan");
            flag[3] = 0;
        }else{
            $('#span4-1').removeClass("hidespan");
            $('#span4-2').addClass("hidespan");
            $('#inputbox4').removeClass("has-error");
            $('#inputbox4').addClass("has-success");
            $('#span4').addClass("hidespan");
            flag[3] = 1;
        }
    });

    //验证手机短号
    $('#inputPhone2').change(function(){
        if(this.value=='' || (this.value!='' && !/^0{0,1}[0-9]{6}$/.test(this.value))){
            $('#span5').removeClass("hidespan");
            $('#span5-2').removeClass("hidespan");
            $('#inputbox5').removeClass("has-success");
            $('#inputbox5').addClass("has-error");
            $('#span5-1').addClass("hidespan");
            flag[4] = 0;
        }else{
            $('#span5-1').removeClass("hidespan");
            $('#span5-2').addClass("hidespan");
            $('#inputbox5').removeClass("has-error");
            $('#inputbox5').addClass("has-success");
            $('#span5').addClass("hidespan");
            flag[4] = 1;
        }
    });

    //第二个页面的验证

    //社团名称
    $('#inputShetuan').change(function(){
        if(this.value==''){
            $('#span6-1').addClass("hidespan");
            $('#inputbox6').removeClass("has-success");
        }else{
            $('#span6-1').removeClass("hidespan");
            $('#inputbox6').addClass("has-success");
        }
    });
    //社团介绍
    $('#inputIntro').change(function(){
        if(this.value==''){
            $('#span7-1').addClass("hidespan");
            $('#inputbox7').removeClass("has-success");
        }else{
            $('#span7-1').removeClass("hidespan");
            $('#inputbox7').addClass("has-success");
        }
    });
    //微信
    $('#inputWeixin').change(function(){
        if(this.value==''){
            $('#span8-1').addClass("hidespan");
            $('#inputbox8').removeClass("has-success");
        }else{
            $('#span8-1').removeClass("hidespan");
            $('#inputbox8').addClass("has-success");
        }
    });
    //logo
    $('#inputLogo').change(function(){
        if(this.value==''){
            $('#span9-1').addClass("hidespan");
            $('#inputbox9').removeClass("has-success");
        }else{
            $('#span9-1').removeClass("hidespan");
            $('#inputbox9').addClass("has-success");
        }
    });
    //pic1
    $('#inputPic1').change(function(){
        if(this.value==''){
            $('#span10-1').addClass("hidespan");
            $('#inputbox10').removeClass("has-success");
        }else{
            $('#span10-1').removeClass("hidespan");
            $('#inputbox10').addClass("has-success");
        }
    });
    //pic2
    $('#inputPic2').change(function(){
        if(this.value==''){
            $('#span11-1').addClass("hidespan");
            $('#inputbox11').removeClass("has-success");
        }else{
            $('#span11-1').removeClass("hidespan");
            $('#inputbox11').addClass("has-success");
        }
    });
    //pic3
    $('#inputPic3').change(function(){
        if(this.value==''){
            $('#span12-1').addClass("hidespan");
            $('#inputbox12').removeClass("has-success");
        }else{
            $('#span12-1').removeClass("hidespan");
            $('#inputbox12').addClass("has-success");
        }
    });

    $('#next1').click(function(){
        var sig = true;
        for(var i = 0;i < 4; i++){
            if(flag[i] != flag2[i]){
                sig = false;
            }
        }
        if (sig == true) {
            $('#next1-2').trigger("click")
        }
        else{
            alert("对不起，请确认填写正确！");
        }
    });

    $('#next2').click(function(){
        $('#next1-1').trigger("click")
    });

    $('#next3').click(function(){
        if ($("input[name='shetuanmingcheng']").val() == ""){
            alert("对不起，请填写社团名称！")
            $("input[name='shetuanmingcheng']").focus();
            return false;
        }
        if ($("#inputXueyuan").find("option:selected").text() == ""){
            alert("对不起，请选择所属学院！")
            $("input[name='suoshuxueyuan']").focus();
            return false;
        }
        if ($("textarea[name='shetuanjieshao']").val() == ""){
            alert("对不起，请填写社团介绍！")
            $("textarea[name='shetuanjieshao']").focus();
            return false;
        }
        if ($("textarea[name='shetuanjieshao']").val().length > 200){
            alert("对不起，社团介绍超过200个字符限制！")
            $("textarea[name='shetuanjieshao']").focus();
            return false;
        }
        if ($("input[name='logo']").val() == ""){
            alert("对不起，请上传logo！")
            $("input[name='logo']").focus();
            return false;
        }
        if ($("input[name='pic1']").val() == ""){
            alert("对不起，请上传展示照片1！")
            $("input[name='pic1']").focus();
            return false;
        }
        if ($("input[name='pic2']").val() == ""){
            alert("对不起，请上传展示照片2！")
            $("input[name='pic2']").focus();
            return false;
        }
        if ($("input[name='pic3']").val() == ""){
            alert("对不起，请上传展示照片3！")
            $("input[name='pic3']").focus();
            return false;
        }
        $('#next1-3').trigger("click")
    });

    $('#next4').click(function(){
        $('#next1-2').trigger("click")
    });

    $('#addelement').click(function () {
        var createSelect='<div class="form-group"><label class="col-sm-2 control-label">部门名称</label><div class="col-sm-6"><input type="text" class="form-control"></div></div><div class="form-group"><label class="col-sm-2 control-label">部门介绍</label><div class="col-sm-6"><textarea class="form-control"></textarea><span class="help-block">50字以内</span></div></div>'
        $('#addablebox').append(createSelect);
    })

    $('#minuselement').click(function () {
        if ( $("#addablebox .form-group").size() > 2 ) {
            $("#addablebox .form-group:last-child").remove();
            $("#addablebox .form-group:last-child").remove();
        }
        else{
            alert("请至少填写一个部门！");
        }
    })

    $("#inputXueyuan").empty();
    $("#inputXueyuan").prepend("<option value='全校' selected>全校</option>");
    $("#inputType").change(function(){
        var checkText=$("#inputType").find("option:selected").text();
        var schoolArr = ['机械工程学院','电子信息学院','通信工程学院','自动化学院','计算机学院','生命信息与仪器工程学院','材料与环境工程学院','软件工程学院','理学院','经济学院','管理学院','会计学院','外国语学院','数字媒体与艺术设计学院','人文与法学院','马克思主义学院','卓越学院','信息工程学院','国际教育学院','继续教育学院'];
        if(checkText == "校级组织"||checkText == "校级社团"){
            $("#inputXueyuan").empty();
            $("#inputXueyuan").prepend("<option value='2' selected>全校</option>");
        }
        else{
            $("#inputXueyuan").empty();
            for(var i = 0; i < schoolArr.length; i++){
                $("#inputXueyuan").append("<option value="+schoolArr[i]+">"+schoolArr[i]+"</option>");
            };
            $("#inputXueyuan").prepend("<option value='1' selected></option>");
        }
    });
})