@extends('layouts.app')
@section('title', '购物车')
@section('content')
    <div class="page bk_content" style="top: 0;">
        <div class="weui_cells weui_cells_checkbox">
            @foreach($cartItems as $cartItem)
                <label class="weui_cell weui_check_label" for="{{$cartItem['product']['id']}}">
                    <div class="weui_cell_hd" style="width: 23px;">
                        <input type="checkbox" class="weui_check" name="cart_item" id="{{$cartItem['product']['id']}}" checked="checked">
                        <i class="weui_icon_checked"></i>
                    </div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <div style="position: relative;">
                            <img class="bk_preview" src="{{$cartItem['product']['preview']}}" class="m3_preview" onclick="_toProduct({{$cartItem['product']['id']}});"/>
                            <div style="position: absolute; left: 100px; right: 0; top: 0">
                                <p>{{$cartItem['product']['name']}}</p>
                                <p class="bk_time" style="margin-top: 15px;">数量: <span class="bk_summary">x{{$cartItem['count']}}</span></p>
                                <p class="bk_time">总计: <span class="bk_price">￥{{$cartItem['product']['price'] * $cartItem['count']}}</span></p>
                            </div>
                        </div>
                    </div>
                </label>
            @endforeach
        </div>
    </div>
    <div class="bk_fix_bottom">
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_primary" onclick="Cart.toCharge();">结算</button>
        </div>
        <div class="bk_half_area">
            <button class="weui_btn weui_btn_default" onclick="Cart.onDelete();">删除</button>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('/js/cart.js')}}"></script>
    <script>
        Cart.switchCheck();
    </script>
@endsection
