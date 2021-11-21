<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Facades\Config;

class TextArea extends AbstractForm
{

    /**
     * @var int|mixed
     */
    public $rows = 5;

    /**
     * @var int|mixed
     */
    public $cols = 5;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $label = null,
        $name = null,
        $id = null,
        $class = 'form-control',
        $addClass = '',
        $addGroupClass = '',
        $rows = 5,
        $cols = 5,
    )
    {
        parent::__construct(
            $label,
            $name,
            $id,
            null,
            null,
            null,
            null,
            null,
            null,
            $class,
            $addClass,
            $addGroupClass
        );

        $this->rows = $rows;
        $this->cols = $cols;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.text-area');
    }

    public function sizingForm()
    {
        if ($this->class === 'form-control') {
            $sizing = Config::get('components.sizing-form');
            if ($sizing !== '') {
                $this->addClass = $this->addClass . ' form-control-' . $sizing;
            }
        }
    }
}
