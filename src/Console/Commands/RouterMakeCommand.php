<?php

namespace Curder\LandingPages\Console\Commands;

use Illuminate\Console\Command;

class RouterMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landing-pages:router-make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark landing pages router.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/../../../stubs/routes.stub'),
            FILE_APPEND
        );

        $this->info('Landing page Router register successfully.');
    }
}
