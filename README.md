# b5YiiCMF

#### 介绍
基于 Yii 2 + bootstrap 3，仿照java的若依框架，做了一些改动与Yii2结合，做了一点简单封装，构架了这套CMF系统。


本系统只是经过简单测试，还未正式使用，若有问题或建议，请多多指教。

#### 软件架构
基于 Yii 2 + bootstrap 3，其中使用了bootrstrap-table来进行列表的展示，以及一些较为流行js插件做各种效果，页面简洁、响应式。

系统在MVC的基础上加了已成Service，用来处理业务逻辑。
还单独列出了缓存类Cache
基本是一个表 对应一个Model、Service及Cache。当然在后面开发的功能你可以根据自己的喜好写。

系统完全开源，数据库文件在public目录下，超管默认为：admin，123456。

#### 系统演示
地址：<a href="http://b5yiicmf.b5net.com/" target="_blank">http://b5yiicmf.b5net.com</a>

账号：ceshi

密码：123456

### 下载地址：
github: https://github.com/qin795217119/b5yiicmf

gitee: https://gitee.com/b5net/b5-yii-cmf

#### 使用说明

1. 环境推荐使用 PHP 7.4 + Mysql 5.7 +Nginx 

2.系统搭建

   ①该系统使用一个域名 访问多项目的形式

   ②将原来的yii2的js和css进行了去除，可参考 backend/config/main-local.php下的assetManager配置
   
   ③对yii2 的入口文件进行了挪移，使用域名直接解析到项目根目录，通过域名+/backend 来进行访问
   
   ④ apache或nginx 开启重写
   
   apache：
   
    <IfModule mod_rewrite.c>
       <IfModule mod_negotiation.c>
           Options -MultiViews -Indexes
       </IfModule>
   
       RewriteEngine On
   
       RewriteCond %{REQUEST_FILENAME} !-d
       RewriteCond %{REQUEST_FILENAME} !-f
       RewriteRule ^backend backend/index.php [L]
       RewriteRule ^api api/index.php [L]
   </IfModule>
   
   nginx:Ⅰ.
   
    location / {
      if (!-e $request_filename){
       rewrite ^/backend/(.*)$ /backend/index.php/$1 last;
      }
    }  

   nginx:Ⅱ ，在backend/config/main.php下的components=>request 里面增加'baseUrl'=>'/admin'，然后添加nginx配置如下的。这种可以随意配置后台访问路径
   
     location /admin {
         alias  D:\Apro_my\b5yii2cmf\backend;
         rewrite  ^(/admin)/$ $1 permanent;  
         try_files  $uri /backend/index.php?$args;  
     }
 
#### 内置功能

1. 人员管理：人员是系统操作者，该功能主要完成系统用户配置。
2. 组织架构：配置系统组织机构（公司、部门、小组），树结构展现支持，数据权限暂未开发。
3. 菜单管理：配置系统菜单，操作权限，按钮权限标识等。
4. 角色管理：角色菜单权限分配。
5. 字典管理：对系统中经常使用的一些较为固定的数据进行维护。
6. 参数管理：对系统动态配置常用参数，默认为文本、数据、枚举三种类型。
7. 跳转管理：用于定义系统内跳转的模块、模块列表地址、模块信息地址，可以与推荐信息结合生成跳转链接或标识，对于多端开发又用
8. 推荐位置：增加特定的标识用于推荐信息的分类
9. 推荐信息：又称广告，对应推荐位置，可以添加一或多条信息，包含 标题、图片、文本及富文本信息、跳转链接等信息
10. 通知公告：系统通知公告信息发布维护。
11. 操作日志：系统正常操作日志记录和查询；系统异常信息日志记录和查询。



