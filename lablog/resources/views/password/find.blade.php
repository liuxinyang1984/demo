@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">找回密码</div>
    <form action="{{route('password.sendEmail')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                <small id="helpId" class="form-text text-muted">请输入注册时的Email</small>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success" id="btn_regist">找回</button>
        </div>
    </form>
</div>
@endsection
