## Laravel Landing Pages Package

## 感谢

* [Laravel-Auto-Page](https://github.com/Mombuyish/Laravel-Auto-Page)

* [laravel-pages](https://github.com/Jeroen-G/laravel-pages)

## 环境要求

* PHP >= 7.0.0

* Laravel >= 5.5.0

* Fileinfo PHP Extension

## 安装

```
composer require "curder/laravel-landing-page:1.*"
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

创建配置文件和数据库迁移文件
```
php artisan vendor:publish --provider="Curder\LandingPages\LandingPagesServiceProvider"
```

修改应用根目录下的 `config/landing-pages.php` 中对应的参数即可

发布路由

```
php artisan landing-page:init
```

执行完上面的命令后将在`routes/web.php`中添加一条路由：

```
Route::get('{slug}/{one?}/{two?}/{three?}/{four?}/{five?}', '\Curder\LandingPages\Http\Controllers\LandingPagesController@show');
```

## License

MIT
