function sortOrg(a, b) {
    return a.internal_order - b.internal_order;
}

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

$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
    $('.borderDiv').mouseover(function () {
        $(this).css('border', '1px solid #a8d154');
    });
    $('.borderDiv').mouseout(function () {
        $(this).css('border', '1px solid #ddd');
    });
    if ($.getUrlParam('from') == 'e-tuan' || $.getUrlParam('from') =='e-hduhdu' )
    {
        $('#nav').hide();
    }

    $.get('/organization/organization-info', function (data, status) {
        if (status == 'success') {
            var regDivTpl = ' <div class="col-xs-12 col-sm-4 col-md-3">' +
                '<a href="{0}">' +
                '<div class="thumbnail borderDiv">' +
                '<p class="listhead">{1}</p>' +
                '<img style="width: 150px; height: 150px" src="{2}">' +
                '<p class="status text-view-more">查看介绍'+
                '<span class="glyphicon glyphicon-chevron-right"></span></p>' +
                '</div>' +
                '</a>' +
                '</div>';
            eval(data);
            data.sort(sortOrg);
            var school = [];
            for (var i = 0; i < data.length; i++) {
                var logoUrl = data[i].logo_url.split('.');
                var orgUrl = '/shetuan/' + data[i].org_id;
                data[i].logo_url += '@300w.' + logoUrl[logoUrl.length - 1];
                var regDiv = String.format(regDivTpl,
                    orgUrl, data[i].name, data[i].logo_url);
                if (data[i].type == '校级组织') {
                    $('#universityLevel').append(regDiv);
                }
                else if (data[i].type == '院级组织') {
                    var schoolIndex = school.indexOf(data[i].school);
                    if (schoolIndex < 0) {
                        schoolIndex = school.length;
                        $('#schoolLevel').append('<div id="school' + schoolIndex +
                            '"><div class="clearfix"></div><h3>' + data[i].school + '</h3><hr></div>');
                        school.push(data[i].school);
                    }
                    $('#school' + schoolIndex).append(regDiv);
                }
                else {
                    $('#club').append(regDiv);
                }
            }
        }
    })
});
