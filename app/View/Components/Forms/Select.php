<?php

namespace App\View\Components\Forms;

use Exception;
use Illuminate\Support\Facades\Config;

class Select extends AbstractForm
{

    public $options = [];
    public $nonSelectedListLabel;
    public $selectedListLabel;
    public $preserveSelectionOnMove;
    public $moveAllLabel;
    public $removeAllLabel;
    public $isDualList;
    public $comparingModel;
    public $size;
    public $multiple;
    public $isSelect2;
    public $placeholder;
    public $methodComparing;

    /**
     * Create a new component instance.
     *
     * @return void
     * @throws Exception
     */
    public function __construct(
        $options = [],
        $label = null,
        $name = null,
        $id = null,
        $isInputGroup = true,
        $isPrepend = true,
        $isAppend = false,
        $class = 'form-control',
        $addClass = '',
        $addGroupClass = '',
        $nonSelectedListLabel = null,
        $selectedListLabel = null,
        $preserveSelectionOnMove = 'moved',
        $moveAllLabel = null,
        $removeAllLabel = null,
        $isDualList = false,
        $comparingModel = null,
        $multiple = false,
        $isSelect2 = false,
        $size = 10,
        $placeholder = null,
        $methodComparing = null
    )
    {
        parent::__construct(
            $label,
            $name,
            $id,
            null,
            null,
            null,
            $isInputGroup,
            $isPrepend,
            $isAppend,
            $class,
            $addClass,
            $addGroupClass
        );

        $this->options = $options;
        $this->nonSelectedListLabel = $nonSelectedListLabel;
        $this->selectedListLabel = $selectedListLabel;
        $this->preserveSelectionOnMove = $preserveSelectionOnMove;
        $this->moveAllLabel = $moveAllLabel;
        $this->removeAllLabel = $removeAllLabel;
        $this->isDualList = filter_var($isDualList, FILTER_VALIDATE_BOOLEAN);
        $this->isSelect2 = filter_var($isSelect2, FILTER_VALIDATE_BOOLEAN);
        $this->size = $size;
        $this->placeholder = $placeholder;

        if($this->isDualList) {
            $this->isInputGroup = false;
            $this->size = $size === 10 ? 200 : $size;
        }

        if($isSelect2) {
            $this->isInputGroup = false;
        }

        $this->comparingModel = $comparingModel;
        $this->multiple = $multiple;

        $this->methodComparing = $methodComparing;

        $this->mandatoryFields();
    }

    /**
     * @throws Exception
     */
    private function mandatoryFields()
    {
        if($this->isDualList) {
            if($this->moveAllLabel === null) {
                throw new Exception('l\'attribut moveAllLabel est obligatoire.');
            }

            if($this->removeAllLabel === null) {
                throw new Exception('l\'attribut removeAllLabel est obligatoire.');
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
        return view('components.forms.select');
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
