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
        var product_ids_arr = [];
        $('input:checkbox[name=cart_item]').each(function(index, el) {
            if($(this).attr('checked') == 'checked') {
                product_ids_arr.push($(this).attr('id'));
            }
        });

        if(product_ids_arr.length == 0) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('请选择提交项');
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
            return;
        }

        location.href = '/orderCommit?productIds=' + product_ids_arr;
    }

    // 删除
    var _onDelete = function () {
        var product_ids_arr = [];
        $('input:checkbox[name=cart_item]').each(function(index, el) {
            if($(this).attr('checked') == 'checked') {
                product_ids_arr.push($(this).attr('id'));
            }
        });

        if(product_ids_arr.length == 0) {
            $('.bk_toptips').show();
            $('.bk_toptips span').html('请选择删除项');
            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
            return;
        }

        $.ajax({
            type: "GET",
            url: '/cart/destory',
            dataType: 'json',
            cache: false,
            data: {productIds: product_ids_arr+''},
            success: function(data) {
                if(data == null) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('服务端错误');
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    return;
                }
                if(data.status != 0) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html(data.message);
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    return;
                }

                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }
    return {
        switchCheck : switchCheck,
        toCharge : _toCharge,
        onDelete : _onDelete
    };
}();
