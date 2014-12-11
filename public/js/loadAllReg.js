
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
        $(this).css('border', '1px solid #ffb800');
    });
    $('.borderDiv').mouseout(function () {
        $(this).css('border', '1px solid #ddd');
    });
    if ($.getUrlParam('from') === 'e-tuan' && isWeiXin())
    {
        $('#nav').hide();
    }
    $.get('/organization/organization-registration', function (data, status) {
        if (status == 'success') {
            var regDivTpl = ' <div class="col-xs-12 col-sm-4 col-md-3">' +
                '<a href="{0}" target="_blank">' +
                '<div class="thumbnail borderDiv">' +
                '<p class="listhead">{1}</p>' +
                '<img style="width: 150px; height: 150px" src="{2}" alt="{3}">' +
                '<p class="status {4}">{5}</p>' +
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
                var logoType = logoUrl[logoUrl.length - 1] == 'gif' ? 'png' : logoUrl[logoUrl.length - 1];
                data[i].logo_url += '@300w.' + logoType;
                var regDiv = String.format(regDivTpl,
                    regUrl, data[i].reg_name, data[i].logo_url, data[i].reg_name, data[i].statusClass, data[i].status);
                data[i].status == "即将开始" ?
                    $('#ready').append(regDiv):
                    (data[i].status == "正在进行" ?
                        $('#started').append(regDiv):
                        $('#ended').append(regDiv));
            }
        }
    })
});
