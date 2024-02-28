@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">用户登陆</div>
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success" id="btn_regist">登陆</button>
        </div>
    </form>
</div>
<div class="mt-2">
    <p>忘记密码,请<a href="{{route('password.find')}}">点击找加密</a></p>
</div>
@endsection

@section('js')
@endsection
