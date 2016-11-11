var Product = function () {
    // 轮播图
    var InitBlande = function () {
        var bullets = document.getElementById('position').getElementsByTagName('li');
        Swipe(document.getElementById('mySwipe'), {
            auto: 2000,
            continuous: true,
            disableScroll: false,
            callback: function(pos) {
                var i = bullets.length;
                while (i--) {
                    bullets[i].className = '';
                }
                bullets[pos].className = 'cur';
            }
        });
    }

    // 加入购物车
    var _addCart = function (product_id) {
        var _token = $('#token').val();
        $.ajax({
            type: "POST",
            url: '/cart',
            data:{productId:product_id,_token:_token},
            dataType: 'json',
            cache: false,
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

                var num = $('#cart_num').html();
                if(num == '') num = 0;
                $('#cart_num').html(Number(num) + 1);

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }

    // 查看购物车
    var _toCart = function () {
        location.href = '/cart';
    }
    return {
        initBlande : InitBlande,
        addCart : _addCart,
        toCart  : _toCart
    }
}();
