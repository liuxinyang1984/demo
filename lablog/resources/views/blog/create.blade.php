@extends('layouts.default')

@section('content')
<form action="{{route('blog.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            发布文章
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="content">
                    内容
                </label>

                <textarea name="content" id="" cols="30" rows="5" class="form-control">{{old('content')}}</textarea>

            </div>
        </div>
        <div class="card-footer text-muted">
            <button type="submit" class="btn btn-success">发表</button>
        </div>
    </div>
</form>
@endsection
