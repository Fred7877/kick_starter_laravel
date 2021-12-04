<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class GenerateCrudForms extends AbstractGenerateCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:crud:forms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command generate the edit and create form';

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
     * @var bool
     */
    protected $generated = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->pathViewDirectory = resource_path('views/admin');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        collect($this->files->allFiles(app_path('Models/')))->each(function ($file) {
            $this->className = $file->getBasename('.php');

            $this->generateCrudViews();
        });

        if ($this->generated) {
            $this->info('views as been generated successfully.');
        } else {
            $this->info('Nothing to generate.');
        }

        return Command::SUCCESS;
    }

    private function generateCrudViews()
    {
        $path = $this->pathViewDirectory . '/' . Str::slug($this->className);

        collect(['create', 'edit'])->each(function ($action) use ($path) {
            if (!$this->files->exists($path . '/' . $action.'.blade.php')) {
                $stub = $this->getStubs($action);
                switch ($action) {
                    case 'edit':
                        $content = $this->getStubContents($stub, [
                            'CLASS_NAME_PLURAL' => Str::plural(Str::lower($this->className)),
                            'CLASS_NAME' => Str::lower($this->className),
                            'CONTENT' => $this->makeFieldsFormEdit()
                        ]);
                        $this->files->put($path . "/$action.blade.php", $content);
                        $this->generated = true;
                        break;
                    case 'create':
                        $content = $this->getStubContents($stub, [
                            'CLASS_NAME_PLURAL' => Str::plural(Str::lower($this->className)),
                            'CLASS_NAME' => Str::lower($this->className),
                            'CONTENT' => $this->makeFieldsFormCreate()
                        ]);
                        $this->files->put($path . "/$action.blade.php", $content);
                        $this->generated = true;
                        break;
                }
            }
        });
    }

    /**
     * Build the  content of the edit file
     * @return string
     */
    private function makeFieldsFormCreate(): string
    {
        $columns = $this->getColumns();

        return collect($columns)->map(function ($type, $name) {
            $label = Str::of($name)->replace('_', ' ')->lower()->ucFirst();

            return match ($type) {
                'string' => "<x-forms.input type='text' label='$label' id='$name' name='$name' value=\"{{ old('$name') }}\"></x-forms.input>",
                'text' => "<x-forms.text-area type='text' label='$label' id='$name' name='$name'>{{old('$name') }}</x-forms.text-area>",
                'date' => "<x-forms.input type='date' label='$label' id='$name' name='$name' value=\"{{ old('$name') }}\"></x-forms.input>",
                'integer' => "<x-forms.input type='number' label='$label' id='$name' name='$name' value=\"{{ old('$name') }}\"></x-forms.input>",
                $this->isForeignKey($name, $type) => "<x-forms.select name='" . Str::camel($name) . "' ></x-forms.select>",
                default => null,
            };
        })->filter(fn ($item) => $item !== null)->implode("\n");
    }

    /**
     * Build the  content of the edit file
     * @return string
     */
    private function makeFieldsFormEdit()
    {
        $columns = $this->getColumns();
        $classNameLower = Str::lower($this->className);

        $fields = collect($columns)->map(function ($type, $name) use ($classNameLower) {
            $label = Str::of($name)->replace('_', ' ')->lower()->ucFirst();

            return match ($type) {
                'string' => "<x-forms.input type='text' label='$label' id='$name' name='$name' value=\"{{ old('$name', $$classNameLower->$name) }}\"></x-forms.input>",
                'text' => "<x-forms.text-area type='text' label='$label' id='$name' name='$name'>{{old('$name', $$classNameLower->$name) }}</x-forms.text-area>",
                'date' => "<x-forms.input type='date' label='$label' id='$name' name='$name' value=\"{{ old('$name', $$classNameLower->$name) }}\"></x-forms.input>",
                'integer' => "<x-forms.input type='number' label='$label' id='$name' name='$name' value=\"{{ old('$name', $$classNameLower->$name) }}\"></x-forms.input>",
                $this->isForeignKey($name, $type) => "<x-forms.select name='" . Str::camel($name) . "' ></x-forms.select>",
                default => null,
            };
        })->filter(fn ($item) => $item !== null)->implode("\n");

        return $fields;
    }

    /**
     * if the name field contain _id, we return the type of field for matched the match
     * @param $name
     * @param $type
     * @return false
     */
    private function isForeignKey($name, $type)
    {
        if (Str::contains($name, '_id')) {
            return $type;
        }

        return false;
    }
}
