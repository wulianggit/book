@extends('layouts.app')

@section('title', '书籍分类')

@section('content')
    <div class="weui_cells_title">选择书籍类别</div>
    <div class="weui_cells weui_cells_split">
        <div class="weui_cell weui_cell_select">
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="category">
                    @foreach($categorys as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
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
    <script src="{{asset('/js/category.js')}}"></script>
    <script type="text/javascript">
        Category.initCategory();
    </script>
@endsection
