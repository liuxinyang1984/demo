@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        {{$user->username}}观注列表
    </div>
    <div class="card-body">
        @if($followings->count() == 0)
        <p>没有数据</p>
        @endif
        <ul class="list-group">
            @foreach($followings as $follow)
            <li class="list-group-item"><a href="{{route('user.show',$follow)}}">{{$follow->username}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer text-mutted">
        {{$followings->links()}}
    </div>
</div>
@endsection
