@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">用户编辑</div>
    <form action="{{route('user.update',$user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="nickname">昵称</label>
                <input type="text" class="form-control" name="nickname" id="nickname" value="{{$user['nickname']}}">
            </div>
            <div class="form-group">
                <label for="email">eMail</label>
                <input type="text" class="form-control" name="email" id="email" value="{{$user['email']}}">
            </div>
            <div class="form-group">
                <label for="mobile">电话</label>
                <input type="text" class="form-control" name="mobile" id="mobile" value="{{$user['mobile']}}">
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
            <button type="submit" class="btn btn-success" id="btn_regist">修改</button>
        </div>
    </form>
</div>
@endsection
