<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class GenerateBaseFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:base:files';

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
    protected $pathDataTableDirectory;

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $directories = collect($this->files->directories($this->pathViewDirectory))->map(function ($directory) {
            return Str::afterLast($directory, '/');
        })->toArray();

        collect($this->files->allFiles(app_path('Models/')))->each(function ($file) use ($directories) {
            $className = $file->getBasename('.php');

            $this->generateCrudViews($className);
            $this->generateDataTableClass($className);
        });

        return Command::SUCCESS;
    }

    /**
     * Generate all files for views (index, edit)
     * @param $className
     */
    private function generateCrudViews($className)
    {
        $path = $this->pathViewDirectory . '/' . Str::slug($className);

        if (!$this->files->exists($path)) {
            $this->files->makeDirectory($path);
            collect(['index', 'edit'])->each(function ($action) use ($path, $className) {
                switch ($action) {
                    case 'index':
                        $stub = $this->getStubs($action);
                        $content = $this->getStubContents($stub, [
                            'CLASS_NAME' => $className,
                            'CLASS_NAME_PLURAL' => Str::plural(Str::lower($className)),
                        ]);
                        $this->files->put($path . "/$action.blade.php", $content);
                        break;

                    case 'edit':
                        $stub = $this->getStubs($action);
                        $content = $this->getStubContents($stub, [
                            'CLASS_NAME_PLURAL' => Str::plural(Str::lower($className)),
                            'CLASS_NAME' => Str::lower($className),
                            'CONTENT' => $this->makeFieldsForm($className)
                        ]);
                        $this->files->put($path . "/$action.blade.php", $content);
                        break;
                }
            });
        }
    }

    /**
     * Build the  content of the edit file
     * @param $className
     * @return string
     */
    private function makeFieldsForm($className)
    {
        $columns = $this->getColumns($className);
        $classNameLower = Str::lower($className);

        $fields = collect($columns)->map(function ($type, $name) use($classNameLower) {
            $label = Str::of($name)->replace('_', ' ')->lower()->ucFirst();

            return match ($type) {
                'string' => "<x-forms.input type='text' label='$label' id='$name' name='$name' value=\"{{ old('$name', $$classNameLower->$name) }}\"></x-forms.input>",
                'text' => "<x-forms.text-area type='text' label='$label' id='$name' name='$name'>{{old('$name', $$classNameLower->$name) }}</x-forms.text-area>",
                'date' => "<x-forms.input type='date' label='$label' id='$name' name='$name' value=\"{{ old('$name', $$classNameLower->$name) }}\"></x-forms.input>",
                $this->isForeignKey($name, $type) => "<x-forms.select name='toto' ></x-forms.select>",
                default => null,
            };
        })->filter(function($item) {
            return $item !== null;
        })->implode("\n");

         return $fields;

    }

    /**
     * if the name field contain _id, we return the type of field for matched the match
     * @param $name
     * @param $type
     * @return false
     */
    private function isForeignKey($name, $type) {

        if (Str::contains($name, '_id')) {
            return $type;
        }
        return false;
    }

    private function getColumns($className)
    {
        $className = Str::plural(Str::lower($className));
        return collect(Schema::getColumnListing($className))->flatMap(function ($column) use ($className) {
            return [$column => Schema::getColumnType($className, $column)];
        });
    }

    /**
     * Generate the dataTable class
     *
     * @param $className
     */
    private function generateDataTableClass($className)
    {
        $stub = $this->getStubs('datatable');
        $content = $this->getStubContents($stub, [
            'CLASS_NAME' => $className.'DataTable',
            'ID_TABLE' => Str::plural(Str::lower($className)),
        ]);

        if (!file_exists($this->pathDataTableDirectory . "/{$className}DataTable.php")) {
            $this->files->put($this->pathDataTableDirectory . "/{$className}DataTable.php", $content);
        }
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    private function getStubs($stubName)
    {
        return __DIR__ . "/stubs/$stubName.stub";
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param $stub
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    private function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;

    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param string $path
     * @return string
     */
    private function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
