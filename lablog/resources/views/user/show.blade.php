@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <b>{{$user['username']}}资料</b>
        <small>
            粉丝: <a href="{{route('user.follower',$user)}}">{{$user->follower()->count()}}</a> &emsp;关注: <a href="{{route('user.following',$user)}}">{{$user->following->count()}}</a>
        </small>
        <div class="float-end">
            @auth
            &nbsp;<a href="{{route('user.follow',$user)}}">[{{$is_follow}}]</a>
            @endauth
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="col-1">编号</th>
                    <th scope="col" class="">内容</th>
                    <th scope="col" class="col-2">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td scope="row">{{$blog['id']}}</td>
                    <td scope="row">{{$blog['content']}}</td>
                    <td scope="row">
                        <form action="{{route('blog.destroy',$blog)}}" method="post" id="delete-blog-{{$blog->id}}" class="m-0">
                            @csrf
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger btn-sm ms-2">删除</button> -->
                        </form>
                        <div class="btn-group w-100" role="group" aria-label="option button a">
                            @can('update',$blog)
                            <a href="{{route('blog.edit',$blog)}}" class="btn btn-info btn-sm ">修改</a>
                            @endcan
                            @cannot('update',$blog)
                            <a href="#" class="btn btn-secondary btn-sm disabled">修改</a>
                            @endcan
                            @can('delete',$blog)
                            <a href="#" onclick="document.getElementById('delete-blog-{{$blog->id}}').submit()" class="btn btn-danger btn-sm ">删除</a>
                            @endcan
                            @cannot('delete',$blog)
                            <a href="#" class="btn btn-danger btn-sm disabled">删除</a>
                            @endcannot
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <card-foot class="text-muted"></card-foot>
</div>
@endsection
