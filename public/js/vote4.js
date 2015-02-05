$(document).ready(function() {
  var schoolName = ['莱州市第一中学', '侯马一中', '勉县第一中学', '虹桥中学', '浙江省黄岩中学', '海盐高级中学', '福建三明一中', '开化中学', '衢州二中', '浙江省苍南中学', '嘉善高级中学', '浙江省严州中学', '丽水中学', '同煤一中', '春晖中学', '鄞州高中', '新昌中学', '德宏州民族一中', '绵阳中学', '东阳中学', '宜春中学', '宁波二中', '江西师大附中', '河南商丘一高', '河北定州中学', '东阳中学', '柴桥中学', '杭州第四中学', '萧山中学', '浒山中学', '萧山二中', '石家庄精英中学', '缙云中学', '乐清中学', '平顶山一中', '安吉振民高级中学', '浦江中学', '北仑中学', '牌头中学', '海宁市高级中学', '忻州市第一中学 ', '华茂外国语学校高中', '肥东第一中学', '柯桥中学', '台州市第一中学', '灵丘一中', '天台育青中学', '湖州市第二中学', '瓯海区第一中学', '德清一中', '崧厦中学', '大同一中', '松阳县第一中学', '台州中学', '牌头中学', '凤鸣高级中学', '罗浮中学', '余杭第二高级中学', '襄阳市第五中学', '桐乡一中', '嘉兴市第五高级中学', '秀州中学', '草塔中学', '路桥中学', '吴兴高级中学', '兰溪市第三中学', '萧山第五高级中学', '包钢一中', '於潜中学', '越崎中学', '澄潭中学', '海宁市第一中学', '达州市第一中学', '马寅初中学', '会泽县茚旺高级中学', '龙泉市第一中学', '商城高级中学', '赤峰市红旗中学', '经纬中学', '敦煌中学', '南马高中', '南康中学', '仁寿一中', '丹东市第二中学', '东阳二中', '东阳市中天高中', '永康二中', '永康一中'];

  for(var i=1;i<89;i++){
    $('#school-list').append("<tr><td>" + i + "</td><td><button type='button' value='" + i + "' class='modalBtn' data-toggle='modal' data-target='#myModal'>" + schoolName[i-1] + "&nbsp;<span class='glyphicon glyphicon-new-window'></span></button></td><td><input class='checkbox' type='checkbox' value='" + i + "'/></td></tr>");
  }

  $(".modalBtn").click(function(){

    $('#sch-logo').parent(".col-xs-3").show();
    var myvalue=$(this).val();
    $("#big_pic").empty();

    if(myvalue>75&&myvalue<82){
      $('#sch-logo').parent(".col-xs-3").hide();
    }

    $.getJSON('/vote/muxiao/intro_source/' + myvalue +'.json', function(data){
      $('#title').html(data.name);
      $('#description').html(data.description);
    });

    $('#sch-logo').attr('src', 'http://img.kyfly.net/etuan/vote/4/' + myvalue + '-0.jpg');
    $('#img').attr('src', 'http://img.kyfly.net/etuan/vote/4/1' + myvalue + '-0.jpg');
    $('#big_pic').attr('href', 'http://img.kyfly.net/etuan/vote/2/introduce/' + myvalue + '.jpg');

    var picNumber = [4,1,2,1,4,4,3,5,7,4,1,6,8,6,1,6,4,4,1,2,2,3,2,1,3,2,2,4,6,2,3,8,3,2,8,3,5,4,8,2,3,5,2,2,8,7,8,4,1,2,4,2,3,5,8,7,8,2,3,2,1,4,8,7,2,2,1,8,3,1,8,3,6,2,7,8,5,3,6,8,2,5,8,4,4,3,2,8];

    for(var i=1;i<picNumber[myvalue-1]+1;i++) {
      $('#big_pic').append("<img id='img' id='pic" + i + "' style='' src='http://img.kyfly.net/etuan/vote/4/" + myvalue + "-" + i + ".jpg'>");
    }
  });

});

