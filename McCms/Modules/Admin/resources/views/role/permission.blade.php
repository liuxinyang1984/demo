@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')
<div class="card border-0 shadow-sm">
    <form action="{{route('admin.role.permission.update',$role)}}" method="post">
    @csrf
    @method('PUT')
    <div class="card-header bg-body">
        {{$role->cname}}[{{$role->name}}]权限编辑
    </div>
    <div class="card-body">
    @foreach($permissions as $permission)
        @if($permission->pid == 0)
        <p>{{$permission->cname}}</p>
        <div class="input-group mb-3 pl-5">
            @foreach($permissions as $subPermission)
                @if($subPermission->pid == $permission->id)
                <div class="form-check form-switch m-3">
                    <input class="form-check-input"
                        type="checkbox"
                        id="switch-{{$subPermission->id}}"
                        value="{{$subPermission->name}}"
                        name="permission[]"
                        {{$role->hasPermissionTo($subPermission->name)?'checked':''}}
                        >
                    <label class="form-check-label" for="switch-{{$subPermission->id}}">{{$subPermission->cname}}</label>
                </div>
                @endif
            @endforeach
        </div>
        @endif

    @endforeach
    </div>
    <div class="card-footer">
        <input type="submit" value="提交">
    </div>
    </form>
</div>
@endsection

<!-- 主体以下 -->
@section('more')
@endsection


