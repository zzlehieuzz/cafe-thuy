/**
 * @author: HieuNLD 2014/09/29
 */
function createRowForTableShop(id, data) {
    if ($('#' + id).length > 0) {
        if ($('#' + id + ' tbody').length > 0) {
            if($('#' + id + ' .no-data').length > 0) {
                $('#' + id + ' .no-data').remove();
            }

            $.each(data, function (key, val) {
                var checkId = $('#' + id).find('#' + val.root_category_id + '_' + val.id);
                if (checkId.length == 0) {
                    var td = '<tr id="' + val.root_category_id + '_' + val.id + '" class="odd gradeA" >'
                        + '<input name="root_category_list[]" value="' + val.root_category_id + '" type="hidden"/>'
                        + '<input name="category_list[]" value="' + val.id + '" type="hidden"/>'
                        + '<td>' + val.root_category_name + '</td>'
                        + '<td>' + val.name + '</td>'
                        + '<td>'
                        + '<button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteCategory(this)"><i class="fa fa-times"></i></button>'
                        + '</td>'
                        + '</tr>';

                    $('#' + id + ' tbody').append($(td));
                }
            });
        } else {
            var td = '<tr class="no-data">' + '<td colspan="3">No data</td>' + '</tr>';

            $('#' + id + ' tbody').append($(td));
        }
    }
}

function createRowForTableShopRoad(id, data) {
    if ($('#' + id).length > 0) {
        if ($('#' + id + ' tbody').length > 0) {
            if($('#' + id + ' .no-data').length > 0) {
                $('#' + id + ' .no-data').remove();
            }

            $.each(data, function (key, val) {
                var checkId = $('#' + id).find('#' + val.root_category_id + '_' + val.id);
                if (checkId.length == 0) {
                    var td = '<tr id="' + val.root_category_id + '_' + val.id + '" class="odd gradeA">'
                        + '<input name="root_road_list[]" value="' + val.root_road_id + '" type="hidden"/>'
                        + '<input name="road_list[]" value="' + val.id + '" type="hidden"/>'
                        + '<td>' + val.root_road_name + '</td>'
                        + '<td>' + val.name + '</td>'
                        + '<td>'
                        + '<button type="button" title="Delete" class="btn btn-warning btn-circle" onclick="deleteRoad(this)"><i class="fa fa-times"></i></button>'
                        + '</td>'
                        + '</tr>';

                    $('#' + id + ' tbody').append($(td));
                }
            });
        } else {
            var td = '<tr class="no-data">' + '<td colspan="3">No data</td>' + '</tr>';

            $('#' + id + ' tbody').append($(td));
        }
    }
}

function deleteCategory(me, id) {
    if($(me).parent().parent()) {
        var cntTr = $('#shop-category tbody').find('tr');
        $(me).parent().parent().remove();
        if (cntTr.length == 1) {
            var td = '<tr class="no-data">' + '<td colspan="3">No data</td>' + '</tr>';

            $('#shop-category tbody').append($(td));
        }
    }
}

function deleteRoad(me, id) {
    if($(me).parent().parent()) {
        var cntTr = $('#shop-road tbody').find('tr');
        $(me).parent().parent().remove();
        if (cntTr.length == 1) {
            var td = '<tr class="no-data">' + '<td colspan="3">No data</td>' + '</tr>';

            $('#shop-road tbody').append($(td));
        }
    }
}