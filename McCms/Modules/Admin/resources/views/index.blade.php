<!doctype html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="icon" href="/dist/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/dist/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="keywords" content="响应式后台模板,开源免费后台模板,bootstrap5后台管理系统模板">
    <meta name="description" content="bootstrap-admin基于bootstrap5的免费开源的响应式后台管理模板">
    <meta name="author" content="ajiho">


    <link rel="stylesheet" href="/lib/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/overlayscrollbars/styles/overlayscrollbars.min.css">
    <link rel="stylesheet" href="/dist/css/bootstrap-admin.min.css">



    <title>{{config('app.name')}}</title>


    <!-- Vite -->
</head>

<body data-theme="light">

@include('admin::layouts._header')
@include('admin::layouts._sidebar')


<!--内容区域(用于tab选项卡插件)-->
<div class="bsa-content">
  <div class="qtab" data-qt-tabs='[{"title":"首页","url":"{{route('admin.home')}}","close":false}]'></div>
</div>

<!--版权信息-->
<div class="bsa-footer">
  <p class="mb-0">Copyright © 2023. All right reserved.</p>
</div>

<!--加载层-->
<div class="bsa-preloader">
  <div class="spinner-border text-secondary" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>


<script src="/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


<!--js插件引入位置,放这里是bootstrap-admin.min.js文件中可能包含插件的引用-->

<script src="/lib/jquery/dist/jquery.min.js"></script>
<script src="/lib/overlayscrollbars/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="/lib/bootstrap-quicktab/dist/js/bootstrap-quicktab.min.js"></script>


<!-- bootstrap-admin.js要放最后,不然后出错 -->
<script src="/dist/js/bootstrap-admin.min.js"></script>

<!-- 自定义js,考虑可以用vite来处理 -->
{{-- <script src="/dist/js/app.js"></script> --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])



<script>
  $(function () {

    //头部搜索框处理(不需要可以删除,不明白的可以看bootstrap-admin官方文档)
    $(document).on('search.bsa.navbar-search', function (e, inputValue, data) {
      //先得到请求地址,组合后大概是这样pages/search.html?keyword=dsadsa&type=article&user=admin2
      let url = data.action + '?keyword=' + inputValue + '&' + $.param(data.params);

      //然后通过tab打开一个搜索结果的窗口
      Quicktab.get('.qtab').addTab({
        title: '<i class="bi bi-search"></i><span class="text-danger ms-2">' + inputValue + '</span>',
        url: url,
        close: true,
      })
    })

    //退出登录
    $(document).on('click', '.bsa-logout', function (e) {
      e.preventDefault();

      $.modal({
        body: '确定要退出吗？',
        cancelBtn: true,
        ok: function () {
          top.location.replace('/admin/logout')
        }
      })


    });
  });
</script>

</body>
</html>
