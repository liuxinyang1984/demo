@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')
    <!-- <form action="{{route('upload')}}" method="post" enctype="multipart/form-data"> -->
    <form action="/upload?gid=90909090909" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="formFile" class="form-label">请选择上传文件</label>
            <input class="form-control" type="file" id="formFile" name="editormd-image-file">
        </div>
        <input type="submit" value="提交" class="btn btn-success">
    </form>
@endsection

<!-- 主体以下 -->
@section('more')
<link rel="stylesheet" href="/article/editor.md/css/editormd.min.css" />
<script src="/article/editor.md/editormd.min.js"></script>
@endsection


