## Laravel Landing Pages Package

项目支持对推广页面的本地模版管理和数据库配置管理通用解决办法。


## 感谢

* [Laravel-Auto-Page](https://github.com/Mombuyish/Laravel-Auto-Page)

* [laravel-pages](https://github.com/Jeroen-G/laravel-pages)

## 环境要求

* PHP >= 7.0.0

* Laravel >= 5.5.0

* Fileinfo PHP Extension

## 安装

```
composer require "curder/laravel-landing-page:^3.0"
```

## 配置

在 `config/app.php` 注册 ServiceProvider 和 Facade

```
'providers' => [
    // ...
    Curder\LandingPages\LandingPagesServiceProvider::class,
],
'aliases' => [
    // ...
    'LandingPage' => Curder\LandingPages\Facades\LandingPages::class,
],

```

### 创建配置文件和数据库迁移文件
```
php artisan vendor:publish --provider="Curder\LandingPages\LandingPagesServiceProvider"
```

修改应用根目录下的 `config/landing-pages.php` 中对应的参数即可。


### 创建数据表

使用下面的命令创建数据库表。

```
php artisan migrate
```

使用下面的命令在Tinker里面新增测试数据。

```
namespace Curder\LandingPages\Models;
LandingPage::forceCreate(['title' => 'test www title.', 'body' => 'test www body.', 'uri' => 'www/example', 'template' => 'landing-pages.www.example']);
LandingPage::forceCreate(['title' => 'test mobile title.', 'body' => 'test mobile body.', 'uri' => 'mobile/example', 'template' => 'landing-pages.mobile.example']);
```



### 发布路由和模版文件

```
php artisan landing-page:init
```

执行完上面的命令后将在`routes/web.php`中添加一条路由：

```
Route::get('{slug}/{one?}/{two?}/{three?}/{four?}/{five?}', '\Curder\LandingPages\Http\Controllers\LandingPagesController@show');
```

并且默认在`resources/views/www/`和`resources/vies/mobile/`下新建一个`example.blade.php`，您可以根据实际业务需求来自定义。

### 预览页面

通过下面的地址来访问页面的数据。

```
http://localhost/www/example
http://localhost/mobile/example
```

## License

MIT
