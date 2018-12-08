<div style="text-align:center">
    <h1>Vmoex - 期望成为最美好的二次元社区</h1>
</div>

vmoex是一个开源的二次元社区程序。


## 疗效 

[戳我见效果](https://www.vmoex.com/)

## 安装指南

    cd /path/to/webroot/path
    
    git clone git@github.com:yeskn-studio/vmoex-framework.git

**或者指定版本，比如：**

    git clone --branch v2.1.1 git@github.com:yeskn-studio/vmoex-framework.git
    
**切换目录**

    cd vmoex-framework

**修改runtime目录权限**

    chown -R [webuser] var

**修改配置文件**

    vim app/config/parameter.yaml.dist

**安装php依赖**

    composer install （期间会提示配置，检查无误可一路回车）

**安装前端依赖**

    bower install （root用户请运行：bower install --allow-root）
    
**创建数据库**

    php bin/console doctrine:database:create （如果你已经手动创建了数据库，可跳过）

**导入数据**

    php bin/console doctrine:database:init

**修改管理员密码**

    php bin/console change-password -u admin -p [password]
    
**清理缓存**

    chown -R [webuser] var （上面已经执行过，这里再执行一次）
    sudo -u [webuser] php bin/console cache:clear --env=dev
    
**创建静态资源文件**

    php bin/console assetic:dump --env=dev
    
**启动websocket**

    php bin/push-service.php start -d

**服务器上运行（dev）**

    php bin/console server:run 0.0.0.0:8000

**本地运行（dev）**

    php bin/console server:run 127.0.0.1:8000

提示：以上两种方式运行时，看板娘可能无法加载，请使用nginx来运行

**访问**

    http://[127.0.0.1或者服务器ip]:8000

## 部署在nginx上

在上面的安装指南中运行的是dev模式，适合开发时环境，如果在真是环境运行，请务必使用类似nginx的web server来运行，nginx配置示例：

```nginx
server {
    listen          80;
    server_name     www.vmoex.com;

    root            /var/www/vmoex-framework/web;
    index           app.php;

    if (!-e $request_filename) {
        rewrite  ^(.*)$  /?$1  last;
        break;
    }
    
    location ~ \.php$ {
        include        fastcgi_params;
        fastcgi_pass   127.0.0.1:9000;
        access_log     /var/log/nginx/access.log main;
    }
}
```

nginx配置好后，还无法直接访问网站，请执行如下操作：

**清理prod模式下的缓存**

    chown -R [webuser] var
    sudo -u [webuser] php bin/console cache:clear --env=prod
    
**生成prod模式下的静态资源文件**

    php bin/console assetic:dump --env=prod

## 配置文件

app/config/parameter.yaml.dist并不是真正生效的配置文件，真正生效的是自动生成的app/config/parameter.yaml，
需修改配置时请修改此文件，修改完后，需要重新清理缓存或者生成静态资源文件。

## 看板娘

![](https://static.yeskn.com/kanbanniang.png)

由[维基萌](https://www.wikimoe.com/)提供。
