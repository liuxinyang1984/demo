<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.7.1/jquery.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <!-- @vite(['resources/css/app.css']) -->
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">测试文库</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{route('user.index')}}">用户列表</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        @auth
                        <a href={{route('user.edit',auth()->user())}} class="btn btn-info me-2">修改</a>
                        <a href={{route('logout')}} class="btn btn-danger">退出登陆</a>
                        @else
                            <a href={{route('login')}} class="btn btn-primary m-2">登陆</a>
                            <a href={{route('user.create')}} class="btn btn-success m-2">注册</a>
                        @endauth
                    </form>
                </div>
            </div>
        </nav>

        <div class="content mt-2">
            @include('layouts._errors')
            @include('layouts._message')
            @yield('content')
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        console.log('Jquery')
        @yield('jquery')

    })
</script>
<style>
@yield('style')
</style>
@yield('js')

</html>
