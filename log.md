# thinkphp 6.0
## 安装及配置
### 安装
```shell
 composer create-project topthink/think thinkphp
```
### 配置
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



## 开发规范及目录结构
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

## 目录结构
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
1. 

