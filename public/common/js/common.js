/**
 * @author: HieuNLD 2014/09/23
 */
$(function () {
    /**
     * @author: HieuNLD 2014/09/18
     */
    $('.action').on('click', function () {
        var action = $(this).attr('action'),
            title = $(this).attr('title');
        if (action && action != '') {
            if (title == 'Delete') {
                if (!confirm('Are you sure you want to delete this?')) {
                    return false;
                }
            }
            window.location.href = action;
        }
    });

    $('#root_category_id').on('change', function () {
        var postId = {'id': $(this).val()};
        getDataForCombo($(this).attr('action'), postId, "createRowForTable('list-shop-category', msg.data);");
    });

    $('.openPopup').on('click', function() {
        var action  = $(this).attr('action'),
            params  = $(this).attr('params'),
            targets = $(this).attr('targets'),
            func    = $(this).attr('func');

        if(action) {
            openWin(action, '', '', func);
        }
    });

    $('.link-submit').on('click', function() {
        var forForm = $(this).parents().find('ul.pager').attr('forForm');
        if(forForm && forForm != '') {
            var action = $('#' + forForm).attr('action', $(this).attr('action'));
            $('#' + forForm).submit();
        }
    });
});

function openWin(url, params, targets, func) {
    try {
        params  = params  || '';
        targets = targets || '';
        func    = func    || '';
        popup = window.open(url, '_blank', 'height=500,width=600,status=yes,scrollbars=yes');
        popup.params  = params;
        popup.targets = targets;
        popup.func    = func;

        popup.focus();

        return false;
    } catch (err) {
        console.log(err);
        window.focus();
        if (popup) {
            popup.close();
        }
    }
}

/**
 * @author: HieuNLD 2014/09/29
 */
function createOptForComb(id, data) {
    if ($('#' + id).length > 0) {
        $('#' + id).empty();
        $.each(data, function (text, key) {
            var option = new Option(key, text);
            $('#' + id).append($(option));
        });
    }
}

/**
 * @author: HieuNLD 2014/09/29
 */
function createRowForTable(id, data) {
    if ($('#' + id).length > 0) {
        if (data.length > 0) {
            $('#' + id + ' tbody').empty();

            $.each(data, function (key, text) {
                var td = '<tr class="odd gradeA rows_' + text.id + '">'
                    + '<td class="center">'
                    + '<input type="checkbox" class="return-data" name="cat_' + text.id + '" catname="'+text.name+'" value="' + text.id + '"/>'
                    + '</td>'
                    + '<td>' + text.name + '</td>'
                    + '</tr>';

                $('#' + id + ' tbody').append($(td));
            });
        } else {
            $('#' + id + ' tbody').empty();
            var td = '<tr class="tr-footer">'
                + '<td colspan="2">No data</td>'
                + '</tr>';

            $('#' + id + ' tbody').append($(td));
        }
    }
}

function checkLogout(action) {
    //if (confirm('Are you sure you want to delete this?')) {
    if (confirm('Are you sure you want to logout this?')) {
        if (action) {
            window.location.href = action;
        }
    } else {
        return false;
    }
}

function loadingStart() {
    var cover = $('<div class="loading-cover"></div>')
        .css('position', 'fixed')
        .css('width', $(window).width())
        .css('height', $(window).height())
        .css('z-index', 1000)
        .css('opacity', '0.4')
        .css('filter', 'alpha(opacity=40);')
        .css('background-color', 'black')
        .css('top', 0)
        .appendTo('body');

    var loading = $('<div id="loading"></div>')
        .css('position', 'fixed')
        .css('top', $(window).height() / 2 - 16)
        .css('left', $(window).width() / 2 - 16)
        .appendTo(cover);
}

function loadingEnd() {
    $('.loading-cover').remove();
}

function postProcessData(action, obj, func) {
    if (!func) {
        func = false;
    }
    loadingStart();
    $.ajax({
        type: "POST",
        url: action,
        data: obj
    })
        .success(function (msg) {
            if (func) {
                eval(func);
            }
            loadingEnd();
        });
}

function getDataForCombo(action, obj, func) {
    if (!func) {
        func = false;
    }

    loadingStart();

    $.ajax({
        type: "GET",
        url: action,
        data: obj
    })
        .success(function(msg) {
            if (func) {
                eval(func);
            }
            loadingEnd();
        })
        .error(function() {
            loadingEnd();
        });
}

function getProcessData(action, obj, func) {
    if (!func) {
        func = false;
    }

    loadingStart();

    $.ajax({
        type: "GET",
        url: action,
        data: obj
    })
        .success(function(msg) {
            if (func) {
                eval(func);
            }
            loadingEnd();
        })
        .error(function() {
            loadingEnd();
        });
}