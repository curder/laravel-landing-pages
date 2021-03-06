<?php

namespace Curder\LandingPages\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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

    protected $views = [
        'www/example.stub' => 'landing-pages/www/example.blade.php',
        'mobile/example.stub' => 'landing-pages/mobile/example.blade.php',
    ];

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
            file_get_contents(__DIR__.'/stubs/make/routes/web.stub'),
            FILE_APPEND
        );

        $this->info('Landing pages generated successfully.');

        return Command::SUCCESS;
    }

    /**
     * Create the directories for the files.
     */
    protected function createDirectories() : void
    {
        if (!is_dir($directory = resource_path('views/landing-pages/www'))) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
            }
        }

        if (!is_dir($directory = resource_path('views/landing-pages/mobile'))) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
            }
        }
    }

    /**
     * Export the authentication views.
     */
    protected function exportViews() : void
    {
        foreach ($this->views as $key => $value) {
            if (file_exists($view = resource_path('views/'.$value)) && !$this->option('force')) {
                if (!$this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                    continue;
                }
            }
            copy(__DIR__.'/stubs/make/views/'.$key, $view);
        }
    }
}
