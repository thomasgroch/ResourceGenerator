<?php

namespace groch\ResourceGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ResourceGeneratorCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:resource {name} {--path=} {--delete=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all Structure for a given resource name';

    /**
     * @var StructureGenerator
     */
    protected $generator;
    private $file;

    /**
     * Create a new command instance.
     *
     * @param StructureGenerator $generator
     * @param Filesystem         $file
     */
    public function __construct(StructureGenerator $generator, Filesystem $file)
    {
        parent::__construct();

        $this->file = $file;

        $this->generator = $generator;
        $this->generator->bind($this);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line("
        ╦═╗┌─┐┌─┐┌─┐┬ ┬┬─┐┌─┐┌─┐  ╔═╗┌─┐┌┐┌┌─┐┬─┐┌─┐┌┬┐┌─┐┬─┐
        ╠╦╝├┤ └─┐│ ││ │├┬┘│  ├┤   ║ ╦├┤ │││├┤ ├┬┘├─┤ │ │ │├┬┘
        ╩╚═└─┘└─┘└─┘└─┘┴└─└─┘└─┘  ╚═╝└─┘┘└┘└─┘┴└─┴ ┴ ┴ └─┘┴└─\n");

        // calculate the name
        $name = $this->argument('name');
        $path = $this->option('path') ?:app_path();
        $delete = $this->option('delete');

        if($delete){
            if($this->confirm("Sure you want to delete all resource files related to $name?")){
                $this->generator->deleteStructure($name, $path);
            }
            exit;
        }

        $this->generator->makeStructure($name, $path);

    }
}
