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
    setSidebarHeight();
    //点击转跳到对应的页面
    sidebarDiv.on('click', "li", function () {
        if ($(this).prop('id'))
            window.location = sidebarHref[$(this).prop('id')];
    })

}

function setSidebarHeight()
{
    if ($(window).width() > 970)
        $('#sidebar').height($('#main').outerHeight(true));

}

$(document).ready(function () {
    var minHeight = $(window).outerHeight(true) - $('#nav').outerHeight(true)
        - $('#footer').outerHeight(true) - 62 + "px";
    $('#main').css('min-height', minHeight);
    setSidebarHeight();
    loadSidebar();
    $("#remarkbox").hide();
    $("#originurlbox").hide();

    $(window).resize(function() {
        var minHeight = $(window).outerHeight(true) - $('#nav').outerHeight(true)
            - $('#footer').outerHeight(true) - 62 + "px";
        $('#main').css('min-height', minHeight);
        setSidebarHeight();
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
