@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">重置密码</div>
    <form action="{{route('password.update')}}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{$user['id']}}">
        <div class="card-body">
            <div class="form-group">
                <label for="username">用户名</label>
                <input type="text" class="form-control" name="username" id="username" value="{{$user['username']}}" disabled>
            </div>
            <div class="form-group">
                <label for="email">用户名</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$user['email']}}" disabled>
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">确认密码</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success" id="btn_regist">重置</button>
        </div>
    </form>
</div>
@endsection
