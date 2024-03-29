if (!String.format) {
    String.format = function (format) {
        var args = Array.prototype.slice.call(arguments, 1);
        return format.replace(/{(\d+)}/g, function (match, number) {
            return typeof args[number] != 'undefined' ? args[number] : match;
        });
    };
}

Array.prototype.indexOf = function (val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};

(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return decodeURIComponent(r[2]);
        return null;
    }
})(jQuery);

function isWeiXin() {
    var ua = window.navigator.userAgent.toLowerCase();
    return ua.match(/MicroMessenger/i) == 'micromessenger';
}

$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
    $('.borderDiv').mouseover(function () {
        $(this).css('border', '1px solid #a8d154');
    });
    $('.borderDiv').mouseout(function () {
        $(this).css('border', '1px solid #ddd');
    });
    if ($.getUrlParam('from') === 'e-tuan' && isWeiXin())
    {
        $('#nav').hide();
    }

    $.get('/organization/organization-info', function (data, status) {
        if (status == 'success') {
            var regDivTpl = ' <div class="col-xs-12 col-sm-4 col-md-3">' +
                '<a href="{0}" target="_blank">' +
                '<div class="thumbnail borderDiv">' +
                '<p class="listhead_org">{1}</p>' +
                '<img style="width: 150px; height: 150px" src="{2}" alt="{3}">' +
                '<p class="status text-view-more">在线报名'+
                '<span class="glyphicon glyphicon-chevron-right"></span></p>' +
                '</div>' +
                '</a>' +
                '</div>';
            eval(data);
            var school = [];
            for (var i = 0; i < data.length; i++) {
                var logoUrl = data[i].logo_url.split('.');
                var orgUrl = '/shetuan/' + data[i].org_id;
                if (data[i].org_id == 7)
                    orgUrl = 'http://go.redhome.cc/waitU/';
                var logoType = logoUrl[logoUrl.length - 1] == 'gif' ? 'png' : logoUrl[logoUrl.length - 1];
                data[i].logo_url += '@300w.' + logoType;
                var regDiv = String.format(regDivTpl,
                    orgUrl, data[i].name, data[i].logo_url, data[i].name + 'LOGO');
                switch (data[i].type)
                {
                    case '校级组织':
                        $('#universityLevel').append(regDiv);
                        break;
                    case '职能社团':
                        $('#otherOrg').append(regDiv);
                        break;
                    case '院级组织':
                        var schoolIndex = school.indexOf(data[i].school);
                        if (schoolIndex < 0) {
                            schoolIndex = school.length;
                            $('#schoolLevel').append('<div id="school' + schoolIndex +
                            '"><div class="clearfix"></div><h3>' + data[i].school + '</h3><hr></div>');
                            school.push(data[i].school);
                        }
                        $('#school' + schoolIndex).append(regDiv);
                        break;
                    default:
                        $('#club').append(regDiv);
                }
            }
        }
    })
});
