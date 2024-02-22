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
                        <div class="btn-group" role="group" aria-label="option button a">
                            <a href="{{route('user.show',$user)}}" class="btn btn-primary btn-sm ">查看</a>
                            <a href="{{route('user.edit',$user)}}" class="btn btn-info btn-sm ">修改</a>
                            <form action="{{route('user.destroy',$user)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">删除</button>
                            </form>
                            <a href="{{route('user.edit',$user)}}" class="btn btn-info btn-sm ">修改</a>
                            <!-- <a href="{{route('user.destroy',$user)}}" class="btn btn-danger btn-sm">删除</a> -->
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        <nav aria-label="分页">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="{{$user_list->previousPageUrl()}}">Previous</a></li>
                @if($user_list->total() < 8) @for ($i=1;$i<$user_list->lastPage();$i++)
                    <li class="page-item"><a class="page-link" href="{{$users_list->url($i)}}">{{$i}}</a></li>
                    @endfor
                    @else
                    @foreach($user_list->getUrlRange(1,6) as $page => $url)
                    @if($user_list->currentPage() == $page)
                    <li class="page-item"><a class="page-link active" href="{{$url}}">{{$page}}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                    @endif
                    @endforeach
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    @foreach($user_list->getUrlRange($user_list->lastPage()-1,$user_list->lastPage()) as $page => $url)
                    @if($user_list->currentPage() == $page)
                    <li class="page-item"><a class="page-link active" href="{{$url}}">{{$page}}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                    @endif
                    @endforeach

                    @endif
                    <li class="page-item"><a class="page-link" href="{{$user_list->nextPageUrl()}}">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
