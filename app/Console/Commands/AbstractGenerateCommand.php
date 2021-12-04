<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

abstract class AbstractGenerateCommand extends Command
{
    /**
     * @var string $className
     */
    protected $className;

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getColumns()
    {
        $className = Str::plural(Str::lower($this->className));

        return collect(Schema::getColumnListing($className))->flatMap(function ($column) use ($className) {
            return [$column => Schema::getColumnType($className, $column)];
        });
    }

    /**
     * Return the stub file path
     * @return string
     *
     */
    protected function getStubs($stubName)
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
    protected function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;

    }
}
