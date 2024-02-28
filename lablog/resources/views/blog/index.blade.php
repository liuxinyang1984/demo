@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">文章列表</div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="col-1">编号</th>
                    <th scope="col" class="col-8">内容</th>
                    <th scope="col" class="col-1">作者</th>
                    <th scope="col" class="col-2">操作</th>

                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                <tr>
                    <td scope="row">{{$blog->id}}</td>
                    <td scope="row">{{$blog->content}}</td>
                    <td scope="row">{{$blog->user->username}}</td>
                    <td scope="row">
                        <form action="{{route('blog.destroy',$blog)}}" method="post" id="delete-blog-{{$blog->id}}" class="m-0">
                            @csrf
                            @method('DELETE')
                            <!-- <button type="submit" class="btn btn-danger btn-sm ms-2">删除</button> -->
                        </form>
                        <div class="btn-group w-100" role="group" aria-label="option button a">
                            <a href="{{route('blog.show',$blog)}}" class="btn btn-primary btn-sm ">查看</a>
                            @can('update',$blog)
                            <a href="{{route('blog.edit',$blog)}}" class="btn btn-info btn-sm ">修改</a>
                            @endcan
                            @cannot('update',$blog)
                            <a href="#" class="btn btn-secondary btn-sm disabled">修改</a>
                            @endcan
                            @can('delete',$blog)
                            <a href="#" onclick="document.getElementById('delete-blog-{{$blog->id}}').submit()" class="btn btn-danger btn-sm ">删除</a>
                            @endcan
                            <!-- <a href="{{route('user.destroy',$blog)}}" class="btn btn-danger btn-sm">删除</a> -->
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
                <li class="page-item"><a class="page-link" href="{{$blogs->previousPageUrl()}}">Previous</a></li>
                @if($blogs->total() < 8)
                    @for ($i=1;$i<$blogs->lastPage();$i++)
                        <li class="page-item"><a class="page-link" href="{{$blogs->url($i)}}">{{$i}}</a></li>
                    @endfor
                    @else
                    @foreach($blogs->getUrlRange(1,6) as $page => $url)
                    @if($blogs->currentPage() == $page)
                    <li class="page-item"><a class="page-link active" href="{{$url}}">{{$page}}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                    @endif
                    @endforeach
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                    @foreach($blogs->getUrlRange($blogs->lastPage()-1,$blogs->lastPage()) as $page => $url)
                    @if($blogs->currentPage() == $page)
                    <li class="page-item"><a class="page-link active" href="{{$url}}">{{$page}}</a></li>
                    @else
                    <li class="page-item"><a class="page-link" href="{{$url}}">{{$page}}</a></li>
                    @endif
                    @endforeach

                    @endif
                    <li class="page-item"><a class="page-link" href="{{$blogs->nextPageUrl()}}">Next</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection
