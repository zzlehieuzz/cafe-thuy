$(function () {
    $('.popup-return-category').on('click', function () {
        if($('.return-data').length > 0) {
            var data = [];

            $('.return-data:checked').map(function() {
                data.push({
                    'id': $(this).attr("value"),
                    'categoryName': $(this).attr("categoryName")
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