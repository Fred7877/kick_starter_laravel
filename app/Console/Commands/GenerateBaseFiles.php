<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateBaseFiles extends AbstractGenerateCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:base:files {className : The name class} {--o|overwrite : overwrite the models and controller}';

    /**
     * Filesystem instance
     * @var Filesystem
     */
    protected $files;

    /**
     * @var string
     */
    protected $pathViewDirectory;

    /**
     * @var string
     */
    protected $pathControllerDirectory;

    /**
     * @var string
     */
    protected $pathDataTableDirectory;

    /**
     * @var string
     */
    protected $pathModelDirectory;

    /**
     * @var string
     */
    protected $pathMigrationDirectory;

    protected $overwrite = false;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command generate views and datatable files with the models';

    /**
     * Create a new command instance.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->pathViewDirectory = resource_path('views/admin');
        $this->pathDataTableDirectory = app_path('DataTables');
        $this->pathDataTableDirectory = app_path('DataTables');
        $this->pathControllerDirectory = app_path('Http/Controllers/Admin');
        $this->pathModelDirectory = app_path('Models');
        $this->pathMigrationDirectory = app_path('../database/migrations');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->className = $this->argument('className');
        $this->overwrite = $this->option('overwrite');

        if ($this->overwrite) {
            if (!$this->confirm('The overwrite option is true, the model and controller will be overwritten; continue?')) {
                return Command::INVALID;
            }
        }

        $this->generateController();
        $this->generateModelFactorySeeder();
        $this->generateIndexView();
        $this->generateDataTableClass();

        return Command::SUCCESS;
    }

    /**
     * Check if a migration with className is exists.
     * @return bool
     */
    private function isMigrationPresent()
    {
        return collect($this->files->allFiles($this->pathMigrationDirectory))->map(function ($file) {
            if (Str::contains($file, Str::of($this->className)->lower()->plural())) {
                return true;
            }

            return false;
        })->contains(true);
    }

    /**
     * Generate the migration, model, factory and seeder files.
     */
    private function generateModelFactorySeeder()
    {

        $file = $this->pathModelDirectory . '/' . Str::ucfirst($this->className) . '.php';

        if (!$this->files->exists($file) || $this->overwrite) {
            $stub = $this->getStubs('model');
            $content = $this->getStubContents($stub, [
                'CLASS_NAME' => Str::ucfirst($this->className),
                'PROPERTIES' => $this->generateProperties()
            ]);
            $this->files->put($file, $content);
            $this->info('Model created successfully.');
        } else {
            $this->info(Str::ucfirst($this->className) . ' Model is already exists.');
        }

        if (!$this->isMigrationPresent()) {
            Artisan::call('make:migration create_' . Str::of($this->className)->lower()->plural() . '_table');
            $this->info(Artisan::output());
        }

        Artisan::call('make:factory ' . Str::ucfirst($this->className) . 'Factory');
        $this->info(Artisan::output());
        Artisan::call('make:seeder ' . Str::ucfirst($this->className) . 'Seeder');
        $this->info(Artisan::output());
    }

    /**
     * Generate the controller file.
     */
    private function generateController()
    {
        $file = $this->pathControllerDirectory . '/' . Str::ucfirst($this->className) . 'Controller.php';

        if (!$this->files->exists($file) || $this->overwrite) {
            $stub = $this->getStubs('controller');
            $content = $this->getStubContents($stub, [
                'CLASS_NAME' => Str::ucfirst($this->className),
                'DATATABLE_CLASSNAME' => Str::ucfirst($this->className) . 'DataTable',
                'LOWERCASE_MODEL_NAME' => Str::lower($this->className),
                'PROPERTIES' => $this->generateInsertProperties()
            ]);
            $this->files->put($file, $content);
            $this->info('Controller created successfully.');
        } else {
            $this->info(Str::ucfirst($this->className) . 'Controller is already exists.');
        }
    }

    /**
     * Generate model properties for insert.
     *
     * @return string
     */
    private function generateInsertProperties()
    {
        return $this->getColumns()->map(function ($type, $name) {
            if (!in_array($name, ['id', 'created_at', 'updated_at'])) {
                return "\t\t\t\t'$name'" . ' => $request->get(\'' . $name . '\')';
            }
            return null;
        })->flatten()->filter(fn($item) => $item !== null)->implode(",\n");
    }

    /**
     * Generate model properties.
     *
     * @return string
     */
    private function generateProperties()
    {
        return $this->getColumns()->map(function ($type, $name) {
            if (!in_array($name, ['id', 'created_at', 'updated_at'])) {
                return "\t\t'$name'";
            }
            return null;
        })->flatten()->filter(fn($item) => $item !== null)->implode(",\n");
    }

    /**
     * Generate index view
     */
    private function generateIndexView()
    {
        $path = $this->pathViewDirectory . '/' . Str::slug($this->className);

        if (!$this->files->exists($path . '/' . 'index.blade.php')) {
            $this->files->makeDirectory($path);
            $stub = $this->getStubs('index');
            $content = $this->getStubContents($stub, [
                'CLASS_NAME' => $this->className,
                'CLASS_NAME_PLURAL' => Str::plural(Str::lower($this->className)),
            ]);
            $this->files->put($path . "/index.blade.php", $content);
        }
    }

    /**
     * Generate the dataTable class
     *
     */
    private function generateDataTableClass()
    {
        $stub = $this->getStubs('datatable');
        $content = $this->getStubContents($stub, [
            'CLASS_NAME' => $this->className,
            'ROUTE_NAME' => Str::lower($this->className),
            'ID_TABLE' => Str::plural(Str::lower($this->className)),
            'COLUMNS' => $this->generateColumnsDatatable(),
        ]);

        if (!file_exists($this->pathDataTableDirectory . "/{$this->className}DataTable.php")) {
            $this->files->put($this->pathDataTableDirectory . "/{$this->className}DataTable.php", $content);
        }
    }

    /**
     * Generate the colummns name for the DataTable file.
     * @return string
     */
    private function generateColumnsDatatable()
    {
        return $this->getColumns()->map(function ($type, $name) {
                return "\t\t\tColumn::make('$name')";
            })->flatten()->implode(",\n") . ",\n\t\t\tColumn::computed('actions')";
    }
}
