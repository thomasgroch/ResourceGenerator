<?php

namespace groch\ResourceGenerator\Console\Commands;


use Illuminate\Filesystem\Filesystem;

class StructureGenerator
{

    /**
     * @var Filesystem
     */
    protected $file;

    private $name;


    /**
     * @var fileNameGenerator
     */
    private $fileNameGenerator;

    /**
     * @var Command
     */
    private $command;

    /**
     * StructureGenerator constructor.
     *
     * @param Filesystem        $file
     * @param fileNameGenerator $fileNameGenerator
     */
    public function __construct(Filesystem $file, fileNameGenerator $fileNameGenerator)
    {
        $this->file = $file;
        $this->fileNameGenerator = $fileNameGenerator;
    }

    public function make($name, $type, $path)
    {
        $template = $this->getTemplate($this->fileNameGenerator->getName('Resource', $type));

        $this->file->makeDirectory($path, 0755, true, true);

        $path = $path . $this->fileNameGenerator->getName($name, $type) . '.php';

        $this->command->info("$path generated");

        $this->file->put($path, $template);
    }

    private function getTemplate($model)
    {
        $template = $this->file->get(__DIR__ . "/templates/$model.php");

        $template = str_replace('Resource', $this->name, $template);
        $template = str_replace('resource', strtolower($this->name), $template);
        $template = str_replace('Resources', str_plural($this->name), $template);
        $template = str_replace('resources', strtolower(str_plural($this->name)), $template);

        return $template;
    }

    public function makeStructure($name, $path)
    {
        // calculate the name
        $name = strtolower($name);
        $name = ucwords($name);
        $this->name = $name;

        // generate all structure files
        $this->make(
            $name,
            "controller",
            "app/Http/Controllers/"
        );
        $this->make(
            $name,
            "request",
            "app/Http/Requests/"
        );
        $this->make(
            $name,
            "model",
            "app/Models/"
        );
        $this->make(
            $name,
            "transformer",
            "app/Transformers/"
        );
        $this->make(
            $name,
            "factory",
            "database/factories/"
        );
        $this->make(
            $name,
            "migration",
            "database/migrations/"
        );
        $this->make(
            $name,
            "tableSeeder",
            "database/seeds/"
        );
        $this->make(
            $name,
            "test",
            "tests/Unit/"
        );

        $this->command->comment("\nRemember to add the following lines to ./routes/api.php file");

        $this->command->line("==================================================================================\n");
        echo $this->getTemplate('routes');
        echo "\n==================================================================================\n";

        $this->command->comment("\nRemember to add the following lines to ./database/seeds/DatabaseSeeder.php file");
        $this->command->line("==================================================================================\n");
        echo str_replace('Resources', str_plural($name), '$this->call(ResourcesTableSeeder::class);');
        echo "\n==================================================================================\n";

        $this->command->comment("\nRemember to run: composer dumpautoload");
        $this->command->comment("To reseed database run:");
        $this->command->comment("php artisan migrate:refresh --seed");

        $this->command->comment("done..");

    }

    public function bind($commandClass)
    {
        $this->command = $commandClass;
    }

    public function deleteStructure($name, $path)
    {
        // calculate the name
        $name = strtolower($name);
        $name = ucwords($name);
        $this->name = $name;

        // delete all structure files
        $this->delete(
            $name,
            "controller",
            "app/Http/Controllers/"
        );
        $this->delete(
            $name,
            "request",
            "app/Http/Requests/"
        );
        $this->delete(
            $name,
            "model",
            "app/Models/"
        );
        $this->delete(
            $name,
            "transformer",
            "app/Transformers/"
        );
        $this->delete(
            $name,
            "factory",
            "database/factories/"
        );
        $this->delete(
            $name,
            "migration",
            "database/migrations/"
        );
        $this->delete(
            $name,
            "tableSeeder",
            "database/seeds/"
        );
        $this->delete(
            $name,
            "test",
            "tests/Unit/"
        );

        $this->command->comment("\nRemember to delete routes! ./routes/api.php file");
        $this->command->comment("\nRemember to delete TableSeeder! ./database/seeds/DatabaseSeeder.php file");
        $this->command->comment("\nRemember to run: composer dumpautoload");

    }

    public function delete($name, $type, $path)
    {
        $path = $path . $this->fileNameGenerator->getName($name, $type) . '.php';

        $this->command->info("$path Deleted");

        $this->file->delete($path);
    }

}