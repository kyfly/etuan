function sortOrg(a, b) {
    return (a.statusWords == b.statusWords) ?
        a.internal_order - b.internal_order :
        a.statusWords - b.statusWords;
}

function setStatus(data)
{
    for (var i = 0; i < data.length; i++)
    {
        var startTime = new Date(data[i].start_time);
        var stopTime = new Date(data[i].stop_time);
        var now = new Date();
        if (now < startTime) {
            data[i].statusWords = "即将开始";
            data[i].statusInt = 2;
            data[i].statusClass = 'text-coming';
        }
        else if (now >= startTime && now <= stopTime) {
            data[i].statusWords = "正在进行";
            data[i].statusInt = 1;
            data[i].statusClass = 'text-on';
        }
        else {
            data[i].statusWords = "已经结束";
            data[i].statusInt = 3;
            data[i].statusClass = 'text-over';
        }
    }
    return data;
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

$(document).ready(function () {
    $('#mainHeight').css('min-height', $(window).outerHeight(true) - $('#nav').outerHeight(true) - $('#footer').outerHeight(true) + "px");
    $('.borderDiv').mouseover(function () {
        $(this).css('border', '1px solid #ffb800');
    });
    $('.borderDiv').mouseout(function () {
        $(this).css('border', '1px solid #ddd');
    });


    $.get('/organization/organization-registration', function (data, status) {
        if (status == 'success') {
            var regDivTpl = ' <div class="col-xs-12 col-sm-4 col-md-3">' +
                '<a href="{0}">' +
                '<div class="thumbnail borderDiv">' +
                '<p class="listhead">{1}</p>' +
                '<img width="150px" height="150px" src="{2}">' +
                '<p class="status {3}">{4}</p>' +
                '</div>' +
                '</a>' +
                '</div>';
            eval(data);
            data = setStatus(data);
            data.sort(sortOrg);
            var school = [];
            for (var i = 0; i < data.length; i++) {
                var logoUrl = data[i].logo_url.split('.');
                var regUrl = '/baoming/' + data[i].reg_id;
                data[i].logo_url += '@300w.' + logoUrl[logoUrl.length - 1];
                var regDiv = String.format(regDivTpl,
                    regUrl, data[i].reg_name, data[i].logo_url, data[i].statusClass, data[i].statusWords);
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
