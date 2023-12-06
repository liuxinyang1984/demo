# 仓储系统开发日志

## 初始化项目
1. 安装laravel
    ```shell
    composer create-project --prefer-dist laravel/laravel laravel
    ```
1. 创建数据库
    前期手动创建数据库及表格,后期整理为数据迁移
    ```sql
    create database mc_stock character set utf8mb4;
    use mc_stock;
    create table admins {
        id int not null auto_increment primary key  comment '主键',
        username varchar(128) not null comment '用户名',
        passwd varchar(64) not null comment '密码',
    } comment '管理员表'

## th
