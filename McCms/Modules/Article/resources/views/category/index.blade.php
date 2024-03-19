@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')


@component('admin::components.modal',['id'=>'addCate','title'=>'添加分类','url'=>route('article.category.store')])
<div class="row mb-3">
    <label for="name" class="col-sm-3 col-form-label text-sm-end">分类名称</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="" data-fv-field="name" autocomplete="off" value="{{old('name')}}">
        <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
            data-fv-result="NOT_VALIDATED" id="error-name"></div>
    </div>
</div>
<div class="row mb-3">
    <label for="name" class="col-sm-3 col-form-label text-sm-end">父级分类</label>
    <div class="col-sm-9">
        <select aria-label="pid" class="form-control select2-hidden-accessible" id="pid" name="pid" tabindex="-1"
            aria-hidden="true">
            <option value="0" selected>顶级</option>
            @foreach($tree as $selectCateId => $selectCate)
            <option value="{{$selectCateId}}">{{$selectCate['name']}}</option>
            @endforeach
        </select>
    </div>
</div>
@endcomponent




<div class="card border-0 shadow-sm">
    <div class="card-header bg-body py-3">
      <form class="row row-cols-sm-auto g-3 align-items-center" action="#">
        <div class="col-12">
          <div class="row">
            <label for="name" class="col-sm-auto col-form-label">分类名称</label>
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
            <button class="btn btn-light add-btn" data-bs-toggle="modal" data-bs-target="#addCate"><i
                    class="bi bi-plus"></i> 新增
            </button>
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
                        <div class="th-inner ">分类名称</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="name" class="col-sm-1 text-left">
                        <div class="th-inner ">父级分类</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="create_at" class="col-sm-8">
                        <div class="th-inner ">加入时间</div>
                        <div class="fht-cell"></div>
                    </th>
                    <th data-field="4" class="col-1">
                        <div class="th-inner ">操作</div>
                        <div class="fht-cell"></div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cate)
                <tr>
                    <td class="">{{$cate->id}}</td>
                    <td class="">{{$cate->name}}</td>
                    <td class="">{{$cate->pid}}</td>
                    <td class="">{{$cate->created_at}}</td>
                    <td class="" style="text-align: center; ">
                        <button type="button" class="btn btn-success btn-sm edit-btn" data-bs-placement="top " data-bs-title="修改角色"
                            data-bs-toggle="modal" data-bs-target="#edit_cate_{{$cate->id}}">
                            <i class="bi bi-pencil"></i>
                        </button>



                        <button type="button" class="btn btn-danger btn-sm edit-btn" data-bs-placement="top " data-bs-title="删除角色"
                            data-bs-toggle="modal" data-bs-target="#del_cate_{{$cate->id}}">
                            <i class="bi bi-trash3"></i>
                        </button>


                    </td>
                    @component('admin::components.modal',['id'=>'edit_cate_'.$cate->id,'title'=>'编辑分类','url'=>route('article.category.update',$cate->id),'method'=>'PUT'])
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label text-sm-end">分类名称</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" data-fv-field="name"
                                autocomplete="off" value="{{$cate->name}}">
                            <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
                                data-fv-result="NOT_VALIDATED" id="error-name"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label text-sm-end">父级分类</label>
                        <div class="col-sm-9">
                            <select aria-label="pid" class="form-control select2-hidden-accessible" id="pid" name="pid"
                                tabindex="-1" aria-hidden="true">
                                <option value="0" selected>顶级</option>
                                @foreach($tree as $selectCateId => $selectCate)
                                    @if($cate->pid == $selectCateId)
                                    <option value="{{$selectCateId}}" selected>{{$selectCate['name']}}</option>
                                    @elseif($cate->id == $selectCateId)
                                    <option value="{{$selectCateId}}" disabled>{{$selectCate['name']}}</option>
                                    @else
                                    <option value="{{$selectCateId}}">{{$selectCate['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endcomponent
                    @component('admin::components.modal',['id'=>'del_cate_'.$cate->id,'title'=>'删除分类','url'=>route('article.category.destroy',$cate->id),'method'=>'DELETE'])
                    <p>确定要删除角色{{$cate->name}}吗?</p>
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


