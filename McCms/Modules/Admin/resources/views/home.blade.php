@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')
@endsection

<!-- 主体部分 -->
@section('container')
@include('admin::layouts._error')
    <!--  为了美观,建议大家都把新内容都放card组件里面  -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body">
            新页面标题
        </div>
        <div class="card-body">
            这是一个干净的新页面,方便开发时复制此页面
        </div>
    </div>

    <!--回到顶部开始-->
    <a href="javaScript:" class="bsa-back-to-top"><i class='bi bi-arrow-up-short'></i></a>
    <!--回到顶部结束-->
@endsection

<!-- 主体以下 -->
@section('more')
@endsection


