@extends('layouts.default')
@section ('content')
<div class="card">
    <div class="card-header">用户列表</div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="col-1">编号</th>
                    <th scope="col">用户名</th>
                    <th scope="col">用户昵称</th>
                    <th scope="col" class="col-2">操作</th>

                </tr>
            </thead>
            <tbody>
                @foreach($user_list as $user)
                <tr>
                    <td scope="row">{{$user->id}}</td>
                    <td scope="row">{{$user->username}}</td>
                    <td scope="row">{{$user->nickname}}</td>
                    <td scope="row">
                        <form action="{{route('user.destroy',$user)}}" method="post" id="delete-user-{{$user->id}}" class="m-0">
                            @csrf
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger btn-sm ms-2">删除</button> -->
                        </form>
                        <div class="btn-group w-100" role="group" aria-label="option button a">
                            <a href="{{route('user.show',$user)}}" class="btn btn-primary btn-sm ">查看</a>
                            @can('update',$user)
                            <a href="{{route('user.edit',$user)}}" class="btn btn-info btn-sm ">修改</a>
                            @endcan
                            @cannot('update',$user)
                            <a href="#" class="btn btn-secondary btn-sm disabled">修改</a>
                            @endcan
                            @can('delete',$user)
                            <a href="#" onclick="document.getElementById('delete-user-{{$user->id}}').submit()" class="btn btn-danger btn-sm ">删除</a>
                            @endcan
                            <!-- <a href="{{route('user.destroy',$user)}}" class="btn btn-danger btn-sm">删除</a> -->
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        {{$user_list->links()}}
    </div>
</div>
@endsection
