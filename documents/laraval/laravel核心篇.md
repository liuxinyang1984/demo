# 安装和配置
## 环境要求
- php 7.4 +
- composer
## 安装
1. 安装
    ```shell
    composer create-project --prefer-dist laravel/laravel laravel
    ```
1. 运行
    ```shell
    php artisan serve
    ```

# 路由的定义和控制器
## 路由的定义
路由是提供接受http请求的路径,并和程序交互的功能    
### 创建路由
```php
//routes/web.php
Route::get('index',function(){
    return 'Hello,World!';
})
```
### 提交接受方式
- ::get
- ::post()
- ::put()
- ::delete()
- ::put()
- ::any()
- ::match()
    ```php
    Route::match(['get','post'],'index',function(){

    })
    ```
### 传递路由参数
```php
Route::get('user/{id}'),function($id){
    return 'Id:'.$id;
});
```

## 控制器的路由
### 控制器的创建
- artisan命令
    ```shell
    php artisan make:controller TaskController
    ```
- IDE或者手动创建
    ```php
    //TaskController.php
    namespace App\Http\Controllers;
    class TaskController extends Controller{
        ...
    }
    ```

### 配置控制器路由
#### 普通路由
```php
//  /routes/web.php
Route::get('task',[App\Controller\TaskController::class,'index']);
```
```php
//TaskController.php
namespace App\Http\Controllers;
class TaskController extends Controller{
    public function index(){
        echo "<h1>Task->index()</h1>";
    }
}
```
#### 带参数路由
```php
//  /routes/web.php
Route::get('task',[App\Controller\TaskController::class,'index']);
Route::get('task/{id}',[App\Controller\TaskController::class,'showId']);
```
```php
//TaskController.php
namespace App\Http\Controllers;
class TaskController extends Controller{
    ...
    public function showId($id){
        return "ID:".$id;
    }
}
```
### 路由的参数
#### 普通传参
```php
//  /routes/web.php
Route::get('task',[App\Controller\TaskController::class,'read']);
```
```php
//TaskController.php
namespace App\Http\Controllers;
class TaskController extends Controller{
    ...
    public function read($id){
        retrun "ID:".$id;
    }
}
```
#### 参数约束
如果要对参数进行约束,可以使用与此同时来限定参数类型
- 单个参数
    ```php
    //  /routes/web.php
    Route::get('task/{id}',[App\Controller\TaskController::class,'read'])
            ->where('id','[0-9]+');
    ```
- 多个参数
    ```php
    //  /routes/web.php
    Route::get('task/{id}',[App\Controller\TaskController::class,'read'])
            ->where([
                'id'=>'[0-9]+',
                'name' => '[a-z]+'
                ]);
    ```
- 全局约束
    ```php
    //  /app/Providers/RouteServiceProvider.php
    public function boot(){
        Route::pattern('id','[0-9]+');
        parent::boot();
    }
    ```
- 局部解除约束
    ```php
    //  /routes/web.php
    Route::get('task/{id}',[App\Controller\TaskController::class,'read'])
            ->where('id','.*');
    ```


### 路由的重定向
#### redirect()
1. 普通重定向
    ```php
    //  /routes/web.php
    Route::redirect('index','task');
    ```
1.  带状态码重定向
    ```php
    //  /routes/web.php
    Route::redirect('index','task',301);
    ```

#### 301重定向
```php
Route::permanentRedirect('index','task');
```
### 视图路由
视图路由中,有三个参数可选:1.URI(必) 2.名称(必) 3.参数(选)

- view路由
    ```php
    // /routes/web.php
    // URI          /Task
    // 视图名称     task(/resources/views/task.blade.php)
    // 参数         {{$id}}
    Route::view('task','task',['id'=>10]);
    ```
- 使用助手函数
    ```php
    Route::get('task',function(){
        return view('task',['id'=>10]);
    });
    ```
- 控制器视图
    ```php
    // /routes/web.php
    Route::get('task',[\app\Http\Controller\TaskController::class,'index']);
    ```
    ```php
    // TaskController.php
    publicf function index(){
        retrun view('task',['id'=>10]);
    }
    ```
### 路由命名
为路由进行命名,可以生成URL地址或者进行重定向
1. 命名路由
    ```php
    Route::get('task',[\app\Http\Controller\TaskController::class,'index'])->name('task.index');
    ```
1. 助手函数生成URL
    - 使用方法
        ```php
        // http://127.0.0.1:8000/task
        route('task.index');
        ```
    - 额外参数    
        第二个参数为生成的URL参数,第三个参数为是否包含域名
        ```php
        // /task?id=10
        route('task.index',['id'=>10],false);
        ```
1. 重定向生成的url
    ```php
        return redirect()->route('task.index',['id'=10]);
    ```
    ```php
        return redirect(route('task.index',['id'=10]));
    ```
### 路由分组
路由分组可以让大量路由共享路由属性,包括中间件、命名空间等
#### 空的分组
```php
Route::group(['prefix'=>'api'],function(){
});
```
#### 中间件
1. 数组方式
    ```php
    Route::group(['middleware'=>'中间件名'],function(){
    })
    ```;
1. 链式
    ```php
    Route::middleware(['中间件名'])->group(['prefix'=>'api'],function(){
    });
    ```
#### 路由前缀
    1. 数组方式
    ```php
    Route::group(['prefix'=>'api'],function(){
        Route::get('task',[\app\Http\Controller\TaskController::class,'index']);
    });
    ```
    1. 链式
    ```php
    Route::prifix('api')->group(['prefix'=>'api'],function(){
        Route::get('task',[\app\Http\Controller\TaskController::class,'index']);
    });
    ```
#### 子域名
1. 数组方式
    ```php
    Route::group(['domain'=>"127.0.0.1"],function(){
    });
    ```
1. 链式
    ```php
    Route::domain('127.0.0.1')->group(function(){
    });
    ```
#### 命名空间
1. 数组方式
    ```php
    Route::group(['namespace'=>'Admin'],function(){
    });
    ```
1. 链式
    ```php
    Route::namespace('Admin')->group(function(){
    });
    ```
#### 名称前缀
1. 数组方式
    ```php
    Route::group(['as'=>'admin.'],function(){
        Route::get('/',[Admin::class,'index'])->name('index');
    };
    ```
1. 链式
    ```php
    Route::name('admin.')->group(function(){
    });
    ```
1. 嵌套方式
    ```php
    Route::name('admin')->group(function(){
        Route::name('user')->group(function(){
        });
    });
    ```

### 单行为控制器
如果定义一个只执行一个方法的控制器,可以使用单行为控制器
> 单行为控制器不需要指定方法    
> 单行为控制器只是主义上的单行为,并没有限制创建更多的方法访问    

#### 创建
1. 命令行创建
    ```shell
    php artisan make:controller OneController --invokable
    ```
1. IDE或者手工创建
    ```php
    class OneController extends Controller{
        public function __invoke(){
            return '单行为控制器';
        }
    }
    ```
#### 使用
    ```php
    Route::get('one','\App\Http\Controllers\OneController');
    ```

### 路由回退
如果跳转到一个不存在的路由时,会产生404错误,可以使用回退路由,让不存在的路由自动跳转到指定的页面.
> 注意:由于执行顺序问题,必须把回退路由放在所有路由的最底部     

```php
Route::fallback(function(){
    return redirect('/404');
})
```
```php
Route::fallback(function(){
    return view('404');
})
```

### 当前路由
可以使用::current()方法,获取当前路由的信息
```php
Route::get('index',function(){
    //当前路由信息
    dump(Route::current());
    //返回当前路由名称
    return Route::currentRouteName();
    //返回肖前路由指向方法
    return Route::currentRouteAction();
})->name('index');
```

### 响应设置
路由和控制器处理完业务都会返回一个发送到浏览器的响应:return.    
字符串会直接输出,而数组会输出json格式,本身是response对象.
#### response()输出
```php
return respose('index',201);
```
#### 修改http标头
```php
return respose('<b>index</b>')
    ->header('Content-Type','text/plain');
```
#### 显示纯html代码
```php
return respose->view('task',['id'=>10],201)
    ->header('Content-Type','text/plain');
```
