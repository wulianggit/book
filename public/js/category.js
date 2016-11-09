var Category = function() {
    var initCategory = function () {
            _getCategory();

            $('.weui_select').change(function(event) {
                _getCategory()
            });
    }

    function _getCategory() {
        var parent_id = $('.weui_select option:selected').val();
        $.ajax({
            type: "GET",
            url: '/category/pid/' + parent_id,
            dataType: 'json',
            cache: false,
            success: function(res) {
                //console.log("获取类别数据:");
                //console.log(data);
                if(res == null) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html('服务端错误');
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    return;
                }
                if(res.status != 0) {
                    $('.bk_toptips').show();
                    $('.bk_toptips span').html(res.message);
                    setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                    return;
                }
                $('.weui_cells_access').html('');
                for(var i=0; i<res.data.length; i++) {
                    var next = '/product/cid/' + res.data[i].id;
                    var node = '<a class="weui_cell" href="' + next + '">' +
                        '<div class="weui_cell_bd weui_cell_primary">' +
                        '<p>'+ res.data[i].name +'</p>' +
                        '</div>' +
                        '<div class="weui_cell_ft"></div>' +
                        '</a>';
                    $('.weui_cells_access').append(node);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    }
    return {
        initCategory: initCategory
    }
}();
