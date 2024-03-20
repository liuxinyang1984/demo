
@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')


@component('admin::components.modal',['id'=>'addCate','title'=>'编写文章','url'=>route('article.category.store')])
<div class="row mb-3">
    <label for="title" class="col-sm-3 col-form-label text-sm-end">新建文章</label>
    <div class="col-sm-9 " id="editor">
        <textarea style="display:none;" name="content">### Hello Editor.md !</textarea>
    </div>
</div>
@endcomponent




<div class="card border-0 shadow-sm">
    <div class="card-header bg-body py-3">
      <form class="row row-cols-sm-auto g-3 align-items-center" action="#">
        <div class="col-12">
          <div class="row">
            <label for="name" class="col-sm-auto col-form-label">文章名称</label>
            <div class="col">
              <input type="text" class="form-control" id="name" name="name">
            </div>
          </div>
        </div>

        <div class="col-12 gap-2">

          <button type="button" class="btn btn-light bsa-querySearch-btn">
            <i class="bi bi-search"></i>搜索
          </button>
          <button type="button" class="btn btn-light bsa-reset-btn">
            <i class="bi bi-arrow-clockwise"></i>重置
          </button>
        </div>

      </form>
    </div>

    <div class="card-body">
        <div id="toolbar" class="d-flex flex-wrap gap-2 mb-2">
            <a href="{{route('article.post.create')}}" class="btn btn-light add-btn">
                <i class="bi bi-plus"></i> 新增
            </a>
            <button class="btn btn-light batch-btn" disabled><i class="bi bi-trash"></i> 批量删除</button>
            <button class="btn btn-light"><i class="bi bi-box-arrow-down"></i> 导入</button>
            <button class="btn btn-light"><i class="bi bi-box-arrow-up"></i> 导出</button>
        </div>
        <table id="table" class="table table-bordered table-hover">
            <thead class="">
                <tr>
                    <th data-field="id" class="col-sm-1">
                        <div class="th-inner sortable sortable-center both">ID</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="name" class="col-sm-1">
                        <div class="th-inner ">文章名称</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="name" class="col-sm-1 text-left">
                        <div class="th-inner ">文章分类</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="create_at" class="col-sm-8">
                        <div class="th-inner ">创建时间</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="4" class="col-1">
                        <div class="th-inner ">操作</div>
                        <div class="fht-cell"></div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td class="">{{$post->id}}</td>
                    <td class="">{{$post->title}}</td>
                    <td class="">{{$cate[$post->cate_id]}}</td>
                    <td class="">{{$post->created_at}}</td>
                    <td class="" style="text-align: center; ">
                        <a href="{{route('article.post.edit',$post->id)}}" class="btn btn-success btn-sm edit-btn"><i class="bi bi-pencil"></i></a>



                        <button type="button" class="btn btn-danger btn-sm edit-btn" data-bs-placement="top " data-bs-title="删除角色"
                            data-bs-toggle="modal" data-bs-target="#del_post_{{$post->id}}">
                            <i class="bi bi-trash3"></i>
                        </button>


                    </td>
                    @component('admin::components.modal',['id'=>'del_post_'.$post->id,'title'=>'删除分类','url'=>route('article.post.destroy',$post->id),'method'=>'DELETE'])
                    <p>确定要删除角色《{{$post->title}}》吗?</p>
                    @endcomponent
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection

<!-- 主体以下 -->
@section('more')

@if(count($errors))
    @foreach($errors->all() as $error)
        @if(strstr($error,'邮箱'))
            <script>
                $('#error_username').removeClass('d-none').append('{{$error}}')
            </script>
        @endif
        @if(strstr($error,'密码'))
            <script>
                $('#error_password').removeClass('d-none').append('{{$error}}')
            </script>
        @endif
    <script>
    </script>
        <h1>{{$error}}</h1>
    @endforeach
@endif

@endsection


