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

composer require "curder/laravel-landing-page:~1.0"
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


## License

MIT
