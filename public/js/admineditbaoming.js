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
    }

    function configExtraForm() {
        //每次绑定事件前首先释放所有的click以免造成过度绑定
        $(".delete").off("click");
        $(".moveup").off("click");
        $(".movedown").off("click");
        $(".delete").off("mouseover");
        $(".moveup").off("mouseover");
        $(".movedown").off("mouseover");
        //删除按钮
        $(".delete").on('click', function () {
            var content0;
            content0 = $(this).parent();
            content0.remove();
        });
        $(".delete").on("mouseover", function () {
            $(this).tooltip("show");
        });
        //上移按钮
        $(".moveup").on("click", function () {
            var content1;
            content1 = $(this).parent();
            content1.insertBefore(content1.prev());
        });
        $(".moveup").on("mouseover", function () {
            $(this).tooltip("show");
        });
        //下移按钮
        $(".movedown").on("click", function () {
            var content2;
            content2 = $(this).parent();
            content2.insertAfter(content2.next());
        });
        $(".movedown").on("mouseover", function () {
            $(this).tooltip("show");
        });
    }

    function checkDuplicate(o) {
        for (var i = 0; i < $("#extraform").children().length; i++) {
            if ($("#extraform").find("label")[i].innerText === o) {
                alert("已经包含项目【" + o + "】，请勿重复添加。");
                return false;
            }
        }
        return true;
    }

    setHeight();
    configExtraForm();
    //添加元素到左边
    $(".target .extralist h4:not(:contains(\"自定义\"))").click(function (e) {
        if (checkDuplicate(e.target.innerText)) {
            var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&emsp;&emsp;&emsp;&emsp;&ensp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
            $("#extraform").append(content);
            setHeight();
            configExtraForm();
        }
    });
    $("#zidingyishort2,#zidingyilong2").click(function (e) {
        var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&ensp;<input type=\"text\" placeholder=\"请输入问题描述\">&emsp;&emsp;&emsp;&emsp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
        $("#extraform").append(content);
        setHeight();
        configExtraForm();
    });
    //主题选择动画
    $(".theme").mouseover(function () {
        $(this).prop("src", $(this).prop("src").toString().replace("0.png", "1.png"));
    });
    $(".theme").mouseout(function () {
        $(this).prop("src", $(this).prop("src").toString().replace("1.png", "0.png"));
    });

    //函数将标签转化为类型
    var type2label = function (typenum) {
        var labelback = "";
        switch (typenum) {
            case 101:
                labelback = "学号";
                break;
            case 102:
                labelback = "姓名";
                break;
            case 103:
                labelback = "性别";
                break;
            case 104:
                labelback = "学院";
                break;
            case 105:
                labelback = "专业";
                break;
            case 106:
                labelback = "特长";
                break;
            case 107:
                labelback = "电子邮箱";
                break;
            case 108:
                labelback = "QQ";
                break;
            case 109:
                labelback = "手机长号";
                break;
            case 110:
                labelback = "移动短号";
                break;
            case 111:
                labelback = "籍贯";
                break;
            case 112:
                labelback = "第一志愿部门";
                break;
            case 113:
                labelback = "第二志愿部门";
                break;
            case 114:
                labelback = "第三志愿部门";
                break;
            case 115:
                labelback = "是否服从调剂";
                break;
            case 1:
                labelback = "自定义短问题";
                break;
            case 2:
                labelback = "自定义长问题";
                break;
            default:
                labelback = "";
                break;
        }
        ;
        return labelback;
    };

    function loadExistContent(activityInfoJson) {
        document.getElementById("starttime").value = activityInfoJson.start_time.replace(/\:00$/, "");
        document.getElementById("stoptime").value = activityInfoJson.stop_time.replace(/\:00$/, "");
        document.getElementById("regname").value = activityInfoJson.name;
        var objLimit = document.getElementsByName("grade");
        var limitGrade = activityInfoJson.limit_grade.split("");
        for (var i = 0; i < objLimit.length; i++) {
            if (limitGrade[i] === "1") {
                objLimit[objLimit.length - 1 - i].checked = true;
            }
            else {
                objLimit[objLimit.length - 1 - i].checked = false;
            }
        }
        document.getElementsByName("theme")[activityInfoJson.theme].checked = true;
        for (var j = 0; j < activityInfoJson.questions.length; j++) {
            var e = activityInfoJson.questions[j];
            if (e.type === 101 || e.type === 102) {
            }
            else if (e.type === 1 || e.type === 2) {
                var zdylabel = "";
                if (e.type === 1) {
                    zdylabel = "自定义短问题";
                }
                else {
                    zdylabel = "自定义长问题";
                }
                var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + zdylabel + "</label>&ensp;<input type=\"text\" placeholder=\"请输入问题描述\" value=\"" + e.label + "\">&emsp;&emsp;&emsp;&emsp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
                $("#extraform").append(content);
                setHeight();
                configExtraForm();
            }
            else {
                var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + type2label(e.type) + "</label>&emsp;&emsp;&emsp;&emsp;&ensp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
                $("#extraform").append(content);
                setHeight();
                configExtraForm();
            }
        }
    }
    var pageJSON;
    $.ajax({
        async: false,
        type: "get",
        dataType: "json",
        url: "/registration/activityinfo?activityId=" + _activityId.toString(),
        success: function (msg) {
            if (pageJSON === undefined) {
                pageJSON = msg;
                loadExistContent(pageJSON);
            }
        },
        error: function () {
            alert("当前网络不佳，暂时无法加载报名表信息");
        }
    });

});

//获得创建报名的各项参数数据
$(document).ready(function () {
    //函数将标签转化为类型
    var label2type = function (labelstr) {
        var typeback = 0;
        switch (labelstr) {
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
            case "移动短号":
                typeback = 110;
                break;
            case "籍贯":
                typeback = 111;
                break;
            case "第一志愿部门":
                typeback = 112;
                break;
            case "第二志愿部门":
                typeback = 113;
                break;
            case "第三志愿部门":
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
        }
        return typeback;
    };
    var IsWishPriorityRight = function () {
        var l = $("#extraform").children().children("label.baomingitem");
        var IsExist = [false, false, false];//first second third
        var IsRight = [4, 4, 4, 4];
        var IndexRight = 0;
        for (var i = 0; i < l.length; i++) {
            if (l[i].innerText === "第一志愿部门") {
                IsExist[0] = true;
                IsRight[IndexRight] = 1;
                IndexRight++;
            }
            else if (l[i].innerText === "第二志愿部门") {
                IsExist[1] = true;
                IsRight[IndexRight] = 2;
                IndexRight++;
            }
            else if (l[i].innerText === "第三志愿部门") {
                IsExist[2] = true;
                IsRight[IndexRight] = 3;
                IndexRight++;
            }
        }
        for (var j = 0; j < l.length; j++) {
            if (IsRight[j] > IsRight[j + 1]) {
                return false;
            }
        }
        if (IsExist[2]) {
            return IsExist[0] && IsExist[1];
        }
        else if (IsExist[1]) {
            return IsExist[0];
        }
        else {
            return true;
        }
    };
    $("#preview").click(function () {
        var previewWindow = window.open("about:blank");
        previewWindow.document.title = $("#regname").val();
        previewWindow.document.write("预览功能正在开发中~");
    });
    $("#submit").click(function () {
        var IsAllowSend = true;
        //检查时间前后的对比
        var IsTimeLater = function (dateA, dateB) {
            return dateA < dateB;
        };
        //预定义一个创建活动对象
        var createActivityJson = {
            start_time: "",
            stop_time: "",
            limit_grade: "",
            name: "",
            theme: "",
            url: "",
            questions: []
        };
        //获得报名标题的值
        var regnameval = $("#regname").val();
        if (regnameval === "") {
            alert("这么好的一张报名表你怎么能不起个响亮的标题呢？");
            IsAllowSend = false;
        }
        else {
            createActivityJson.name = regnameval;
        }
        //判断是否选择日期
        var starttimeval = $("#starttime").val();
        var stoptimeval = $("#stoptime").val();
        if (starttimeval === "") {
            alert("亲，选个报名开始的时间呗~");
            IsAllowSend = false;
        }
        else if (stoptimeval === "") {
            alert("怎么说也得有个结束的时间吧~");
            IsAllowSend = false;
        }
        else {
            var arrayStartTime = starttimeval.split(/[\s:-]/);
            var arrayStopTime = stoptimeval.split(/[\s:-]/);
            var dateStartTime = new Date(parseInt(arrayStartTime[0]), parseInt(arrayStartTime[1]) - 1, parseInt(arrayStartTime[2]), parseInt(arrayStartTime[3]), parseInt(arrayStartTime[4]), 0);
            var dateStopTime = new Date(parseInt(arrayStopTime[0]), parseInt(arrayStopTime[1]) - 1, parseInt(arrayStopTime[2]), parseInt(arrayStopTime[3]), parseInt(arrayStopTime[4]), 0);
            var IsTimeOutOfBound = IsTimeLater(new Date(2014, 8, 4, 0, 0, 0), dateStartTime);
            var IsStopTimeBeforeStartTime = IsTimeLater(dateStartTime, dateStopTime);
            if (IsStopTimeBeforeStartTime && IsTimeOutOfBound) {
                //获得报名终止时间
                createActivityJson.start_time = dateStartTime.getFullYear() + "-" + (dateStartTime.getMonth() + 1) + "-" + dateStartTime.getDate() + " " + dateStartTime.getHours() + ":" + dateStartTime.getMinutes() + ":" + dateStartTime.getSeconds();
                //获得报名终止时间
                createActivityJson.stop_time = dateStopTime.getFullYear() + "-" + (dateStopTime.getMonth() + 1) + "-" + dateStopTime.getDate() + " " + dateStopTime.getHours() + ":" + dateStopTime.getMinutes() + ":" + dateStopTime.getSeconds();
            }
            else if (!IsTimeOutOfBound) {
                alert("选择的开始时间太早了哦");
                IsAllowSend = false;
            }
            else if (!IsStopTimeBeforeStartTime) {
                alert("结束时间怎么能比开始时间早呢");
                IsAllowSend = false;
            }
            if(IsTimeLater(dateStartTime,new Date())){
                var r = confirm("温馨提示：如果开始时间早于当前时间，那么报名表一旦生成将不可修改！点击【确定】继续提交，点击【取消】终止提交返回修改。");
                if (r===true){}
                else
                {
                    IsAllowSend = false;
                }
            }
        }
        //获得年纪限制并且转换为五位二进制数
        var objLimit = document.getElementsByName("grade");
        var gradeLimit = "";
        for (var i = objLimit.length - 1; i >= 0; i--) {
            if (objLimit[i].checked === true) {
                gradeLimit += "1";
            }
            else {
                gradeLimit += "0";
            }
        }
        if (gradeLimit === "00000") {
            alert("请选择允许参加这次报名的年级哦~");
            IsAllowSend = false;
        }
        else {
            createActivityJson.limit_grade = gradeLimit;
        }
        //获得主题选择的值
        var objTheme = document.getElementsByName("theme");
        var themeval = "";
        for (var k = 0; k < objTheme.length; k++) {
            if (objTheme[k].checked === true) {
                themeval = objTheme[k].value;
            }
        }
        if (themeval === "") {
            alert("给你的报名表选择一个漂亮的样式吧！");
            IsAllowSend = false;
        }
        else {
            createActivityJson.theme = themeval;
        }
        //检查志愿选择是否存在逻辑错误
        if (IsWishPriorityRight()) {
        }
        else {
            alert("亲，看起来你的志愿部门排列顺序有点问题啊喂~");
            IsAllowSend = false;
        }
        if (IsAllowSend) {
            //将问题依次添加进其中
            var objQuestion = document.getElementsByClassName("baomingitem");
            var departmentInfo;
            $.ajax({
                async: false,
                type: "get",
                url: "/organization/department?org_uid=" + _orgId,
                success: function (msg) {
                    departmentInfo = msg;
                },
                error: function () {
                    alert("当前网络不佳，暂时无法获得部门信息");
                }
            });
            for (var j = 0; j < objQuestion.length; j++) {
                var questionItem = {
                    question_id: "",
                    type: "",
                    label: "",
                    content: ""
                };
                questionItem.question_id = j + 1;
                var thisType = label2type(objQuestion[j].innerText);
                questionItem.type = thisType;
                if (thisType === 1 || thisType === 2 || thisType === 3) {
                    questionItem.label = objQuestion[j].parentNode.childNodes[2].value;
                    questionItem.content = "";
                }
                else if(thisType === 112 || thisType === 113 || thisType === 114){
                    questionItem.label = objQuestion[j].innerText;
                    questionItem.content = JSON.stringify(departmentInfo);
                }
                else {
                    questionItem.label = objQuestion[j].innerText;
                    questionItem.content = "";
                }
                createActivityJson.questions[j] = questionItem;
            }
            //打包好发送格式的Json
            var sendJson = {activityId: _activityId, activityInfo: JSON.stringify(createActivityJson)};
            //禁用按钮防止错误提交
            $("#preview").prop("disabled", true);
            $("#submit").prop("disabled", true);
            //dev阶段采用alert形式表示数据
            //console.log(sendJson);
            //利用Ajax把Json用POST上去
            $.ajax({
                type: "POST",
                url: "/registration/updateactivity",
                data: sendJson,
                dataType: "json",
                success: function (e) {
                    if (e.status === "success") {
                        //创建成功提示
                        alert(e.content);
                        //跳转至查看报名界面
                        window.location.href = "/admin/register/viewreg";
                    }
                    else if (e.status === "fail") {
                        //成功发送到后台，但是失败了
                        alert(e.content);
                        //解除对按钮的限制
                        $("#preview").prop("disabled", false);
                        $("#submit").prop("disabled", false);
                    }
                },
                error: function (xhr, ts, e) {
                    if (ts === "timeout") {
                        alert("连接超时，请检查网络");
                        //解除对按钮的限制
                        $("#preview").prop("disabled", false);
                        $("#submit").prop("disabled", false);
                    }
                    else if (ts === "error" || ts === "parseerror") {
                        alert("提交失败：" + ts + " " + e.toString());
                        //解除对按钮的限制
                        $("#preview").prop("disabled", false);
                        $("#submit").prop("disabled", false);
                    }
                }
            });
        }
    });
});
