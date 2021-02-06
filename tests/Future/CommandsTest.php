<?php
namespace Curder\LandingPages\Tests\Future;

use Illuminate\Console\Command;
use Curder\LandingPages\Tests\TestCase;
use Illuminate\Filesystem\Filesystem;

/**
 * Class CommandsTest
 *
 * @package \Curder\LandingPages\Tests\Future
 */
class CommandsTest extends TestCase
{
    /** @test */
    public function it_can_run_landing_page_init() : void
    {
        $this->artisan('landing-page:init', ['--force' => true])
             ->expectsOutput('Landing pages generated successfully.')
             ->assertExitCode(Command::SUCCESS);
    }
}
