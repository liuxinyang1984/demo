# thinkphp 6.0



## 开发规范及目录结构
### 命名规范
1. 遵循psr-2命名规范和psr-4自动加载
1. 目录和文件的命令规范
    - 目录名:小写+下划线
    - 类库和函数文件以.php为扩展名
    - 类的文件名均以空间定义,并且命名空间的路径和类库文件所在的路径一致
    - 类文件采用帕斯卡命名法(大驼峰),其它彩用小写+下划线命名
    - 类名和文件名操持一致,统一采用帕斯卡命名法
1. 函数和类及属性命名规范
    - 类的名称采用帕斯卡命名法,如:User UserType
    - 函数的命名采用下划线命名法,如:get_user_id;
    - 方法彩用驼峰法,如:getUserId;
    - 属性采用驼峰法,如:tableName;
    - 特例使用双划线\_\_打头函数或者方法作用魔术方法,如:\_\_call \_\_autoload;
1. 常量和配置的规范
    - 常量以大写字母和下划线命名,如APP_PATH;
    - 配置参数以小写字母和下划线命名,如:url_convert;
    - 环境变量定义全用大写字母和下划线,如:APP_DEBUG;
1. 数据表和字段的规范
    - 数据表和字段采用小写+下划线;
    - 字段不用驼峰和中文做为表名和字段名

### 目录结构
1. TP6支持多应用模式,app是应用目录
1. 默认情况下,彩用单模式,结构如下:
```shell
thinkphp
├── app
│   ├── AppService.php
│   ├── BaseController.php
│   ├── common.php
│   ├── controller
│   ├── event.php
│   ├── ExceptionHandle.php
│   ├── middleware.php
│   ├── provider.php
│   ├── Request.php
│   └── service.php
├── composer.json
├── composer.lock
├── config
│   ├── app.php
│   ├── cache.php
│   ├── console.php
│   ├── cookie.php
│   ├── database.php
│   ├── filesystem.php
│   ├── lang.php
│   ├── log.php
│   ├── middleware.php
│   ├── route.php
│   ├── session.php
│   ├── trace.php
│   └── view.php
├── extend
├── LICENSE.txt
├── log.md
├── public
│   ├── favicon.ico
│   ├── index.php
│   ├── robots.txt
│   ├── router.php
│   └── static
├── README.md
├── route
│   └── app.php
├── runtime
├── think
├── vendor
│   ├── autoload.php
│   ├── bin
│   ├── composer
│   ├── league
│   ├── psr
│   ├── services.php
│   ├── symfony
│   └── topthink
└── view
    └── README.md
```

## 安装及配置
### 安装
```shell
 composer create-project topthink/think=6 thinkphp
```
### nginx配置
```vim
// /etc/nginx/site-availabel/tp.localhost.conf
server { listen       80;
	server_name  tp.localhost;
	root   /www/thinkphp/public;
	location / {
	    index  index.html index.htm index.php;
	}
	error_page   500 502 503 504  /50x.html;
	location = /50x.html {
	    root   /usr/share/nginx/html;
	}
	include php74.conf;
```

### 测试命令
```shell
php think run 
```
### 调试模式
1. 复制.example.env为.env文件
```shell
cp .example.env .env
```
2. 将.env文件换行符替换为linux
```vim
// vim .env
// ^M为ctrl+v ctrl+m
:%s/^M/\r/g 
// 检查APP_DEBUG配置
APP_DEBUG = true
```

### 配置信息
1. /.env文件,用于本地配置,部署后会被忽略    
获取配置方式:
```php
use think\facade\Env;
return Env::get('databse.hostname');
```
1. /config文件,用于线上部署
获取配置方式:
```php
use think\facade\config
return Config::get('database.connections.mysql.hostname');
```
1. 本地环境.env文件的优先级会高于config,生产环境.env会被忽略

### url访问模式
1. url解析
    - 多应用: http://serverName/index.php/应用/控制器/操作/参数/值...;
    - 单应用: http://serverName/index.php/控制器/操作/参数/值...;
    - TP6默认是单应用模式,多应用需要作为扩展安装;
1. 兼容模式    
如果不支持url重写,可以用http://serverName/?r=控制器/操作/参数/值来访问.


## 控制器
### 控制器定义
控制器文件存放在controller目录下.
1. 如果改变系统默认的控制器文件目录,可以在config下的router.php配置,如:
```php
'conftoller_layer' => 'controller2',
```
1. 类名和文件名大小写要保持一致,帕斯卡命名
1. 双字母组合的类名,比如class Helloworld访问URL如下:
    - http://localhost/helloworld
    - http://localhost/hello_world
1. 为了避免引入同类名的冲突,可以在route.php设置控制器后缀,那么控制器的命名需要在类名后Controller,比如Test.php-->TestController.php:
```php
'controller_suffix' => true;
```
### 渲染输出
1. ThinkPHP直接采用方法内return的方式输出;
2. json输出,直接采用json函数:
```php
$data = array('a' => 1,'b' => 2,'c' =>3);
return json ($data);
```
3. 避免使用die exit等php方法中断代码,推荐使用助手函数halt();
```php
halt('中断测试');
```
### 基础  多级控制器
1. 基础控制器
    - 创建控制器后,推荐继承基础控制器来获得更多的方法;
    - 基础控制器提供了控制器验证功能,并注入了think\App和think\Request;
1. 空控制器    
在单应用模式下,可以定义一个Error控制器类,来提醒错误:
```php
class ErrorContoller{
    public function index(){
        return 'ErrorContoller:当前控制器不存在!';
    }
}
```
1. 多级控制器    
多级控制器就是在控制器controller目录下再建立目录并创建控制器,例:    
在controller目录建立group目录,并创建BlogController.php控制器,访问的地址为:http://localhost/group.blog
```php
namespace app\controller\group;
use app\BaseController;
class BlogController extends BaseController{
    public function index(){
        echo "group.blog.index";
    }
}
```

## 数据库与模型
### 连接数据库
1. ThinkPHP采用数据抽象层,基于PDO式
1. 修改/config/database.php可以设置连接信息
1. 本地测试,会优先采用.env的配置信息

### 数据库的数据查询
1. 单数据查询
    - Db::table()中table必须指定完整数据表名(包括前缀)
    - 如果希望只查询一条数据,可以使用find()方法,需要指定where条件:
    ```php
    Db::table(`tp_user`)->where('id',27)->find()
    ```
    - Db::getLastSql()方法,可以得到最近一条SQL查询的原生语句
    - 没有查询到任何值,返回null
    - 使用findOrFail()方法同样可以查询一条数据,在没有数据时抛出一个异常:
    ```php
    Db::table('tp_user')->where('id',1)->findOrFail()
    ```
    - 使用findOrEmpty()方法也可以查询一条数据,但在没有数据时返回一个空数组:
    ```php
    Db::table('tp_user')->where('id',1)->findOrEmpty()
    ```
1. 数据集查询
1. 其它查询

