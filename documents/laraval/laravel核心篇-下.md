## 中间件
中间件可以在程序接收http请求时,拦截后进行过滤和处理.比如当用户登陆时,可以通过中间件进行验证比对,错误后跳转到登陆页面.系统中自带了一些中间件,比如csrf令牌保护中间件
### 创建一个自定义中间件
```shell
php artisan make:middleware Check
```
### 实现一个登陆验证效果
1. 创建Login控制器
    ```php
    php74 artisan make:controller LoginController
    ```
    ```php
    public function handle(Request $request, Closure $next)
    {
        if($request->id !=1 && !$request->has($request->id)){
            redirect('admin.relogin');
        }
        return $next($request);
    }
    ```
1. 注册为路由中间件
    ```php
    // Http/Kernel.php
    protected $routeMiddleware = [
        ...
        'check' => \App\Http\Middleware\Check::class,
    ];
    ```
1. 为路由添加中间件
    ```php
    Route::prefix('admin')->name('admin.')->middleware('check')->group(function(){
        Route::any('/',[\App\Http\Controllers\LoginController::class,'index']);
    });
    ```
1. 后置拦截
    ```php
    $response = $next($request);
    echo "拦截";
    return $response;
    ```
### 中间件的进阶
1. 设置多个中间件
    ```php
    ->middleware('check','auth');
    ```
1. 使用未注册的是中间件
    ```php
    ->middleware(\App\Http\Middleware\Check::class);
    ```
1. 全局中间件
    ```php
    //app/http/kernel.php
    protected $middleware = [
        \App\Http\Middleware\Check::class),
    ];
    ```
1. 中间件传参
    ```php
    Route::middleware('check:abc');
    ```
    ```php
    public function handle(Request $request, Closure $next,$param)
    {
        echo $param;
        return $next($request);
    }
    ```
1. 中间件群组
    ```php
    //kernel.php
    protected $middlewareGroups = [
        ...
        'mymd' = [
            'check' => [\App\Http\Middleware\Check::class]
        ]
    ];
    ```
1. 响应后执行
    ```php
    public function terminate($request,$response){
        echo "<br>我会在http响应完毕后执行";
    }
    ```
1. 控制器构造方法里调用中间件
    ```php
    public function __construct(){
        $this->middleware('check');
    }
    ```

## 模板
