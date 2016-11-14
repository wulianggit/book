var Cart = function () {
    var switchCheck = function () {
        $('input:checkbox[name=cart_item]').click(function(event) {
            var checked = $(this).attr('checked');
            if(checked == 'checked') {
                $(this).attr('checked', false);
                $(this).next().removeClass('weui_icon_checked');
                $(this).next().addClass('weui_icon_unchecked');
            } else {
                $(this).attr('checked', 'checked');
                $(this).next().removeClass('weui_icon_unchecked');
                $(this).next().addClass('weui_icon_checked');
            }
        });
    }

    // 结算
    var _toCharge = function () {

    }

    // 删除
    var _onDelete = function () {
        
    }
    return {
        switchCheck : switchCheck,
        toCharge : _toCharge,
        onDelete : _onDelete
    };
}();
