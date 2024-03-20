@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')

@endsection

<!-- 主体部分 -->
@section('container')
<div id="editor">
    <!-- Tips: Editor.md can auto append a `<textarea>` tag -->
    <textarea style="display:none;">### Hello Editor.md !</textarea>
</div>
<script type="text/javascript">
    $(function() {
        var editor = editormd("editor", {
            // width: "100%",
            height: "900px",
            // markdown: "xxxx",     // dynamic set Markdown text
            path : "editor.md/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
        });
    });
</script>
@endsection

<!-- 主体以下 -->
@section('more')
<link rel="stylesheet" href="/article/editor.md/css/editormd.min.css" />
<script src="/article/editor.md/editormd.min.js"></script>
@endsection


