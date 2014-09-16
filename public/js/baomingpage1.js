$(document).ready(function(){var l=function(o){var p;if(typeof(o)==="number"){p=o}var q;$.ajax({async:false,type:"get",dataType:"json",url:"/registration/activityinfo?activityId="+p.toString(),success:function(r){if(q===undefined){q=r}},error:function(){alert("当前网络不佳，暂时无法进行报名活动")}});return q};var b=function(q){var x=q;var D=document.createElement("div");D.setAttribute("id","question"+x.question_id.toString());var r=document.createElement("div");r.setAttribute("id","type"+x.question_id.toString());var w=document.createElement("p");w.setAttribute("id","intro"+x.question_id.toString());var t;var y=document.createElement("div");y.setAttribute("id","content"+x.question_id.toString());var A;switch(x.type){case 1:A=document.createElement("input");A.setAttribute("type","text");t=document.createTextNode(x.label);break;case 2:A=document.createElement("textarea");A.setAttribute("rows","6");A.setAttribute("style","resize:none");t=document.createTextNode(x.label);break;case 3:A=document.createElement("select");var B=x.content;for(var p in B){A.options.add(new Option(B[p].toString(),p.toString()))}t=document.createTextNode(x.label);break;case 101:A=document.createElement("input");A.setAttribute("type","number");A.setAttribute("placeholder","请输入您的学号");A.setAttribute("disabled",true);A.value=_stuId;t=document.createTextNode("学号");break;case 102:A=document.createElement("input");A.setAttribute("type","text");A.setAttribute("placeholder","请输入您的姓名");A.setAttribute("disabled",true);A.value=_stuName;t=document.createTextNode("姓名");break;case 103:A=document.createElement("select");A.options.add(new Option("男生♂","1"));A.options.add(new Option("女生♀","0"));t=document.createTextNode("性别");break;case 104:A=document.createElement("select");A.options.add(new Option("机械工程学院","机械工程学院"));A.options.add(new Option("电子信息学院","电子信息学院"));A.options.add(new Option("通信工程学院","通信工程学院"));A.options.add(new Option("自动化学院","自动化学院"));A.options.add(new Option("计算机学院","计算机学院"));A.options.add(new Option("生命信息与仪器工程学院","生命信息与仪器工程学院"));A.options.add(new Option("材料与环境工程学院","材料与环境工程学院"));A.options.add(new Option("软件工程学院","软件工程学院"));A.options.add(new Option("理学院","理学院"));A.options.add(new Option("经济学院","经济学院"));A.options.add(new Option("管理学院","管理学院"));A.options.add(new Option("会计学院","会计学院"));A.options.add(new Option("外国语学院","外国语学院"));A.options.add(new Option("数字媒体与艺术设计学院","数字媒体与艺术设计学院"));A.options.add(new Option("人文与法学院","人文与法学院"));A.options.add(new Option("马克思主义学院","马克思主义学院"));A.options.add(new Option("卓越学院","卓越学院"));A.options.add(new Option("信息工程学院","信息工程学院"));A.options.add(new Option("国际教育学院","国际教育学院"));A.options.add(new Option("继续教育学院","继续教育学院"));t=document.createTextNode("学院");break;case 105:A=document.createElement("input");A.setAttribute("type","text");A.setAttribute("placeholder","请输入您的专业");t=document.createTextNode("专业");break;case 106:A=document.createElement("textarea");A.setAttribute("placeholder","请说说您的特长");A.setAttribute("rows","6");A.setAttribute("style","resize:none");t=document.createTextNode("特长");break;case 107:A=document.createElement("input");A.setAttribute("type","email");A.setAttribute("placeholder","请输入您的电子邮箱地址");t=document.createTextNode("电子邮箱");break;case 108:A=document.createElement("input");A.setAttribute("type","number");A.setAttribute("placeholder","请输入您的QQ号码");t=document.createTextNode("QQ");break;case 109:A=document.createElement("input");A.setAttribute("type","number");A.setAttribute("placeholder","请输入您的手机长号");t=document.createTextNode("手机长号");break;case 110:A=document.createElement("input");A.setAttribute("type","number");A.setAttribute("placeholder","请输入您的移动短号");t=document.createTextNode("移动短号");break;case 111:A=document.createElement("input");A.setAttribute("type","text");A.setAttribute("placeholder","请填写您的籍贯");t=document.createTextNode("籍贯");break;case 112:A=document.createElement("select");var o=JSON.parse(x.content);for(var v=0;v<o.length;v++){A.options.add(new Option(o[v],o[v]))}t=document.createTextNode("第一志愿部门");break;case 113:A=document.createElement("select");var C=JSON.parse(x.content);for(var u=0;u<C.length;u++){A.options.add(new Option(C[u],C[u]))}t=document.createTextNode("第二志愿部门");break;case 114:A=document.createElement("select");var z=JSON.parse(x.content);for(var s=0;s<z.length;s++){A.options.add(new Option(z[s],z[s]))}t=document.createTextNode("第三志愿部门");break;case 115:A=document.createElement("select");A.options.add(new Option("是","是"));A.options.add(new Option("否","否"));t=document.createTextNode("是否服从调剂");break;default:A=document.createElement("div");t=document.createTextNode("");break}A.setAttribute("id","answer"+x.question_id.toString());w.appendChild(t);r.appendChild(w);D.appendChild(r);y.appendChild(A);D.appendChild(y);document.getElementById("regform").appendChild(D)};var c=function(q){var o=q;for(var p in o.questions){b(o.questions[p])}document.title=o.name};var m=_activityId;var h;if(typeof(m)==="number"){h=l(m)}c(h);function i(){var o=navigator.userAgent.toLowerCase();if(o.match(/MicroMessenger/i)=="micromessenger"){return true}else{return false}}if(i()){$("#logout").remove()}var d;$.ajax({async:false,type:"get",dataType:"json",url:"/organization/org-info?activityId="+_activityId,success:function(o){if(d===undefined){d=o}},error:function(){alert("当前网络不佳，暂时无法获取社团信息")}});var k=document.createTextNode(" "+h.name);var a=document.createElement("img");a.setAttribute("id","titlelogo");a.setAttribute("class","img-rounded");a.setAttribute("src",d.logo_url);a.setAttribute("alt",h.name);if(h.theme===1){document.getElementById("titlearea").insertBefore(a,document.getElementById("title"))}else{document.getElementById("title").appendChild(a)}document.getElementById("title").appendChild(k);$("#orginfo").prop("href","/shetuan/"+d.org_id);var n=h.start_time.split(/[\s:-]/);var f=h.stop_time.split(/[\s:-]/);$("#timeinfo")[0].textContent="报名时间： "+n[1]+"月"+n[2]+"日 "+n[3]+":"+n[4]+" ~ "+f[1]+"月"+f[2]+"日 "+f[3]+":"+f[4];if(_IsGrade===1){if(_IsTime===1){}else{$("input").prop("disabled",true);$("textarea").prop("disabled",true);$("select").prop("disabled",true);$("#submit").prop("disabled",true);alert("对不起，现在还不是报名时间。")}}else{if(_IsTime===1){$("input").prop("disabled",true);$("textarea").prop("disabled",true);$("select").prop("disabled",true);$("#submit").prop("disabled",true);alert("对不起，您的年级不在报名范围内。")}else{$("input").prop("disabled",true);$("textarea").prop("disabled",true);$("select").prop("disabled",true);$("#submit").prop("disabled",true);alert("对不起，您的年级不在报名范围内且当前不是报名时间。")}}var j=function(t,q){var v,s;if(typeof(t)==="string"&&typeof(q)==="number"){v=t;s=q}else{return false}var o=new RegExp("^1[1-4][0-9]{6,7}$");var r=new RegExp("^((1[358][0-9])|(17[0678]))[0-9]{8}$");var w=new RegExp("^[0-9]{6,10}$");var u=new RegExp("^[a-zA-Z0-9][a-zA-Z0-9-._]*@.+.[a-zA-z]{2,4}$");var p=true;switch(s){case 101:p=o.test(v);break;case 107:p=u.test(v);break;case 108:p=w.test(v);break;case 109:p=r.test(v);break;default:break}return p};var e=0;function g(){e++}setInterval(g,1000);$("#submit").click(function(){var s={used_time:"",result:[]};var q=true;var p=e;s.used_time+=parseInt(p/3600).toString()+":";p=p%3600;s.used_time+=parseInt(p/60).toString()+":";s.used_time+=(p%60).toString();for(var r=1;r<=h.questions.length;r++){var o={question_id:"",answer:""};o.question_id=h.questions[r-1].question_id.toString();var u=document.getElementById("answer"+r.toString()).value;if(j(u,h.questions[r-1].type)){o.answer=u}else{alert("【"+h.questions[r-1].label+"】这一项你的输入有误哦！");q=false}s.result[r-1]=o}if(q){$("#submit").prop("disabled",true);var t={activityId:h.activityId,participatorInfo:JSON.stringify(s)};$.ajax({type:"POST",url:"/registration/participateinactivity",data:t,dataType:"json",success:function(v){if(v.status==="success"){alert(v.content);window.location.href="/baoming/success"}else{if(v.status==="fail"){alert(v.content);$("#submit").prop("disabled",false)}}},error:function(x,v,w){if(v==="timeout"){alert("连接超时，请检查网络");$("#submit").prop("disabled",false)}else{if(v==="error"||v==="parseerror"){alert("提交失败："+v+" "+w.toString());$("#submit").prop("disabled",false)}}}})}})});