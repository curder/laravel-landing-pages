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
     * The views that need to be exported.
     *
     * @var array
     */
    protected $views = [
        'www/example.stub' => 'www/example.blade.php',
        'mobile/example.stub' => 'mobile/example.blade.php',
    ];

    /**
     * Create a new command instance.
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
        $this->createDirectories();
        $this->exportViews();
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/make/routes.stub'),
            FILE_APPEND
        );

        $this->info('Landing page Router register successfully.');
    }

    /**
     * Create the directories for the files.
     */
    protected function createDirectories()
    {
        if (!is_dir($directory = resource_path('views/www'))) {
            mkdir($directory, 0755, true);
        }

        if (!is_dir($directory = resource_path('views/mobile'))) {
            mkdir($directory, 0755, true);
        }
    }

    /**
     * Export the authentication views.
     */
    protected function exportViews()
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = resource_path('views/'.$value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                __DIR__.'/stubs/make/views/'.$key,
                $view
            );
        }
    }
}
