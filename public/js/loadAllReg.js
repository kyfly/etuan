
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
        $(this).css('border', '1px solid #ffb800');
    });
    $('.borderDiv').mouseout(function () {
        $(this).css('border', '1px solid #ddd');
    });
    if ($.getUrlParam('from') == 'e-tuan' || $.getUrlParam('from') =='e-hduhdu' )
    {
        $('#nav').hide();
    }

    $.get('/organization/organization-registration', function (data, status) {
        if (status == 'success') {
            var regDivTpl = ' <div class="col-xs-12 col-sm-4 col-md-3">' +
                '<a href="{0}" target="_blank">' +
                '<div class="thumbnail borderDiv">' +
                '<p class="listhead">{1}</p>' +
                '<img style="width: 150px; height: 150px" src="{2}">' +
                '<p class="status {3}">{4}</p>' +
                '</div>' +
                '</a>' +
                '</div>';
            eval(data);
            var school = [];
            for (var i = 0; i < data.length; i++) {
                data[i].status == "即将开始" ?
                    data[i].statusClass = 'text-coming':
                    (data[i].status == "正在进行" ?
                        data[i].statusClass = 'text-on':
                        data[i].statusClass = 'text-over');
                var logoUrl = data[i].logo_url.split('.');
                var regUrl = '/baoming/' + data[i].reg_id;
                data[i].logo_url += '@300w.' + logoUrl[logoUrl.length - 1];
                var regDiv = String.format(regDivTpl,
                    regUrl, data[i].reg_name, data[i].logo_url, data[i].statusClass, data[i].status);
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
