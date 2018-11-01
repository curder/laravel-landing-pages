<?php

namespace Curder\LandingPages\Console\Commands;

use Illuminate\Console\Command;

class PackageInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'landing-page:init
                        {--force : Overwrite existing views by default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make landing pages router and example template views.';

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

        $this->info('Landing pages generated successfully.');
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
        $views = config('landing-pages.database.templates');
        foreach ($views as $key => $value) {
            if (file_exists($view = resource_path('views/'.$value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            $base_file = __DIR__.'/stubs/make/views/example.stub';

            if (file_exists($base_file)) {
                copy($base_file, $view);
            } else {
                $this->alert("Base template：${base_file} does not eixist. Please create {$view} by yourself, Thanks!!!");
            }
        }
    }
}
