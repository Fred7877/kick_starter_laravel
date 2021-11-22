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
        $isInputGroup = null,
        $isPrepend = null,
        $isAppend = null,
        $class = '',
        $addClass = '',
        $addGroupClass = '',
        $row = null,
        $classLabel = null,
        $disabled = false
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
            $addGroupClass,
            $row,
            $classLabel,
            $disabled
        );

        // don't group field if is an hidden input
        if ($this->type === 'hidden') {
            $this->isInputGroup = false;
        }

        if ($this->type === 'radio' || $this->type ===  'checkbox') {
            $this->isInputGroup = false;
            $this->class = 'form-check-input';
            $this->classLabel = 'form-check-label';
            $this->addClass = '';
        }
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
