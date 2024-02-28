@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        {{$user->username}}{{$title}}
    </div>
    <div class="card-body">
        @if($users->count() ==0)
        <p>没有数据</p>
        @endif
        <ul class="list-group list-group-numbered">
            @foreach($users as $follow)
            <li class="list-group-item"><a href="{{route('user.show',$follow)}}">{{$follow->username}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="card-footer text-mutted">
        {{$users->links()}}
    </div>
</div>
@endsection
