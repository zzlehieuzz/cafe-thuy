$(function () {
    $('.popup-return-category').on('click', function () {
        if($('.return-data').length > 0) {
            var data = [];
            var rootCategoryId   = $('#root_category_id').val(),
                rootCategoryText = $("#root_category_id option:selected").text();

            $('.return-data:checked').map(function() {
                data.push({
                    'id': $(this).attr("value"),
                    'name': $(this).attr("catname"),
                    'root_category_id': rootCategoryId,
                    'root_category_name': rootCategoryText
                });
            }).get();

            returnYourChoice(data);
        }
    });

    $('.popup-return-road').on('click', function () {
        if($('.return-data').length > 0) {
            var data = [];
            var rootRoadId   = $('#root_road_id').val(),
                rootToadText = $("#root_road_id option:selected").text();

            $('.return-data:checked').map(function() {
                data.push({
                    'id': $(this).attr("value"),
                    'name': $(this).attr("catname"),
                    'root_road_id': rootRoadId,
                    'root_road_name': rootToadText
                });
            }).get();

            returnYourChoice(data);
        }
    });
});

function returnYourChoice(data){
    if (data.length > 0) {
        var params  = opener.popup.params,
            targets = opener.popup.targets,
            func    = opener.popup.func;

        if (func) {
            eval("window.opener."+func);
        }

        if (params) {}

        if (targets) {}
    }

    window.close();
}