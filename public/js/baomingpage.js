//打开html文档，读到js部分
$(document).ready(function () {
    //ajax发出请求，请求服务器端发送json文件
    var getPageJSON = function (newActivityId) {
        var activityId;
        if (typeof(newActivityId) === "number") {
            activityId = newActivityId;
        }
        ;
        var pageJSON;
        $.ajax({
            async: false,
            type: "get",
            dataType: "json",
            url: "http://www.etuan.local/js/activityInfo.json",
            //url:"registration/activityinfo?activityId="+activityId.toString(),
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
        var questionItem;
        //辨析输入
        var n = 0;
        for (var key in newQuestionItem) {
            n++;
        }
        if (typeof(newQuestionItem) === "object" && n === 4 && typeof(newQuestionItem.question_id) === "number"
            && typeof(newQuestionItem.type) === "number" && typeof(newQuestionItem.label) === "string"
            && typeof(newQuestionItem.content) === "object") {
            questionItem = newQuestionItem;
        }
        var divQuestion = document.createElement("div");
        divQuestion.setAttribute("id", "question" + questionItem.question_id.toString());

        var divType = document.createElement("div");
        divType.setAttribute("id", "type" + questionItem.question_id.toString());

        var pType = document.createElement("p");
        pType.setAttribute("id", "intro" + questionItem.question_id.toString());
        var introText;

        var divContent = document.createElement("div");
        divContent.setAttribute("id", "content" + questionItem.question_id.toString());

        var elementsFilling;
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
                introText = document.createTextNode("学号");
                break;
            case 102:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                elementFilling.setAttribute("placeholder", "请输入您的姓名");
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
                elementFilling.setAttribute("placeholder", "请输入您的校园网手机短号");
                introText = document.createTextNode("手机短号");
                break;
            case 111:
                elementFilling = document.createElement("input");
                elementFilling.setAttribute("type", "text");
                elementFilling.setAttribute("placeholder", "请填写您的籍贯");
                introText = document.createTextNode("籍贯");
                break;
            case 112:
                elementFilling = document.createElement("select");
                for(var department1 in questionItem.content){
                    elementFilling.options.add(new Option(department1,questionItem.content[department1]));
                }
                introText = document.createTextNode("第一意向部门");
                break;
            case 113:
                elementFilling = document.createElement("select");
                for(var department2 in questionItem.content){
                    elementFilling.options.add(new Option(department2,questionItem.content[department2]));
                }
                introText = document.createTextNode("第二意向部门");
                break;
            case 114:
                elementFilling = document.createElement("select");
                for(var department3 in questionItem.content){
                    elementFilling.options.add(new Option(department3,questionItem.content[department3]));
                }
                introText = document.createTextNode("第三意向部门");
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
        var pageJson;
        //辨析输入
        var n = 0;
        for (var key in newPageJson) {
            n++;
        }
        if (typeof(newPageJson) === "object" && n === 7 && typeof(newPageJson.activityId) === "number"
            && typeof(newPageJson.start_time) === "string" && typeof(newPageJson.stop_time) === "string"
            && typeof(newPageJson.limit_grade) === "string" && newPageJson.limit_grade.length === 5
            && typeof(newPageJson.name) === "string" && typeof(newPageJson.theme) === "number"
            && typeof(newPageJson.questions) === "object") {
            pageJson = newPageJson;
        }

        //顺次添加各个项目
        for (var questionItem in pageJson.questions) {
            createCommonListItem(pageJson.questions[questionItem]);
        }

        //添加页面标题
        document.title = pageJson.name;
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
    function is_weixn(){
        var ua = navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i)=="micromessenger") {
            return true;
        } else {
            return false;
        }
    }
    if(is_weixn()){
        $("#logout").remove();
    }
    //时间变量准备
    var nowDate = new Date();
    var checkStartTime = activityPageJson.start_time.split(/[\s:-]/);
    var checkStopTime = activityPageJson.stop_time.split(/[\s:-]/);
    var startDate = new Date(checkStartTime[0], parseInt(checkStartTime[1]) - 1, checkStartTime[2], checkStartTime[3], checkStartTime[4], 0);
    var stopDate = new Date(checkStopTime[0], parseInt(checkStopTime[1]) - 1, checkStopTime[2], checkStopTime[3], checkStopTime[4], 0);
    //输入具体时间
    $("#timeinfo")[0].innerText = "报名时间： " + checkStartTime[1] + "月" + checkStartTime[2] + "日 " + checkStartTime[3] + ":" + checkStartTime[4] +
        " ~ " + checkStopTime[1] + "月" + checkStopTime[2] + "日 " + checkStopTime[3] + ":" + checkStopTime[4];
    //检查时间
    if (nowDate > stopDate) {
        $("div").attr("disabled", "true");
        $("input").attr("disabled", "true");
        $("textarea").attr("disabled", "true");
        $("select").attr("disabled", "true");
        $("#submit").remove();
        var contentafter = "<p>报名已经结束</p>";
        $("#regbutton").append(contentafter);
        alert("对不起，你来晚了哦(T_T)");
    }
    else if (nowDate < startDate) {
        $("div").attr("disabled", "true");
        $("input").attr("disabled", "true");
        $("textarea").attr("disabled", "true");
        $("select").attr("disabled", "true");
        $("#submit").remove();
        var contentbefore = "<p>报名还未开始</p>";
        $("#regbutton").append(contentbefore);
        alert("客官稍安勿躁，还没开门~");
    }

    //开始整个报名表的运作部分
    //检查是否属于允许报名的学号
    var isAtRightGrade = function (newStuId, newLimitGrade) {
        var stuId, limitGrade;
        if (typeof(newLimitGrade) === "string" && typeof(parseInt(newLimitGrade)) === "number" && newLimitGrade.length === 5
            && typeof(newStuId) === "string" && newStuId.length === 8 || newStuId.length === 9 && typeof(parseInt(newStuId)) === "number") {
            limitGrade = parseInt(newLimitGrade);
            stuId = newStuId;
        }
        else {
            return false;
        }

        //表示获得学号前两位
        var gradePattern = new RegExp("^..");
        var stuGrade = parseInt(gradePattern.exec(stuId));
        //利用布尔运算获得研究生的情况结果
        var yanResult = stuId.length === 9 && parseInt(limitGrade / 10000) === 1;
        //利用布尔运算获得本科生的情况结果，其中15-stuGrade为其本科年级
        var benResult = stuId.length === 8 && parseInt(limitGrade % parseInt(Math.pow(10, 15 - stuGrade)) / parseInt(Math.pow(10, 14 - stuGrade))) === 1;
        return (yanResult || benResult);
    };
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
        var patternShortCellphoneNumber = new RegExp("^[0-9]{6}$");
        var patternQQNumber = new RegExp("^[0-9]{6,10}$");
        var patternEMail = new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-._]*@.+\.[a-zA-z]{2,4}$");
        var matchResult = true;
        switch (type) {
            case 101:
                matchResult = patternStuId.test(matchString) && isAtRightGrade(matchString, activityPageJson.limit_grade);
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
            case 110:
                matchResult = patternShortCellphoneNumber.test(matchString);
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
    //用户表单数据格式
    var participatorInfoJson = {
        used_time: "",
        result: []
    };
    //点击提交按钮时停止计时，并且打包数据，发送数据
    $("#submit").click(function () {
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
            //未考虑复选框CHECKBOX的情况，谁让那是个异类呢。
            var inputString = document.getElementById("answer" + i.toString()).value;
            if (isMatchFormat(inputString, activityPageJson.questions[i - 1].type)) {
                questionItemResult.answer = inputString;
            }
            else {
                alert(activityPageJson.questions[i - 1].label + "，这一项你的输入有误哦！");
                questionItemResult.answer = "这里有错->" + inputString;
            }

            participatorInfoJson.result[i - 1] = questionItemResult;
        }
        var sendJson = {activityId: activityPageJson.activityId, participatorInfo: JSON.stringify(participatorInfoJson)};
        //dev阶段采用alert形式表示数据
        console.log(sendJson);
        //利用Ajax把Json用POST上去
        $.ajax({
            type: "POST",
            url: "registration/participateinactivity",
            data: sendJson
        });
    });
});