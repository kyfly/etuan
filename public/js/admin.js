(function () {
    // Toggle Left Menu
    jQuery('#sidebar').on('click', '.menu-list > a', function () {

        var parent = jQuery(this).parent();
        var sub = parent.find('> ul');

        if (!jQuery('body').hasClass('left-side-collapsed')) {
            if (sub.is(':visible')) {
                sub.slideUp(200, function () {
                    parent.removeClass('nav-active');
                    jQuery('.main-content').css({height: ''});
                    mainContentHeightAdjust();
                });
            } else {
                visibleSubMenuClose();
                parent.addClass('nav-active');
                sub.slideDown(200, function () {
                    mainContentHeightAdjust();
                });
            }
        }
        return false;
    });

    function visibleSubMenuClose() {
        jQuery('.menu-list').each(function () {
            var t = jQuery(this);
            if (t.hasClass('nav-active')) {
                t.find('> ul').slideUp(200, function () {
                    t.removeClass('nav-active');
                });
            }
        });
    }

    function mainContentHeightAdjust() {
        // Adjust main content height
        var docHeight = jQuery(document).height();
        if (docHeight > jQuery('.main-content').height())
            jQuery('.main-content').height(docHeight);
    }

    //  class add mouse hover
    jQuery('.custom-nav > li').hover(function () {
        jQuery(this).addClass('nav-hover');
    }, function () {
        jQuery(this).removeClass('nav-hover');
    });

})(jQuery);

function loadSidebar() {
    var sidebarDiv = $('#sidebar');
    sidebarDiv.load('/admin/sidebar',
        function () {
            //判断当前页面地址，然后对导航栏进行展开和高亮
            var path = window.location.pathname;
            for (var id in sidebarHref) {
                if (sidebarHref.hasOwnProperty(id))
                    if (sidebarHref[id] == path) {
                        var navItem = $('#' + id);
                        var parent = navItem.parents('.menu-list');
                        if (parent) {
                            parent.addClass('nav-active');
                            navItem.addClass('active');
                        }
                        else
                            navItem.addClass('nav-active');
                    }
            }
            //设定侧边栏高度
            $('#sidebar').height($('#main').outerHeight(true));
        });
    //点击转跳到对应的页面
    sidebarDiv.on('click', "li", function () {
        if ($(this).prop('id'))
            window.location = sidebarHref[$(this).prop('id')];
    })

};

$(document).ready(function () {
    var minHeight = $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px";
    $('#main').css('min-height', minHeight);
    $('#sidebar').height($('#main').outerHeight(true));
    loadSidebar();
    $("#remarkbox").hide();
    $("#originurlbox").hide();
});

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
    };
    function configExtraForm(){
        //每次绑定事件前首先释放所有的click以免造成过度绑定
        $(".delete").off("click");
        $(".moveup").off("click");
        $(".movedown").off("click");
        $(".delete").off("mouseover");
        $(".moveup").off("mouseover");
        $(".movedown").off("mouseover");
        //删除按钮
        $(".delete").on('click',function () {
            var content0;
            content0 = $(this).parent();
            content0.remove();
        });
        $(".delete").on("mouseover",function(){
            $(this).tooltip("show");
        });
        //上移按钮
        $(".moveup").on("click",function () {
            var content1;
            content1 = $(this).parent();
            content1.insertBefore(content1.prev());
        });
        $(".moveup").on("mouseover",function(){
            $(this).tooltip("show");
        });
        //下移按钮
        $(".movedown").on("click",function () {
            var content2;
            content2 = $(this).parent();
            content2.insertAfter(content2.next());
        });
        $(".movedown").on("mouseover",function(){
            $(this).tooltip("show");
        });
    };
    setHeight();
    configExtraForm();
    //添加元素到左边
    $(".target .extralist h4:not(:contains(\"自定义\"))").click(function (e) {
        var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&emsp;&emsp;&emsp;&emsp;&ensp;<a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
        $("#extraform").append(content);
        setHeight();
        configExtraForm();
    });
    $("#zidingyishort2,#zidingyilong2").click(function(e){
        var content = "<div style=\"display: inline\" class=\"form-group\"><label class=\"baomingitem\">" + e.target.innerText + "</label>&emsp;&emsp;&emsp;&emsp;&ensp;<input type=\"text\" placeholder=\"请输入问题描述\"><a class=\"moveup\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向上移动\"><span class=\"glyphicon glyphicon-arrow-up\"></span></a>&ensp;<a class=\"movedown\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"向下移动\"><span class=\"glyphicon glyphicon-arrow-down\"></span></a>&ensp;<a class=\"delete\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"删除项目\"><span class=\"glyphicon glyphicon-trash\"></span></a><hr></div>";
        $("#extraform").append(content);
        setHeight();
        configExtraForm();
    });
});

$(function () {
    $("[data-toggle='tooltip']").tooltip();
});  //下标文字

//添加摘要
$("#addremarkbtn").click(function () {
    $(this).hide();
    $("#remarkbox").show();
});

//添加原文链接
$("#addoriginurlbtn").click(function () {
    $(this).hide();
    $("#originurlbox").show();
});

$(".addimgtxt a").hide();
$(".addimgtxt").mouseover(function () {
    $("#plusbtn").hide();
    $(".addimgtxt a").show();
});
$(".addimgtxt").mouseout(function () {
    $("#plusbtn").show();
    $(".addimgtxt a").hide();
});

$(".bgcolorgrey").hide();
$(".greybox2").mouseover(function () {
    $(".bgcolorgrey").show();
});
$(".greybox2").mouseout(function () {
    $(".bgcolorgrey").hide();
});

$("#grey1").hide();
$("#extrabox1").mouseover(function () {
    $("#grey1").show();
});
$("#extrabox1").mouseout(function () {
    $("#grey1").hide();
});

$("#grey2").hide();
$("#extrabox2").mouseover(function () {
    $("#grey2").show();
});
$("#extrabox2").mouseout(function () {
    $("#grey2").hide();
});

$("#grey3").hide();
$("#extrabox3").mouseover(function () {
    $("#grey3").show();
});
$("#extrabox3").mouseout(function () {
    $("#grey3").hide();
});
