
<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="icon" href="../dist/img/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="../dist/img/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="keywords" content="响应式后台模板,开源免费后台模板,Bootstrap5后台管理系统模板">
    <meta name="description" content="bootstrap-admin基于bootstrap5的免费开源的响应式后台管理模板">
    <meta name="author" content="ajiho">
    <link rel="stylesheet" href="../lib/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dist/css/bootstrap-admin.min.css">
    <title>{{config('app.name')}} - 后台登陆</title>
</head>
<body>


<div class="min-vh-100  p-2 bg-body-tertiary d-flex flex-column align-items-center justify-content-center">
    <h2>{{config('app.name')}}</h2>
    <p class="text-secondary">{{config('app.name')}}</p>
    <form action="{{route('admin.login')}}" id="form" class="form" style="width: 380px;max-width: 100%" method="post">
        @csrf
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text bg-white "><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" placeholder="请输入用户" name="username"
                       id="username" aria-label="username" value="admin">

            </div>
            <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="username" data-fv-result="INVALID" style="display: block;" id="error_username"></div>
        </div>

        <div class="mb-3">
            <div class="input-group bsa-show_hide_password">
                <span class="input-group-text bg-white"><i class="bi bi-person-lock"></i></span>
                <input type="password"
                    class="form-control"
                    placeholder="请输入密码"
                    name="password"
                    autocomplete="off"
                    id="password" aria-label="password"
                    value="123456"
                >
                <span class="input-group-text bg-white bsa-cursor-pointer"><i class="bi bi-eye-slash"></i></span>
            </div>

            <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="username" data-fv-result="INVALID" style="display: block;" id="error_password"></div>
        </div>

        <!-- <div class="mb-3"> -->
            <!-- <div class="input-group"> -->
                <!-- <span class="input-group-text bg-white"><i class="bi bi-shield-lock"></i></span> -->
                <!-- <input type="text" class="form-control" id="captcha" name="captcha" aria-label="captcha" -->
                       <!-- placeholder="请输入验证码" style="min-width: 80px"> -->
                <!-- <img src="../dist/img/captcha.gif" alt="验证码" -->
                     <!-- class="bsa-cursor-pointer" style="height: 38px;width: 120px"/> -->
            <!-- </div> -->
        <!-- </div> -->

        <div class="mb-3 d-flex align-items-center justify-content-between flex-wrap gap-3 ">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember"
                       value="1">
                <label class="form-check-label" for="exampleCheck1">十天内免登录</label>
            </div>
            <a href="javascript:" class="link-success text-decoration-none">忘记密码?</a>
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-outline-success" type="submit"><i class="bi bi-box-arrow-in-right"></i> 登入</button>
        </div>
    </form>
</div>


<script src="../lib/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/jquery/dist/jquery.min.js"></script>
<script src="../lib/formvalidation/js/formValidation.js"></script>
<script src="../lib/formvalidation/js/framework/bootstrap.js"></script>
<script src="../lib/formvalidation/js/language/zh_CN.js"></script>
<script src="../dist/js/bootstrap-admin.min.js"></script>
<script src="../dist/js/app.js"></script>

<!--假数据模拟,生产环境中请直接删除该js-->
<script src="../dist/js/bootstrap-admin.mock.js"></script>
<h1>Error</h1>
@if(count($errors))
    @foreach($errors->all() as $error)
        @if(strstr($error,'邮箱'))
            <script>
                $('#error_username').removeClass('d-none').append('{{$error}}')
            </script>
        @endif
        @if(strstr($error,'密码'))
            <script>
                $('#error_password').removeClass('d-none').append('{{$error}}')
            </script>
        @endif
    <script>
    </script>
        <h1>{{$error}}</h1>
    @endforeach
@endif
</body>
@include('admin::layouts._toast')
</html>
