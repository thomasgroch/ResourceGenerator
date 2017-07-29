<?php

namespace groch\ResourceGenerator;

use groch\ResourceGenerator\Console\Commands\ResourceGeneratorCommand;
use Illuminate\Support\ServiceProvider;

class ResourceGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Console/Commands/structure_files/ApiController.php' => app_path('Http/Controllers'),
            __DIR__.'/Console/Commands/structure_files/ApiCrudController.php' => app_path('Http/Controllers'),
            __DIR__.'/Console/Commands/structure_files/TokenAuth' => app_path('Http/Controllers'),
            __DIR__.'/Console/Commands/structure_files/helpers' => app_path('../tests/Unit'),
            __DIR__.'/Console/Commands/structure_files/Transformer.php' => app_path('Transformer'),
            __DIR__.'/Console/Commands/structure_files/CrudSave.php' => app_path('Helpers'),
        ], 'install-resource');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register artisan commands
     * @codeCoverageIgnore
     */
    private function registerCommands()
    {
        if ($this->app->environment() !== 'production') {

            if ($this->app->runningInConsole()) {
                $this->commands([
                    ResourceGeneratorCommand::class,
                ]);
            }
        }
    }
}