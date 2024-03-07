@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')


@component('admin::components.modal',['id'=>'addRole','title'=>'添加角色','url'=>route('admin.role.store')])
<div class="row mb-3">
    <label for="name" class="col-sm-3 col-form-label text-sm-end">角色名称</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="name" name="name" value="" data-fv-field="name" autocomplete="off" value="{{old('name')}}">
        <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
            data-fv-result="NOT_VALIDATED" id="error-name"></div>
    </div>
</div>
<div class="row mb-3">
    <label for="name" class="col-sm-3 col-form-label text-sm-end">角色标识</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="cname" name="ename" value="" data-fv-field="ename"
            autocomplete="off" value="old('ename')">
        <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
            data-fv-result="NOT_VALIDATED" id="error-ename"></div>
    </div>
</div>
@endcomponent




<div class="card border-0 shadow-sm">
    <div class="card-header bg-body py-3">
      <form class="row row-cols-sm-auto g-3 align-items-center" action="#">
        <div class="col-12">
          <div class="row">
            <label for="name" class="col-sm-auto col-form-label">角色名称</label>
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
        <button class="btn btn-light add-btn" data-bs-toggle="modal" data-bs-target="#addRole"><i
          class="bi bi-plus"></i> 新增
        </button>
        <button class="btn btn-light batch-btn" disabled><i class="bi bi-trash"></i> 批量删除</button>
        <button class="btn btn-light"><i class="bi bi-box-arrow-down"></i> 导入</button>
        <button class="btn btn-light"><i class="bi bi-box-arrow-up"></i> 导出</button>
      </div>






<table id="table" class="table table-bordered table-hover">
    <thead class="">
        <tr>
            <!-- <th class="bs-checkbox " style="width: 36px; " data-field="0"> -->
                <!-- <div class="th-inner "><label><input name="btSelectAll" type="checkbox" -->
                            <!-- autocomplete="off"><span></span></label></div> -->
                <!-- <div class="fht-cell"></div> -->
            <!-- </th> -->
            <th data-field="id" class="col-sm-1">
                <div class="th-inner sortable sortable-center both">ID</div>
                <div class="fht-cell"></div>
            </th>
            <th data-field="name" class="col-sm-1">
                <div class="th-inner ">角色名称</div>
                <div class="fht-cell"></div>
            </th>
            <th data-field="name" class="col-sm-1 text-left">
                <div class="th-inner ">角色描述</div>
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
        @foreach($roles as $role)
        <tr>
            <td class="">{{$role->id}}</td>
            <td class="">{{$role->name}}</td>
            <td class="">{{$role->cname}}</td>
            <td class="">{{$role->created_at}}</td>
            <td class="" style="text-align: center; ">
                <button type="button" class="btn btn-success btn-sm edit-btn" data-bs-placement="top " data-bs-title="修改角色" data-bs-toggle="modal" data-bs-target="#edit_role_{{$role->id}}">
                    <i class="bi bi-pencil"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm del-btn mx-1" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="删除">
                    <i class="bi bi-trash3"></i>
                </button>

                <a href="{{route('admin.role.permission',$role)}}" type="button" class="btn btn-primary btn-sm node-btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="分配节点">
                    <i class="bi bi-diagram-2"></i>
                </a>
            </td>
            @component('admin::components.modal',['id'=>'edit_role_'.$role->id,'title'=>'编辑角色','url'=>route('admin.role.update',$role->id)])
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label text-sm-end">角色名称</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" data-fv-field="name" autocomplete="off" value="{{$role->name}}">
                    <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
                        data-fv-result="NOT_VALIDATED" id="error-name"></div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label text-sm-end">角色标识</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="cname" name="ename" data-fv-field="ename"
                        autocomplete="off" value="{{$role->cname}}">
                    <div class="invalid-feedback d-none" data-fv-validator="notEmpty" data-fv-for="name"
                        data-fv-result="NOT_VALIDATED" id="error-ename"></div>
                </div>
            </div>
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


<script src="/lib/@popperjs/core/dist/umd/popper.min.js"></script>
<!--假数据模拟,生产环境中请直接删除该js-->







@endsection


