@extends('layouts.app')

@section('title', '书籍分类')

@section('content')
    <div class="weui_cells_title">选择书籍类别</div>
    <div class="weui_cells weui_cells_split">
        <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="category">
                    <option value="1">PHP</option>
                    <option value="2">javascript</option>
                    <option value="3">Java</option>
                </select>
            </div>

        </div>
    </div>

    <div class="weui_cells weui_cells_access">
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_bd weui_cell_primary">
                <p>cell standard</p>
            </div>
            <div class="weui_cell_ft">说明文字</div>
        </a>
        <a class="weui_cell" href="javascript:;">
            <div class="weui_cell_bd weui_cell_primary">
                <p>cell standard</p>
            </div>
            <div class="weui_cell_ft">说明文字</div>
        </a>
    </div>
@endsection

@section('js')
    <script type="text/javascript">

        _getCategory();

        $('.weui_select').change(function(event) {
            _getCategory()
        });

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
    </script>
@endsection
