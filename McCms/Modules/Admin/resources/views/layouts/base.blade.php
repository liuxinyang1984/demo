<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="icon" href="/dist/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/dist/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="keywords" content="响应式后台模板,开源免费后台模板,Bootstrap5后台管理系统模板">
    <meta name="description" content="bootstrap-admin基于bootstrap5的免费开源的响应式后台管理模板">
    <meta name="author" content="ajiho">
    <link rel="stylesheet" href="/lib/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dist/css/bootstrap-admin.min.css">

    <script src="/lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/dist/js/bootstrap-admin.min.js"></script>
    <script src="/dist/js/app.js"></script>

    @yield('head')

    <title>{{config('app.name')}}</title>
</head>
<body class="bg-body-tertiary py-3">
<div class="container-fluid">
    @include('admin::layouts._error')
    @yield('container')
</div>

@yield('more')

@include('admin::layouts._toast')

<script>
    @yield('js')
</script>
</body>
</html>
