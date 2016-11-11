@extends('layouts.app')

@section('title', $product->name)

@section('content')
    {{--banale图--}}
    <div class="page bk_content" style="top: 0;">
        <div class="addWrap">
            <div class="swipe" id="mySwipe">
                <div class="swipe-wrap">
                    @foreach($pdtImages as $pdtImage)
                        <div>
                            <a href="javascript:;">
                                <img src="{{asset($pdtImage->img_path)}}" class="img-responsive">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <ul id="position">
                @foreach($pdtImages as $index => $pdtImages)
                    <li class={{$index == 0 ? 'cur' : ''}}></li>
                @endforeach
            </ul>
        </div>

        <div class="weui_cells_title">
            <span class="bk_title">{{$product->name}}</span>
            <span class="bk_price" style="float: right">￥ {{$product->price}}</span>
        </div>
        <div class="weui_cells">
            <div class="weui_cell">
                <p class="bk_summary">{{$product->introduce}}</p>
            </div>
        </div>

        <div class="weui_cells_title">详细介绍</div>
        <div class="weui_cells">
            <div class="weui_cell">
                @if($pdtContent != null)
                    {!! $pdtContent->content !!}
                @else
                    暂无内容
                @endif
            </div>
        </div>
    </div>

    <div class="bk_fix_bottom">
        <div class="bk_half_area">
            <input type="hidden" value="{{csrf_token()}}" id="token">
            <button class="weui_btn weui_btn_primary" onclick="Product.addCart({{$product->id}});">加入购物车</button>
        </div>
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_default" onclick="Product.toCart();">查看购物车(<span id="cart_num" class="m3_price"></span>)</button>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/js/swipe.min.js')}}"></script>
    <script src="{{asset('/js/product.js')}}"></script>
    <script type="application/javascript">
        // 轮播图
        Product.initBlande();
    </script>
@endsection

