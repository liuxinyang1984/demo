@extends('admin::layouts.base')

<!-- head部分head部分 -->
@section('head')
<link rel="stylesheet" href="/lib/@wangeditor/editor/dist/css/style.css">
@endsection

<!-- 主体部分 -->
@section('container')

<!-- wangeditor 部分
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{route('article.test')}}" method="post">
            @csrf
            <textarea style="display:none;" name="content" id="content">@isset($post){{$post->content}}@endisset</textarea>
                <div class="mb-3">
                    <label for="title" class="form-label">文章标题</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label">文章内容</label>
                    <div>
                        <div id="editor—wrapper">
                            <div id="toolbar-container"></div>
                            <div id="editor-container"></div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">提交文章</button>
            </form>
        </div>
    </div>
    -->





<div class="card border-0 shadow-sm">
    @isset($post)
    <form action="{{route('article.post.update',$post->id)}}" method="post">
    <div class="card-header bg-body py-3">
        <h2>编辑文章</h2>
    </div>
    @method('PUT')
    @else
    <form action="{{route('article.post.store')}}" method="post">
    <div class="card-header bg-body py-3">
        <h2>新建文章</h2>
    </div>
    @endisset
    @csrf



    <div class="card-body">
        <div class="row d-flex">
            <div class="input-group input-group mb-2 col">
                <span class="input-group-text" id="inputGroup-sizing-sm">标题</span>
                <input type="text" class="form-control" name="title" value="@isset($post){{$post->title}}@endisset">
            </div>
            <div class="input-group input-group mb-2 col">
                <span class="input-group-text" id="inputGroup-sizing-sm">分类</span>
                <select aria-label="pid" class="form-control select2-hidden-accessible" id="cate_id" name="cate_id">
                    @foreach($tree as $selectCateId => $selectCate)
                    <option value="{{$selectCateId}}">{{$selectCate['name']}}</option>
                    @isset($post)
                    @if($post->cate_id == $selectCateId)
                    <option value="{{$selectCateId}}" selected>{{$selectCate['name']}}</option>
                    @endif
                    @endisset
                    @endforeach
                </select>
            </div>

        </div>
        <div class="mb-12 row mt-2" id="editor">
            <textarea style="display:none;" name="content">@isset($post){{$post->content}}@endisset</textarea>
        </div>
    </div>
    <div class="card-footer bg-body d-md-flex justify-content-md-end">
        <button type="submit" class="btn btn-primary btn-block text-end">提交</button>
    </div>
    </form>
</div>
@endsection

<!-- 主体以下 -->
@section('more')

<!--
<script src="/lib/@wangeditor/editor/dist/index.js"></script>
<script>
    const {createEditor, createToolbar, Boot} = window.wangEditor
    const editorConfig = {
        //最好关闭自动聚焦,用户体验会比较好
        autoFocus: false,
        placeholder: '开始你的创作!',
        onChange(editor) {
            const html = editor.getHtml()
            console.log('editor content', html)
            // 也可以同步到 <textarea>
            $('#content').val(html)

        }
    }

    let isHTML = false;

    class MyButtonMenu {                       // JS 语法

        constructor() {
            this.title = '源码' // 自定义菜单标题
            // this.iconSvg = '<svg>...</svg>' // 可选
            this.tag = 'button'
            this.tooltip = 'ewqew'

        }

        // 获取菜单执行时的 value ，用不到则返回空 字符串或 false
        getValue(editor) {                              // JS 语法
            return false
        }

        // 菜单是否需要激活（如选中加粗文本，“加粗”菜单会激活），用不到则返回 false
        isActive(editor) {                    // JS 语法
            return false
        }

        // 菜单是否需要禁用（如选中 H1 ，“引用”菜单被禁用），用不到则返回 false

        isDisabled(editor) {                     // JS 语法
            return false
        }

        // 点击菜单时触发的函数

        exec(editor, value) {                              // JS 语法
            if (this.isDisabled(editor)) return
            let source = editor.getHtml();

            console.log(source);

            if (source) {
                isHTML = !isHTML;
            }
            if (isHTML) {
                source = source.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/ /g, "&nbsp;");
                // console.log(source);
            } else {
                source = editor.getText().replace(/&lt;/ig, "<").replace(/&gt;/ig, ">").replace(/&nbsp;/ig, " ")
                // console.log(2);
            }

            // editor.setHtml('<p>hello</p>')

            // console.log(source);


            // editor.insertText(value) // value 即 this.value(editor) 的返回值
        }

    }

    const menu1Conf = {
        key: 'menu1', // 定义 menu key ：要保证唯一、不重复（重要）
        factory() {
            return new MyButtonMenu() // 把 `YourMenuClass` 替换为你菜单的 class
        },
    }

    Boot.registerMenu(menu1Conf)


    const editor = createEditor({
        selector: '#editor-container',
        @isset($post)
        html: '{{$post->content}}',
        @else
        html: '<p><br></p>',
        @endif
        config: editorConfig,
        mode: 'default', // or 'simple'
    })


    const toolbarConfig = {
        insertKeys: {
            index: 0, // 插入的位置，基于当前的 toolbarKeys
            keys: ['menu1']
        },
    }

    const toolbar = createToolbar({
        editor,
        selector: '#toolbar-container',
        config: toolbarConfig,
        mode: 'default', // or 'simple'
    })


</script>
-->

<script type="text/javascript">
    $(function() {
        var editor = editormd("editor", {
            width: "100%",
            height: "600px",
            // markdown: "xxxx",     // dynamic set Markdown text
            path : "/article/editor.md/lib/"  // Autoload modules mode, codemirror, marked... dependents libs path
        });
    });
</script>
<link rel="stylesheet" href="/article/editor.md/css/editormd.min.css" />
<script src="/article/editor.md/editormd.min.js"></script>

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


