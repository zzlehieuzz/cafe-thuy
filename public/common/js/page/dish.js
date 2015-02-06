/**
 * @author: HieuNLD 2014/09/29
 */
function createRowForTable(id, data) {
    if ($('#' + id).length > 0) {
        if ($('#' + id + ' tbody').length > 0) {
            if($('#' + id + ' .no-data').length > 0) {
                $('#' + id + ' .no-data').remove();
            }

            $.each(data, function (key, val) {
                var checkId = $('#' + id).find('#category_' + val.id);
                if (checkId.length == 0) {
                    var td = '<tr class="odd gradeA" id="category_' + val.id + '">'
                        + '<input name="category_list[]" value="' + val.id + '" type="hidden"/>'
                        + '<td>' + val.categoryName + '</td>'
                        + '<td>'
                        + '<button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteCategory(this)"><i class="fa fa-times"></i></button>'
                        + '</td>'
                        + '</tr>';

                    $('#' + id + ' tbody').append($(td));
                }
            });
        } else {
            var td = '<tr class="no-data">' + '<td colspan="2">No data</td>' + '</tr>';

            $('#' + id + ' tbody').append($(td));
        }
    }
}

function deleteCategory(me) {
    if($(me).parent().parent()) {
        var cntTr = $('#categoryTable tbody').find('.odd');

        $(me).parent().parent().remove();
        if (cntTr.length == 1) {
            var td = '<tr class="no-data"><td colspan="2">No data</td></tr>';
            $('#categoryTable tbody').append($(td));
        }
    }
}
