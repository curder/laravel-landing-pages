<?php
namespace Curder\LandingPages\Tests\Future;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Curder\LandingPages\Tests\TestCase;

/**
 * Class CommandTest
 *
 * @package \Curder\LandingPages\Tests\Future
 */
class PublishCommandTest extends TestCase
{
    /** @test */
    public function it_can_published_config_file(): void
    {
        // 设置默认配置文件保存路径
        Config::set('filesystems.disks.local.root', config_path());

        // 删除已经存在的文件
        Storage::delete('landing-pages.php');
        // 断言文件不存在
        Storage::assertMissing('landing-pages.php');

        // 执行发布配置文件命令
        $this->artisan('vendor:publish', ['--tag' => 'laravel-landing-pages-config'])
             ->assertExitCode(Command::SUCCESS);
        // 断言配置文件存在
        Storage::assertExists('landing-pages.php');
    }

    /** @test */
    public function it_can_published_migration_file(): void
    {
        // 设置默认配置文件保存路径
        Config::set('filesystems.disks.local.root', database_path('migrations'));

        // 删除已经存在的文件
        Storage::delete('2018_10_30_093706_create_landing_pages_table.php');

        // 断言文件不存在
        Storage::assertMissing('2018_10_30_093706_create_landing_pages_table.php');

        // 执行发布配置文件命令
        $this->artisan('vendor:publish', ['--tag' => 'laravel-landing-pages-migrations'])
             ->assertExitCode(Command::SUCCESS);
        // 断言配置文件存在
        Storage::assertExists('2018_10_30_093706_create_landing_pages_table.php');
    }
}
