# 黑马VUE全套视频教程

## Vue3
### webpack
#### webpack的基本使用
1. 什么是webpack    
    webpack是前项项目工程的具体解决方案    

    功能:
    >提供了友好的前端模块化开发支持,以及代码压缩混淆、处理浏览器商javaScript的兼容性、性能优化等功能    

    作用：
    >让程序员把工作的重心放到具体功能的实现上，提高了前端开发效率和项目的可维护性

    应用：    
    >目前企业级的前端项目开发中，决大多数的项目都是基于webpack进行打包构建的
1. 创建列表隔行变色项目 
    1. 新建项目目录
        ```shell
        mkdir changeLi
        cd changeLi
        npm init -y
        ```
    1. 新建src源代码目录
        ```shell
        mkdir src
        ```
    1. 创建首页(index.html)和脚本文件(index.js)
        ```shell
        cd src
        touch index.html index.js
        ```
    1. 初始化首页基本结构
        ```html
        ul>li{这是第$个li}*9
        ```
    1. 安装jQuery
        ```shell 
        npm i jquery -S
        ```
    1. 模块化导入jQuery(ES6),实现效果
        - 导入jQuery
            ```javascript
            // 导入jQuery
            import $ from 'jquery'
            // 隔行变色效果
            $(function(){
                $('li.odd').css('backgroudColor','red')
                $('li.even').css('backgroudColor','cyan')
            })
            ```
        - 导入js
            ```html
            <script src="./index.js"></script>
            ```
            此时浏览器并未能正确解析JS,因为浏览器并不支持ES6语法
    1. 安装webpack    
        ```shell
        npm install webpack webpack-cli -D
        ```
    1. 配置webpack
        1. 在项目根目录中,创建名为webpack.config.js的webpack配置文件,并初始化
        ```javascript
        module.exports = {
            mode: 'development'     //mode用来指定构建模式,可选值有development和production
        }

        ```
        1. 在package.json的script节点下,新增dev脚本
        ```javascript
        "script":{
            "dev":"webpack"         //可以通过npm run dev来执行
        },
        ```
        1. 用webpack打包构建
        ```shell
        npm run dev
        ```
    1. 修改js引用编译好的js文件
        ```html
        <!--<script src="index.js"></script>-->
        <script src="../dist/main.js"></script>
        ```
1. webpack的配置
    1. mode节点可选值    
        1. development
            - 开发环境
            - 不会对打包生成的文件进行代码压缩和性能优化
            - 打包速度快,适合开发阶段
        1. production
            - 生产环境 
            - 会对打包生成的文件进行代码压缩和性能优化
            - 打包速度慢,仅适合在项目发布阶段使用
    1. webpack.config.js的作用    
        webpack.config.js是webpack的配置文件,webpack在真正开始打包构建前,会先读取这个配置文件,从而基于给定的配置,进行打包    
        注意:    
        >由于webpack是基于node.js开发的打包工具,因此在它的配置文件中,支持使用node.js相关的语法和模块进行个性化配置    
    1. webpack中的默认约定    
        1. 默认的打包入口文件为src/index.js
        1. 默认的输出文件路径为dist/main.js
    1. 自定义打包入口与输出
        ```javascript
        const path = require('path')
        module.exports={
            entry:path.join(__dirname,'./src/index.js'),    //打包入口文件路径
            output:{
                path:path.join(__dirname,'./dist'),         //输出文件路径
                filename:'bundle.js'                        //输出文件名
            }
        }
        ```

#### webpack的插件
通过安装和配置第三方的插件,可以拓展webpack的能力,从而让webpack用起来更方便.
1. webpack-dev-server    
    1. 简介
        - 类似于node.js的nodemon工具
        - 每当修改了源代码,webpack会自动进行项目的打包和构建
    1. 安装
        ```shell
        npm i webpack-dev-server -D         //安装包到开发依赖
        ```
    1. 配置
        1. 修改package.json中script字段中的dev命令
            ```javascript
            "script":{
                "dev":"webpack serve"
            }
            ```
        1. 运行命令
            ```shell
            npm run dev
            ```
        1. 查看效果    
            <http://localhost:8080>    
            1. 注意: 此时并没有像教程一样,出现根目录文件列表,根据网上资料修改webpack.config.js
                ```javascript
                    'devServer':{
                        'static':'./',
                    }
                ```
            1. 引用的js文件并没有修改构建的文件,而是放在了虚拟的内存中,默认为项目根目录main.js,修改index.html的js引用,查看效果
            ```html
            <!--<script src="index.js"></script>-->
            <!--<script src="../dist/main.js"></script>-->
            <script src="../main.js"></script>
            ```
    1. devServer节点
        在webpack.config.js配置文件中,可以通过devServer节点对webpack-dev-server插件进行更多的配置    
        ```javascript
        devServer:{
            open:true,          //初次打包完成,自动打开浏览器
            host:'127.0.0.1',   //实时打包所使用的主机地址
            port:'8080'         //实时打包所使用的端口
        }
        ```
1. html-webpack-plugin    
    1. 简介
        - webpack中的html插件(类似于一个模板引擎)
        - 可以通过插件自定index.html页面的内容(复制index.html到根目录)
    1. 安装
        ```shell
        npm i html-webpack-plugin -D    //安装包到开发依赖
        ```
    1. 配置
        1. 导入HTML插件,得到一个构造函数
            ```javascript
            const HtmlPlugin = require('html-webpack-plugin')
            ```
        1. 创建HTML插件的实例对象
            ```javascript
            const htmlPluginObj = new HtmlPlugin({
                template: './src/index.html',       //指定原文件的位置
                filename: 'index.html',             //指定生成文件的位置
            })
            ```
        1. 配置导出
            ```javascript
            module.exports = {
                mode: 'development',     //mode用来指定构建模式,可选值有development和production
                'devServer':{
                    'static':'./',
                },
                plugins:[htmlPluginObj],
            }
            ```
        1. 插件会生成在内存中,并且会自动注入打包好的js文件
1.1. 插件会生成在内存中,并且会自动注入打包好的js文件

#### webpack的loader
在实际开发过程中,webpack默认只能打包处理以js后缀结尾的模块.其它非js后缀名的模块,webpack默认处理不了,需要调用loader加载器才可以正常打包
1. loader的调用过程
    ```mermaid
    graph LR
    A[将要被webpack处理的模块]-->B{是否为JS模块}
    B--是-->BA{是否包含高级JS语法}
    BA--是-->BA1{是否配置了bable}
    BA1--是-->BA1A[调用loader处理]
    BA1--否-->BA1B[报错]
    BA--否-->BA2[webpack进行处理]
    B--否-->BB{是否配置了对应loader}
    BB--是-->BB1[调用loader处理]
    BB--是-->BB2[报错]
    ```
1. css-loader(打包处理css相关文件)
    1. 创建css文件夹
    ```shell
    mkdir css
    ```
    1. 创建index.css文件,并修改样式
    ```shell
    vim css/index.css
    ```
    ```css
    ul{
        list-style:none;
    }
    ```
    1. 引入index.css中导入css文件模块
    ```javascript
    import './css/index.css'
    ```
    1. 安装css-loader
    ```shell
    npm i style-loader css-loader -D    //安装到开发依赖
    ```
    1. 配置cssloader
    ```javascript
    //webpack.config.js
    module-exports = {
        ...
        plugins:[htmlPluginObj],
        module:{
            rules:[
                {
                    test:/\.css$/,
                    use:['style-loader','css-loader']
                }
            ]
        }
    }
    ```

1. less-loader(打包处理less相关文件)
    1. 新建less文件,并修改样式
    ```shell
    vim css/index.less
    ```
    1. 导入less文件
    ```javascript
    import './css/index.less'
    ```
    1. 安装less-loader
    ```shell
    npm i less-loader less -D    //安装到开发依赖
    ```
    1. 配置less-loader
    ```javascript
    ...
    module:{
        rules:[
            {
                test:/\.css$/,
                use:['style-loader','css-loader']
            },
            {
                test:/\.less$/,
                use:['style-loader','css-loader','less-loader']
            }
        ]
    }
    ```
1. url-loader(url路径相关)
    1. 样式表中指定div的背景图片,会出错
        ```css
        div#box{
            background-image:url(../images/div_bk.jpg);
        }
        ```
    1. 安装url-loader
        ```shell
        npm i url-loader file-loader -D    //安装到开发依赖,file-loader为url内置依赖
        ```
    1. 配置url-loader
        ```javascript
        module:{
            rules:[
                ...
                {
                test:/\.jpg|png|gif|jpeg$/,
                use:'url-loader?limit=22229'
                },
            ],
        }
        ```
        >据说webpack5已经不需要于安装url-loader了.
    1. 参数
        >limit用来指定图片的大小,单位是字节(byte)    
        >小于或等于limit大小的图片,会被转为base64格式的图片
    1. loader的另一种配置方式
        ```javascript
        ...
        rules:[
            ...
            {
                test:/\.jpg|png|gif|jpeg$/,
                use:{
                    loader:'url-loader',
                    options:{
                        limit:22229
                    }
                }
            },
        ],
        ```



1. babel-loader(高级js语法)   
#### wepack打包
1. 配置webpack打包发布
    1. 在package.json文件script节点下,新增build命令
        ```javascript
        "script":{
            "dev"   :   "webpack serve",                //开发环境
            "build" :   "webpack --mode production"     //项目打包发布
        }
        ```
    1. 打包发布
        ```shell
        npm run build
        ```
1. 规划生成文件目录
    1. js文件
    ```javascript
    //webpack.config.js
    output:{
        path:path.join(__dirname,'dist'),
        filename:'js/bundle.js',
    }    
    ```
    1. 图片文件
    ```javascript
    //webpack.config.js
    modele:{
        rules:[
            ...
             {
                test:/\.jpg|png|gif|jpeg$/,
                use:{
                    loader:'url-loader',
                    options:{
                        limit:22228,
                        outputPath:"images"
                    }
                }
            },
        ],
    }
    ```
    1. 自动清理dist目录
        - 安装插件
            ```shell
            npm i clean-webpack-plugin -D
            ```
        - 导入插件的构造函数,并创建实例对象
            ```javascript
            const {CleanWebpackPlugin} = requery('clean-webpack-plugin')
            const cleanPlugin = new CleanWebpackPlugin()
            ```
        - 挂载对象到plugins节点
            ```javascript
            plugins:[htmlPluginObj,cleanPlugin]
            ```

#### source Map
前端项目在投入生产环境之前,都需要对javaScript源代码进行压缩混淆,从而减小文件的体积,提高文件的加载效率.此时就不可避免的产生另一个问题
1. 压缩混淆的问题    
    - 变量被替换成没有语义的名称
    - 空行和注释被剔除
1. 什么是SouceMap    
    SourceMap就是一个信息文件,里面存储着位置信息.也就是说,Source Map文件中存储着代码压缩混淆前后的对应关系.    
    有了它,出错的时候,除错工具将直接显示原始代码,而不是转换后的代码,能极大方便后期的调试.
1. 开发环境下的Source Map    
    在开发环境下,webpack默认启用了SourceMap.当程序运行出错时,可以直接在控制台提示错误行的位置,并定位到具体的源代码.
    1. 默认SourceMap的问题    
    默认开发环境生成的SourceMap,记录的是生成后的代码的位置.会导致运行时报错的行数与源代码的行数不一致
    1. 修改webpack.config.js配置文件,修复错误
        ```javascript
        module.exports = {
            mode:'development',
            devtool:'eval-source-map',
            ...
        }
        ```
1. 生产环境下的SourceMap    
    生产环境下,如果省略了devtool选项,则最终生成的文件中,不包含SourceMap.这能够防止原始代码通过SourceMap的形式暴露.此时可以修改devtool的值,只定位具体报错行数,而不显示源代码.
    ```javascript
    module.exports = {
        mode:'development',
        devtool:'nosrouces-source-map',
        ...
    }
    ```


