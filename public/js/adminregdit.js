$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
});

$(function () {
    var flag = new Array(5);
    var flag2 = ["1", "1", "1", "1", "1"];
    //验证邮箱
    $(document).ready(function () {
        $('#inputEmail').change(function () {
            $.post('/auth/check',
                {
                    "key": "email", "value": $('#inputEmail').val()
                },
                function (data, status) {
                    if (status == 'success') {
                        if (data == '0') {
                            $('#span1-2').text('该邮箱已被注册').removeClass("hidespan");
                            $('#span1').removeClass("hidespan");
                            $('#inputbox1').addClass("has-error").removeClass("has-success");
                            $('#span1-1').addClass("hidespan");
                            flag[0] = 0;
                        }
                        else if ($('#inputEmail').val() == ''
                            || ($('#inputEmail').val() != '' && !/^[a-zA-Z0-9][a-zA-Z0-9-._]*@.+\.[a-zA-z]{2,4}$/.test($('#inputEmail').val()))) {
                            $('#span1-2').text('邮箱格式不正确').removeClass("hidespan");
                            $('#span1').removeClass("hidespan");
                            $('#inputbox1').addClass("has-error").removeClass("has-success");
                            $('#span1-1').addClass("hidespan");
                            flag[0] = 0;
                        } else {
                            $('#span1-1').removeClass("hidespan");
                            $('#span1-2').addClass("hidespan");
                            $('#inputbox1').removeClass("has-error").addClass("has-success");
                            $('#span1').addClass("hidespan");
                            flag[0] = 1;
                        }
                    }
                });

        });
        //验证密码
        $('#inputPassword').change(function () {
            if (this.value == '' || (this.value != '' && !/^[^\s]{6,16}$/.test(this.value))) {
                $('#span2').removeClass("hidespan");
                $('#span2-2').removeClass("hidespan");
                $('#inputbox2').addClass("has-error").removeClass("has-success");
                $('#span2-1').addClass("hidespan");
                flag[1] = 0;
            } else {
                $('#span2-1').removeClass("hidespan");
                $('#span2-2').addClass("hidespan");
                $('#inputbox2').removeClass("has-error").addClass("has-success");
                $('#span2').addClass("hidespan");
                flag[1] = 1;
            }
			if ($("#inputPassword2").val() != "") {
                if (!$("#inputPassword").val || $(this).val() != $("#inputPassword2").val()) {
                $('#span3').removeClass("hidespan");
                $('#span3-2').removeClass("hidespan");
                $('#inputbox3').addClass("has-error").removeClass("has-success");
                $('#span3-1').addClass("hidespan");
                flag[2] = 0;
            }
            else {
                $('#span3-1').removeClass("hidespan");
                $('#span3-2').addClass("hidespan");
                $('#inputbox3').removeClass("has-error").addClass("has-success");
                $('#span3').addClass("hidespan");
                flag[2] = 1;
            }
            }
        });
        //验证密码一致
        $('#inputPassword2').change(function () {
            if (!$(this).val || $(this).val() != $("#inputPassword").val()) {
                $('#span3').removeClass("hidespan");
                $('#span3-2').removeClass("hidespan");
                $('#inputbox3').addClass("has-error").removeClass("has-success");
                $('#span3-1').addClass("hidespan");
                flag[2] = 0;
            }
            else {
                $('#span3-1').removeClass("hidespan");
                $('#span3-2').addClass("hidespan");
                $('#inputbox3').removeClass("has-error").addClass("has-success");
                $('#span3').addClass("hidespan");
                flag[2] = 1;
            }
        });
        //验证手机号
        $('#inputPhone').change(function () {
            if (this.value == '' || (this.value != '' && !/^((1[358][0-9])|(17[0678]))[0-9]{8}$/.test(this.value))) {
                $('#span4').removeClass("hidespan");
                $('#span4-2').removeClass("hidespan");
                $('#inputbox4').addClass("has-error").addClass("has-feedback");
                $('#span4-1').addClass("hidespan");
                flag[3] = 0;
            } else {
                $('#span4-1').removeClass("hidespan");
                $('#span4-2').addClass("hidespan");
                $('#inputbox4').removeClass("has-error").addClass("has-success");
                $('#span4').addClass("hidespan");
                flag[3] = 1;
            }
        });
        //验证手机短号    
        $('#inputPhone2').change(function () {
			if (this.value != '' && !/^0{0,1}[0-9]{6}$/.test(this.value)) {
				$('#span5').removeClass("hidespan");
				$('#span5-2').removeClass("hidespan");
				$('#inputbox5').removeClass("has-success").addClass("has-error");
				$('#span5-1').addClass("hidespan");
				flag[4] = 0;
			} else {
				if ($('#inputPhone2').val() == '') {
					$('#inputbox5').removeClass("has-error").removeClass("has-success");
					$('#span5-1').addClass("hidespan");
					$('#span5-2').addClass("hidespan");
					$('#span5').addClass("hidespan");
					flag[4] = 1;
				}else{$('#span5-1').removeClass("hidespan");
					$('#span5-2').addClass("hidespan");
					$('#inputbox5').removeClass("has-error").addClass("has-success");
					$('#span5').addClass("hidespan");
					flag[4] = 1;
				}
			}
        });

        //第二个页面的验证

        //社团名称
        $('#inputShetuan').change(function () {
            if (this.value == '') {
                $('#span6-1').addClass("hidespan");
                $('#inputbox6').removeClass("has-success");
            } else {
                $('#span6-1').removeClass("hidespan");
                $('#inputbox6').addClass("has-success");
            }
        });
        //社团介绍
        $('#inputIntro').change(function () {
            if (this.value == '') {
                $('#span7-1').addClass("hidespan");
                $('#inputbox7').removeClass("has-success");
            } else {
                $('#span7-1').removeClass("hidespan");
                $('#inputbox7').addClass("has-success");
            }
        });
        //微信
        $('#inputWeixin').change(function () {
            if (this.value == '') {
                $('#span8-1').addClass("hidespan");
                $('#inputbox8').removeClass("has-success");
            } else {
                $('#span8-1').removeClass("hidespan");
                $('#inputbox8').addClass("has-success");
            }
        });
		
		var check = new Array(4);
        //logo
        $('#inputLogo').change(function () {
            if (this.value == '') {
                $('#span9-1').addClass("hidespan");
                $('#inputbox9').removeClass("has-success");
            } else {
				var filepath=$("input[name='logo']").val();
				var extStart=filepath.lastIndexOf(".");
				var ext=filepath.substring(extStart,filepath.length).toUpperCase();
				if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
					alert("对不起，logo图片限于png,gif,jpeg,jpg格式");
					$('#span9-1').addClass("hidespan");
               	    $('#inputbox9').removeClass("has-success");
					check[0] = 0;
					$('#inputLogo').focus();
					return false;
				}else{
					var filesize = document.getElementById("inputLogo").files;       
					if(filesize[0].size/1024 > 1024){      
						alert("对不起，请选择不大于1MB的图片。");
						$('#span9-1').addClass("hidespan");
                		$('#inputbox9').removeClass("has-success");
						check[0] = 0;
						$('#inputLogo').focus();
						return false;
					}
				}
                $('#span9-1').removeClass("hidespan");
                $('#inputbox9').addClass("has-success");
				check[0] = 1;
            }
        });
        //pic1
        $('#inputPic1').change(function () {
            if (this.value == '') {
                $('#span10-1').addClass("hidespan");
                $('#inputbox10').removeClass("has-success");
            } else {
				var filepath=$("input[name='pic1']").val();
				var extStart=filepath.lastIndexOf(".");
				var ext=filepath.substring(extStart,filepath.length).toUpperCase();
				if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
					alert("对不起，图片限于png,gif,jpeg,jpg格式");
					$('#span10-1').addClass("hidespan");
               	    $('#inputbox10').removeClass("has-success");
					check[1] = 0;
					$('#inputPic1').focus();
					return false;
				}else{
					var filesize = document.getElementById("inputPic1").files;       
					if(filesize[0].size/1024 > 1024){      
						alert("对不起，请选择不大于1MB的图片。");
						$('#span10-1').addClass("hidespan");
                		$('#inputbox10').removeClass("has-success");
						check[1] = 0;
						$('#inputPic1').focus();
						return false;
					}
				}
                $('#span10-1').removeClass("hidespan");
                $('#inputbox10').addClass("has-success");
				check[1] = 1;
            }
        });
        //pic2
        $('#inputPic2').change(function () {
            if (this.value == '') {
                $('#span11-1').addClass("hidespan");
                $('#inputbox11').removeClass("has-success");
            } else {
				var filepath=$("input[name='pic2']").val();
				var extStart=filepath.lastIndexOf(".");
				var ext=filepath.substring(extStart,filepath.length).toUpperCase();
				if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
					alert("对不起，图片限于png,gif,jpeg,jpg格式");
					$('#span9-1').addClass("hidespan");
               	    $('#inputbox9').removeClass("has-success");
					check[2] = 0;
					$('#inputPic2').focus();
					return false;
				}else{
					var filesize = document.getElementById("inputPic2").files;       
					if(filesize[0].size/1024 > 1024){      
						alert("对不起，请选择不大于1MB的图片。");
						$('#span11-1').addClass("hidespan");
                		$('#inputbox11').removeClass("has-success");
						check[2] = 0;
						$('#inputPic2').focus();
						return false;
					}
				}
                $('#span11-1').removeClass("hidespan");
                $('#inputbox11').addClass("has-success");
				check[2] = 1;
            }
        });
        //pic3
        $('#inputPic3').change(function () {
            if (this.value == '') {
                $('#span12-1').addClass("hidespan");
                $('#inputbox12').removeClass("has-success");
            } else {
				var filepath=$("input[name='pic3']").val();
				var extStart=filepath.lastIndexOf(".");
				var ext=filepath.substring(extStart,filepath.length).toUpperCase();
				if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
					alert("对不起，图片限于png,gif,jpeg,jpg格式");
					$('#span12-1').addClass("hidespan");
               	    $('#inputbox12').removeClass("has-success");
					check[3] = 0;
					$('#inputPic3').focus();
					return false;
				}else{
					var filesize = document.getElementById("inputPic3").files;       
					if(filesize[0].size/1024 > 1024){      
						alert("对不起，请选择不大于1MB的图片。");
						$('#span12-1').addClass("hidespan");
                		$('#inputbox12').removeClass("has-success");
						check[3] = 0;
						$('#inputPic3').focus();
						return false;
					}
				}
                $('#span12-1').removeClass("hidespan");
                $('#inputbox12').addClass("has-success");
				check[3] = 1;
            }
        });

        $('#next1').click(function () {
            $('#next1-2').trigger("click");
        });

        $('#next2').click(function () {
            $('#next1-1').trigger("click")
        });

        $('#next3').click(function () {
            $('#next1-3').trigger("click")
        });

        $('#next4').click(function () {
            $('#next1-2').trigger("click");
        });
		
		$('#btnSubmit').click(function () {
            //验证邮箱
            if ($("#inputEmail").val() == '' || ($("#inputEmail").val() != '' && !/^[a-zA-Z0-9][a-zA-Z0-9-._]*@.+\.[a-zA-z]{2,4}$/.test($("#inputEmail").val()))) {
                $('#span1').removeClass("hidespan");
                $('#span1-2').removeClass("hidespan");
                $('#inputbox1').addClass("has-error").removeClass("has-success");
                $('#span1-1').addClass("hidespan");
                flag[0] = 0;
            } else {
                $('#span1-1').removeClass("hidespan");
                $('#span1-2').addClass("hidespan");
                $('#inputbox1').removeClass("has-error").addClass("has-success");
                $('#span1').addClass("hidespan");
                flag[0] = 1;
            }
            //验证密码
            if ($("#inputPassword").val() == '' || ($("#inputPassword").val() != '' && !/^[^\s]{6,16}$/.test($("#inputPassword").val()))) {
                $('#span2').removeClass("hidespan");
                $('#span2-2').removeClass("hidespan");
                $('#inputbox2').addClass("has-error").removeClass("has-success");
                $('#span2-1').addClass("hidespan");
                flag[1] = 0;
            } else {
                $('#span2-1').removeClass("hidespan");
                $('#span2-2').addClass("hidespan");
                $('#inputbox2').removeClass("has-error").addClass("has-success");
                $('#span2').addClass("hidespan");
                flag[1] = 1;
            }
            //验证密码一致
            if (!$("#inputPassword2").val() || $("#inputPassword2").val() != $("#inputPassword2").val()) {
                $('#span3').removeClass("hidespan");
                $('#span3-2').removeClass("hidespan");
                $('#inputbox3').addClass("has-error").removeClass("has-success");
                $('#span3-1').addClass("hidespan");
                flag[2] = 0;
            }
            else {
                $('#span3-1').removeClass("hidespan");
                $('#span3-2').addClass("hidespan");
                $('#inputbox3').removeClass("has-error").addClass("has-success");
                $('#span3').addClass("hidespan");
                flag[2] = 1;
            }
            //验证手机号
            if ($("#inputPhone").val() == '' || ($("#inputPhone").val() != '' && !/^((1[358][0-9])|(17[0678]))[0-9]{8}$/.test($("#inputPhone").val()))) {
                $('#span4').removeClass("hidespan");
                $('#span4-2').removeClass("hidespan");
                $('#inputbox4').addClass("has-error").addClass("has-feedback");
                $('#span4-1').addClass("hidespan");
                flag[3] = 0;
            } else {
                $('#span4-1').removeClass("hidespan");
                $('#span4-2').addClass("hidespan");
                $('#inputbox4').removeClass("has-error").addClass("has-success");
                $('#span4').addClass("hidespan");
                flag[3] = 1;
            }
            //验证手机短号
			if($("#inputPhone2").val() != ''){
				if ($("#inputPhone2").val() == '' || ($("#inputPhone2").val() !=  '' && !/^0{0,1}[0-9]{6}$/.test($("#inputPhone2").val()))) {
					$('#span5').removeClass("hidespan");
					$('#span5-2').removeClass("hidespan");
					$('#inputbox5').removeClass("has-success").addClass("has-error");
					$('#span5-1').addClass("hidespan");
					flag[4] = 0;
				} else {
					$('#span5-1').removeClass("hidespan");
					$('#span5-2').addClass("hidespan");
					$('#inputbox5').removeClass("has-error").addClass("has-success");
					$('#span5').addClass("hidespan");
					flag[4] = 1;
				}
			}
            else{
				$('#inputbox5').removeClass("has-error").removeClass("has-success");
				$('#span5-1').addClass("hidespan");
				$('#span5-2').addClass("hidespan");
				$('#span5').addClass("hidespan");
				flag[4] = 1;
				}

            var sig = true;
            for (var i = 0; i < 5; i++) {
                if (flag[i] != flag2[i]) {
                    sig = false;
					break;
                }
            }
            if (sig != true) {
                alert("对不起，请确认帐号信息填写正确！");
				$('#next1-1').trigger("click");
				return false;
            }
			
			if ($("input[name='name']").val() == "") {
                alert("对不起，请填写社团名称！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("#inputXueyuan").find("option:selected").val() == "1") {
                alert("对不起，请选择所属学院！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("textarea[name='description']").val() == "") {
                alert("对不起，请填写社团介绍！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("textarea[name='description']").val().length > 200) {
                alert("对不起，社团介绍超过200个字符限制！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("input[name='logo']").val() == "" || check[0] == 0) {
                alert("对不起，请上传小于1MB的logo！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("input[name='pic1']").val() == ""|| check[1] == 0) {
                alert("对不起，请上传小于1MB的展示照片1！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("input[name='pic2']").val() == ""|| check[2] == 0) {
                alert("对不起，请上传小于1MB的展示照片2！");
				$('#next1-2').trigger("click");
                return false;
            }
            if ($("input[name='pic3']").val() == ""|| check[3] == 0) {
                alert("对不起，请上传小于1MB的展示照片3！");
				$('#next1-2').trigger("click");
                return false;
            }
        });

        $('#addelement').click(function () {
            var createSelect = '<div class="addedbox"><div class="form-group">' +
                '<label class="col-sm-2 control-label">部门名称</label>' +
                '<div class="col-sm-6"><input type="text" class="form-control" name="department_name[]"></div>' +
                '<button onclick="delspan(this)" class="deletespan btn btn-danger col-sm-1" type="button">&nbsp;<span class="glyphicon glyphicon-trash"></span>&nbsp;</button></div>' +
                '<div class="form-group">' +
                '<label class="col-sm-2 control-label">部门介绍</label>' +
                '<div class="col-sm-6"><textarea class="form-control wordlimit" name="department_description[]" rows="3"></textarea>' +
                '<span class="help-block">50字以内</span></div></div></div>';
            $('#addablebox').append(createSelect);
        });

        $("#inputType").change(function () {
            var checkText = $("#inputType").find("option:selected").text();
            var schoolArr = ['','','机械工程学院', '电子信息学院', '通信工程学院', '自动化学院', '计算机学院', '生命信息与仪器工程学院', '材料与环境工程学院', '软件工程学院', '理学院', '经济学院', '管理学院', '会计学院', '外国语学院', '数字媒体与艺术设计学院', '人文与法学院', '马克思主义学院', '卓越学院', '信息工程学院', '国际教育学院', '继续教育学院'];
            if (checkText == "校级组织" || checkText == "校级社团") {
                $("#inputXueyuan").empty().prepend("<option value='1' selected>全校</option>");
            }
            else {
                $("#inputXueyuan").empty();
                for (var i = 2; i < schoolArr.length; i++) {
                    $("#inputXueyuan").append("<option value=" + i + ">" + schoolArr[i] + "</option>");
                }
            }
        });

        $('#regForm').submit(function () {
            $('#topAlert').show();
            $('#btnSubmit').attr("disabled", "disabled");
        });

        $('form').bind("keypress", function(e) {
            e = e || event;
            var txtArea = /textarea/i.test((e.target || e.srcElement).tagName);
            return txtArea || (e.keyCode || e.which || e.charCode || 0) != 13;
        });
    });
});

function delspan(delbtn) {
    $(delbtn).parents(".addedbox").remove();
}

$("#addablebox").on('change','.wordlimit',function(){
    if ($(this).val().length > 50) {
		alert("对不起，部门介绍请勿超过50个字符限制！");
		return false;
	}
});

