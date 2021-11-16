<?php

namespace App\View\Components\Forms;

use Illuminate\Support\Facades\Config;

class Input extends AbstractForm
{

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $placeholder;

    /**
     *
     * @var string
     */
    public $addGroupClass;

    public function __construct(
        $label = null,
        $name = null,
        $id = null,
        $type = 'text',
        $value = '',
        $placeholder = '',
        $isInputGroup = true,
        $isPrepend = true,
        $isAppend = false,
        $class = 'form-control',
        $addClass = '',
        $addGroupClass = ''
    )
    {
        parent::__construct(
            $label,
            $name,
            $id,
            $type,
            $value,
            $placeholder,
            $isInputGroup,
            $isPrepend,
            $isAppend,
            $class,
            $addClass,
            $addGroupClass
        );
    }

    /**
     * Set the size of the form sm | lg
     */
    protected function sizingForm()
    {
        if ($this->class === 'form-control') {
            $sizing = Config::get('components.sizing-form');
            if ($sizing !== '') {
                $this->addClass = $this->addClass . ' form-control-' . $sizing;
                $this->addGroupClass = $this->addGroupClass . ' input-group-' . $sizing;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
