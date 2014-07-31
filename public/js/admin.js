
(function() {
    // Toggle Left Menu
   jQuery('.menu-list > a').click(function() {
      
      var parent = jQuery(this).parent();
      var sub = parent.find('> ul');
      
      if(!jQuery('body').hasClass('left-side-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.main-content').css({height: ''});
               mainContentHeightAdjust();
            });
         } else {
            visibleSubMenuClose();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
                mainContentHeightAdjust();
            });
         }
      }
      return false;
   });

   function visibleSubMenuClose() {
      jQuery('.menu-list').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }

   function mainContentHeightAdjust() {
      // Adjust main content height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.main-content').height())
         jQuery('.main-content').height(docHeight);
   }

   //  class add mouse hover
   jQuery('.custom-nav > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });

})(jQuery);

	 $(document).ready(function () {
        $('#main').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
		$('#sidebar').load('../sidebar.html');
		$("#remarkbox").hide();
		$("#originurlbox").hide();
		});
		
		originalheight();
		$("#extraform").children(".form-group").hide();
		//添加元素到左边
		$("#studentID2").click(function(){
			changeheight();
			$(this).hide();
			$("#studentID1").show();
			});
		$("#studentname2").click(function(){
			changeheight();
			$(this).hide();
			$("#studentname1").show();
			});
		$("#sex2").click(function(){
			changeheight();
			$(this).hide();
			$("#sex1").show();
			});
		$("#xueyuan2").click(function(){
			changeheight();
			$(this).hide();
			$("#xueyuan1").show();
			});
		$("#major2").click(function(){
			changeheight();
			$(this).hide();
			$("#major1").show();
			});
		$("#specialty2").click(function(){
			changeheight();
			$(this).hide();
			$("#specialty1").show();
			});
		$("#Email2").click(function(){
			changeheight();
			$(this).hide();
			$("#Email1").show();
			});
		$("#QQ2").click(function(){
			changeheight();
			$(this).hide();
			$("#QQ1").show();
			});
		$("#phonenumlong2").click(function(){
			changeheight();
			$(this).hide();
			$("#phonenumlong1").show();
			});
		$("#phonenumshort2").click(function(){
			changeheight();
			$(this).hide();
			$("#phonenumshort1").show();
			});
		$("#origin2").click(function(){
			changeheight();
			$(this).hide();
			$("#origin1").show();
			});
		$("#wish1-2").click(function(){
			changeheight();
			$(this).hide();
			$("#wish1").show();
			});
		$("#wish2-2").click(function(){
			changeheight();
			$(this).hide();
			$("#wish2").show();
			});
		$("#wish3-2").click(function(){
			changeheight();
			$(this).hide();
			$("#wish3").show();
			});
		$("#tiaoji2").click(function(){
			changeheight();
			$(this).hide();
			$("#tiaoji1").show();
			});

		function originalheight() {	
			var height1 , height2 , maxheight;
			height1 = $('#extraform').outerHeight(true);
			height2 = $('.extralist').outerHeight(true);
			if ( height1 > height2 ){ maxheight = height1; }
				else { maxheight = height2; }
			$('#addform').css('height', maxheight - 300 + "px");
			};
		function changeheight() {	
			var height1 , height2 , maxheight;
			height1 = $('#extraform').outerHeight(true);
			height2 = $('.extralist').outerHeight(true);
			if ( height1 > height2 ){ maxheight = height1; }
				      		   else { maxheight = height2; }
			$('#addform').css('height', maxheight + 200 + "px");
			};
		//删除按钮
		$("#delete1").click(function(){
			changeheight();
			$("#studentID1").hide();
			$("#studentID2").show();
			});
		$("#delete2").click(function(){
			changeheight();
			$("#studentname1").hide();
			$("#studentname2").show();
			});
		$("#delete3").click(function(){
			changeheight();
			$("#sex1").hide();
			$("#sex2").show();
			});
		$("#delete4").click(function(){
			changeheight();
			$("#xueyuan1").hide();
			$("#xueyuan2").show();
			});
		$("#delete5").click(function(){
			changeheight();
			$("#major1").hide();
			$("#major2").show();
			});
		$("#delete6").click(function(){
			changeheight();
			$("#specialty1").hide();
			$("#specialty2").show();
			});
		$("#delete7").click(function(){
			changeheight();
			$("#Email1").hide();
			$("#Email2").show();
			});
		$("#delete8").click(function(){
			changeheight();
			$("#QQ1").hide();
			$("#QQ2").show();
			});
		$("#delete9").click(function(){
			changeheight();
			$("#phonenumlong1").hide();
			$("#phonenumlong2").show();
			});
		$("#delete10").click(function(){
			changeheight();
			$("#phonenumshort1").hide();
			$("#phonenumshort2").show();
			});
		$("#delete11").click(function(){
			changeheight();
			$("#origin1").hide();
			$("#origin2").show();
			});
		$("#delete12").click(function(){
			changeheight();
			$("#wish1").hide();
			$("#wish1-2").show();
			});
		$("#delete13").click(function(){
			changeheight();
			$("#wish2").hide();
			$("#wish2-2").show();
			});
		$("#delete14").click(function(){
			changeheight();
			$("#wish3").hide();
			$("#wish3-2").show();
			});
		$("#delete15").click(function(){
			changeheight();
			$("#tiaoji1").hide();
			$("#tiaoji2").show();
			});
		//向上移动
		$(".moveup").click(function(){
			var content;
			content = $(this).parents(".form-group");
  			content.insertBefore(content.prev());
			});
		//向下移动
		$(".movedown").click(function(){
			var content2;
			content2 = $(this).parents(".form-group");
  			content2.insertAfter(content2.next());
			});
		
		$(function () { $("[data-toggle='tooltip']").tooltip(); });  //下标文字
		
		//添加摘要
		$("#addremarkbtn").click(function(){
			$(this).hide();
			$("#remarkbox").show();
			});
		
		//添加原文链接
		$("#addoriginurlbtn").click(function(){
			$(this).hide();
			$("#originurlbox").show();
			});
