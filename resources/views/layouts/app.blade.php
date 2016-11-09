<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/weui.css')}}">
    <link rel="stylesheet" href="{{asset('/css/book.css')}}">
    </head>
  <body>
  <div class="bk_title_bar">
      <img class="bk_back" src="{{asset('/images/back.png')}}" alt="" onclick="history.go(-1);">
      <p class="bk_title_content"></p>
      <img class="bk_menu" src="{{asset('/images/menu.png')}}" alt="" onclick="onMenuClick();">
  </div>

  <div class="page">
      @yield('content')
  </div>

  <!-- tooltips -->
  <div class="bk_toptips"><span></span></div>

  <!--BEGIN actionSheet-->
  <div id="actionSheet_wrap">
      <div class="weui_mask_transition" id="mask"></div>
      <div class="weui_actionsheet" id="weui_actionsheet">
          <div class="weui_actionsheet_menu">
              <div class="weui_actionsheet_cell" onclick="onMenuItemClick(1)">用户中心</div>
              <div class="weui_actionsheet_cell" onclick="onMenuItemClick(2)">选择套餐</div>
              <div class="weui_actionsheet_cell" onclick="onMenuItemClick(3)">周边油站</div>
              <div class="weui_actionsheet_cell" onclick="onMenuItemClick(4)">常见问题</div>
          </div>
          <div class="weui_actionsheet_action">
              <div class="weui_actionsheet_cell" id="actionsheet_cancel">取消</div>
          </div>
      </div>
  </div>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/book.js')}}"></script>
  @yield('js')
  </body>
</html>
