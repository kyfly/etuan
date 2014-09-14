//打开html文档，读到js部分
$(document).ready(function () {
    //ajax发出请求，请求服务器端发送json文件
    var getPageJSON = function (newActivityId) {
        var activityId;
        if (typeof(newActivityId) === "number") {
            activityId = newActivityId;
        }

        var pageJSON;
        $.ajax({
            async: false,
            type: "get",
            dataType: "json",
            url: "/registration/activityinfo?activityId=" + activityId.toString(),
            success: function (msg) {
                if (pageJSON === undefined) {
                    pageJSON = msg;
                }
            },
            error: function () {
                alert("当前网络不佳，暂时无法进行报名活动");
            }
        });
        return pageJSON;
    };
    //根据json文件生成报名页面
    var createCommonListItem = function (newQuestionItem) {
        var questionItem = newQuestionItem;

        var divQuestion = document.createElement("div");
        divQuestion.setAttribute("id", "question" + questionItem.question_id.toString());

        var divType = document.createElement("div");
        divType.setAttribute("id", "type" + questionItem.question_id.toString());

        var pType = document.createElement("p");
        pType.setAttribute("id", "intro" + questionItem.question_id.toString());
        var introText;

        var divContent = document.createElement("div");
        divContent.setAttribute("id", "content" + questionItem.question_id.toString());

        var elementFilling;
        switch (questionItem.type) {
            case 1:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                introText = document.createTextNode(questionItem.label);
                break;
            case 2:
                elementFilling = document.createElement("textarea");
                elementFilling.setAttribute("rows", "6");
                elementFilling.setAttribute("style", "resize:none");
                introText = document.createTextNode(questionItem.label);
                break;
            case 3:
                elementFilling = document.createElement("select");
                var contentList = questionItem.content;
                for (var contentItem in contentList) {
                    elementFilling.options.add(new Option(contentList[contentItem].toString(), contentItem.toString()));
                }
                introText = document.createTextNode(questionItem.label);
                break;
            case 101:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "number");
                elementFilling.setAttribute("placeholder", "请输入您的学号");
                elementFilling.setAttribute("disabled",true);
                elementFilling.value = _stuId;
                introText = document.createTextNode("学号");
                break;
            case 102:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                elementFilling.setAttribute("placeholder", "请输入您的姓名");
                elementFilling.setAttribute("disabled",true);
                elementFilling.value = _stuName;
                introText = document.createTextNode("姓名");
                break;
            case 103:
                elementFilling = document.createElement("select");
                elementFilling.options.add(new Option("男生♂", "1"));
                elementFilling.options.add(new Option("女生♀", "0"));
                introText = document.createTextNode("性别");
                break;
            case 104:
                elementFilling = document.createElement("select");
                elementFilling.options.add(new Option("机械工程学院", "机械工程学院"));
                elementFilling.options.add(new Option("电子信息学院", "电子信息学院"));
                elementFilling.options.add(new Option("通信工程学院", "通信工程学院"));
                elementFilling.options.add(new Option("自动化学院", "自动化学院"));
                elementFilling.options.add(new Option("计算机学院", "计算机学院"));
                elementFilling.options.add(new Option("生命信息与仪器工程学院", "生命信息与仪器工程学院"));
                elementFilling.options.add(new Option("材料与环境工程学院", "材料与环境工程学院"));
                elementFilling.options.add(new Option("软件工程学院", "软件工程学院"));
                elementFilling.options.add(new Option("理学院", "理学院"));
                elementFilling.options.add(new Option("经济学院", "经济学院"));
                elementFilling.options.add(new Option("管理学院", "管理学院"));
                elementFilling.options.add(new Option("会计学院", "会计学院"));
                elementFilling.options.add(new Option("外国语学院", "外国语学院"));
                elementFilling.options.add(new Option("数字媒体与艺术设计学院", "数字媒体与艺术设计学院"));
                elementFilling.options.add(new Option("人文与法学院", "人文与法学院"));
                elementFilling.options.add(new Option("马克思主义学院", "马克思主义学院"));
                elementFilling.options.add(new Option("卓越学院", "卓越学院"));
                elementFilling.options.add(new Option("信息工程学院", "信息工程学院"));
                elementFilling.options.add(new Option("国际教育学院", "国际教育学院"));
                elementFilling.options.add(new Option("继续教育学院", "继续教育学院"));
                introText = document.createTextNode("学院");
                break;
            case 105:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                elementFilling.setAttribute("placeholder", "请输入您的专业");
                introText = document.createTextNode("专业");
                break;
            case 106:
                elementFilling = document.createElement("textarea");
                elementFilling.setAttribute("placeholder", "请说说您的特长");
                elementFilling.setAttribute("rows", "6");
                elementFilling.setAttribute("style", "resize:none");
                introText = document.createTextNode("特长");

                break;
            case 107:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "email");
                elementFilling.setAttribute("placeholder", "其输入您的电子邮箱地址");
                introText = document.createTextNode("电子邮箱");
                break;
            case 108:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "number");
                elementFilling.setAttribute("placeholder", "请输入您的QQ号码");
                introText = document.createTextNode("QQ");
                break;
            case 109:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "number");
                elementFilling.setAttribute("placeholder", "请输入您的手机长号");
                introText = document.createTextNode("手机长号");
                break;
            case 110:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "number");
                elementFilling.setAttribute("placeholder", "请输入您的移动短号");
                introText = document.createTextNode("移动短号");
                break;
            case 111:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                elementFilling.setAttribute("placeholder", "请填写您的籍贯");
                introText = document.createTextNode("籍贯");
                break;
            case 112:
                elementFilling = document.createElement("select");
                var department1Arr = JSON.parse(questionItem.content);
                for (var l = 0; l < department1Arr.length; l++) {
                    elementFilling.options.add(new Option(department1Arr[l], department1Arr[l]));
                }
                introText = document.createTextNode("第一志愿部门");
                break;
            case 113:
                elementFilling = document.createElement("select");
                var department2Arr = JSON.parse(questionItem.content);
                for (var m = 0; m < department2Arr.length; m++) {
                    elementFilling.options.add(new Option(department2Arr[m], department2Arr[m]));
                }
                introText = document.createTextNode("第二志愿部门");
                break;
            case 114:
                elementFilling = document.createElement("select");
                var department3Arr = JSON.parse(questionItem.content);
                for (var n = 0; n < department3Arr.length; n++) {
                    elementFilling.options.add(new Option(department3Arr[n], department3Arr[n]));
                }
                introText = document.createTextNode("第三志愿部门");
                break;
            case 115:
                elementFilling = document.createElement("select");
                elementFilling.options.add(new Option("是", "是"));
                elementFilling.options.add(new Option("否", "否"));
                introText = document.createTextNode("是否服从调剂");
                break;
            default:
                elementFilling = document.createElement("div");
                introText = document.createTextNode("");
                break;
        }
        elementFilling.setAttribute("id", "answer" + questionItem.question_id.toString());
        pType.appendChild(introText);
        divType.appendChild(pType);
        divQuestion.appendChild(divType);
        divContent.appendChild(elementFilling);
        divQuestion.appendChild(divContent);
        document.getElementById("regform").appendChild(divQuestion);
    };
    //通用的表单创建的调用函数createCommonList
    var createCommonList = function (newPageJson) {
        var localPageJson = newPageJson;
        //顺次添加各个项目
        for (var questionItem in localPageJson.questions) {
            createCommonListItem(localPageJson.questions[questionItem]);
        }
        //添加页面标题
        document.title = localPageJson.name;
    };
    //获得json，绘制页面
    //此行仅作测试使用，实际应用请替换成下行
    var activityIdPredefined = _activityId;
    var activityPageJson;
    if (typeof(activityIdPredefined) === "number") {
        activityPageJson = getPageJSON(activityIdPredefined);
    }
    //创建报名列表
    createCommonList(activityPageJson);
    //判断微信环境并且决定是否保留退出按钮
    function is_weixn() {
        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
        } else {
            return false;
        }
    }
    if (is_weixn()) {
        $("#logout").remove();
    }

    //添加标题区域
    var orgJSON;
    $.ajax({
        async: false,
        type: "get",
        dataType: "json",
        url: "/organization/org-info?activityId=" + _activityId,
        success: function (msg) {
            if (orgJSON === undefined) {
                orgJSON = msg;
            }
        },
        error: function () {
            alert("当前网络不佳，暂时无法获取社团信息");
        }
    });
    var titletext = document.createTextNode(" " + activityPageJson.name);
    var titlelogo = document.createElement("img");
    titlelogo.setAttribute("id", "titlelogo");
    titlelogo.setAttribute("class", "img-rounded");
    titlelogo.setAttribute("src", orgJSON.logo_url);
    titlelogo.setAttribute("alt", activityPageJson.name);
    if (activityPageJson.theme === 1) {
        document.getElementById("titlearea").insertBefore(titlelogo,document.getElementById("title"));
    }
    else {
        document.getElementById("title").appendChild(titlelogo);
    }
    document.getElementById("title").appendChild(titletext);
    //给社团链接添加链接
    $("#orginfo").prop("href", "/shetuan/" + orgJSON.org_id);
    //时间变量准备
    //var nowDate = new Date();
    var checkStartTime = activityPageJson.start_time.split(/[\s:-]/);
    var checkStopTime = activityPageJson.stop_time.split(/[\s:-]/);
    //var startDate = new Date(parseInt(checkStartTime[0]), parseInt(checkStartTime[1]) - 1, parseInt(checkStartTime[2]), parseInt(checkStartTime[3]), parseInt(checkStartTime[4]), 0);
    //var stopDate = new Date(parseInt(checkStopTime[0]), parseInt(checkStopTime[1]) - 1, parseInt(checkStopTime[2]), parseInt(checkStopTime[3]), parseInt(checkStopTime[4]), 0);
    //输入具体时间
    $("#timeinfo")[0].textContent = "报名时间： " + checkStartTime[1] + "月" + checkStartTime[2] + "日 " + checkStartTime[3] + ":" + checkStartTime[4] +
        " ~ " + checkStopTime[1] + "月" + checkStopTime[2] + "日 " + checkStopTime[3] + ":" + checkStopTime[4];

    /*
    //检查时间
    if (nowDate > stopDate) {
        $("div").prop("disabled", true);
        $("input").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $("select").prop("disabled", true);
        $("#submit").prop("disabled", true);
        alert("对不起，亲，你来晚了哟(T_T)");
    }
    else if (nowDate < startDate) {
        $("div").prop("disabled", true);
        $("input").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $("select").prop("disabled", true);
        $("#submit").prop("disabled", true);
        alert("客官稍安勿躁，还没开始报名~");
    }
    //检查是否属于允许报名的学号
    var isAtRightGrade = function (newStuId, newLimitGrade) {
        var stuId = newStuId;
        var limitGrade = parseInt(newLimitGrade);

        //表示获得学号前两位
        var gradePattern = new RegExp("^..");
        var stuGrade = parseInt(gradePattern.exec(stuId));
        //利用布尔运算获得研究生的情况结果
        var yanResult = stuId.length === 9 && parseInt(limitGrade / 10000) === 1;
        //利用布尔运算获得本科生的情况结果，其中15-stuGrade为其本科年级
        var benResult = stuId.length === 8 && parseInt(limitGrade % parseInt(Math.pow(10, 15 - stuGrade)) / parseInt(Math.pow(10, 14 - stuGrade))) === 1;
        return (yanResult || benResult);
    };
    if (isAtRightGrade(_stuId.toString(), activityPageJson.limit_grade)) {
    }
    else {
        $("div").prop("disabled", true);
        $("input").prop("disabled", true);
        $("textarea").prop("disabled", true);
        $("select").prop("disabled", true);
        $("#submit").prop("disabled", true);
        alert("不好意思哦，你不在社团规定的年级范围内。");
    }
    */
    //根据blade输出的信息来做判断提示
    if (_IsGrade === 1) {
        if (_IsTime === 1) {
        }
        else {
            $("input").prop("disabled", true);
            $("textarea").prop("disabled", true);
            $("select").prop("disabled", true);
            $("#submit").prop("disabled", true);
            alert("对不起，现在还不是报名时间。");
        }
    }
    else {
        if (_IsTime === 1) {
            $("input").prop("disabled", true);
            $("textarea").prop("disabled", true);
            $("select").prop("disabled", true);
            $("#submit").prop("disabled", true);
            alert("对不起，您的年级不在报名范围内。");
        }
        else {
            $("input").prop("disabled", true);
            $("textarea").prop("disabled", true);
            $("select").prop("disabled", true);
            $("#submit").prop("disabled", true);
            alert("对不起，您的年级不在报名范围内且当前不是报名时间。");
        }
    }

    //开始整个报名表的运作部分
    //设置内容逻辑分析：学号、手机号等正则表达式
    var isMatchFormat = function (newMatchString, newType) {
        var matchString, type;
        if (typeof(newMatchString) === "string" && typeof(newType) === "number") {
            matchString = newMatchString;
            type = newType;
        }
        else {
            return false;
        }
        var patternStuId = new RegExp("^1[1-4][0-9]{6,7}$");
        var patternFullCellphoneNumber = new RegExp("^((1[358][0-9])|(17[0678]))[0-9]{8}$");
        var patternQQNumber = new RegExp("^[0-9]{6,10}$");
        var patternEMail = new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-._]*@.+\.[a-zA-z]{2,4}$");
        var matchResult = true;
        switch (type) {
            case 101:
                matchResult = patternStuId.test(matchString);
                break;
            case 107:
                matchResult = patternEMail.test(matchString);
                break;
            case 108:
                matchResult = patternQQNumber.test(matchString);
                break;
            case 109:
                matchResult = patternFullCellphoneNumber.test(matchString);
                break;
            default:
                break;
        }
        return matchResult;
    };

    //页面开始计时
    var usedTime = 0;
    function timedCount() {
        usedTime++;
    }
    setInterval(timedCount, 1000);
    //提交内容
    //点击提交按钮时停止计时，并且打包数据，发送数据
    $("#submit").click(function () {
        //用户表单数据格式
        var participatorInfoJson = {
            used_time: "",
            result: []
        };
        //设立发送标志
        var IsAllowSend = true;
        //完成用时的记录和格式的转换
        var finalTime = usedTime;
        participatorInfoJson.used_time += parseInt(finalTime / 3600).toString() + ":";
        finalTime = finalTime % 3600;
        participatorInfoJson.used_time += parseInt(finalTime / 60).toString() + ":";
        participatorInfoJson.used_time += (finalTime % 60).toString();
        //循环记录答案
        for (var i = 1; i <= activityPageJson.questions.length; i++) {
            var questionItemResult = {
                question_id: "",
                answer: ""
            };
            questionItemResult.question_id = activityPageJson.questions[i - 1].question_id.toString();
            var inputString = document.getElementById("answer" + i.toString()).value;
            if (isMatchFormat(inputString, activityPageJson.questions[i - 1].type)) {
                questionItemResult.answer = inputString;
            }
            else {
                alert("【" + activityPageJson.questions[i - 1].label + "】这一项你的输入有误哦！");
                IsAllowSend = false;
            }

            participatorInfoJson.result[i - 1] = questionItemResult;
        }
        if (IsAllowSend) {
            //禁用按钮防止错误提交
            $("#submit").prop("disabled", true);
            //打包好所需数据
            var sendJson = {activityId: activityPageJson.activityId, participatorInfo: JSON.stringify(participatorInfoJson)};
            //dev阶段采用alert形式表示数据
            //console.log(sendJson);
            //利用Ajax把Json用POST上去
            $.ajax({
                type: "POST",
                url: "/registration/participateinactivity",
                data: sendJson,
                dataType: "json",
                success: function (e) {
                    if (e.status === "success") {
                        //创建成功提示
                        alert(e.content);
                        //跳转至成功页面
                        window.location.href = "/baoming/success";
                    }
                    else if (e.status === "fail") {
                        //成功发送到后台，但是失败了
                        alert(e.content);
                        //解除对按钮的限制
                        $("#submit").prop("disabled", false);
                    }
                },
                error: function (xhr, ts, e) {
                    if (ts === "timeout") {
                        alert("连接超时，请检查网络");
                        //解除对按钮的限制
                        $("#submit").prop("disabled", false);
                    }
                    else if (ts === "error" || ts === "parseerror") {
                        alert("提交失败：" + ts + " " + e.toString());
                        //解除对按钮的限制
                        $("#submit").prop("disabled", false);
                    }
                }
            });
        }
    });
});