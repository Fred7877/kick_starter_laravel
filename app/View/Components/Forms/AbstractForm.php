<?php


namespace App\View\Components\Forms;

use Illuminate\View\Component;

Abstract class AbstractForm extends Component
{
    /**
     *
     * @var string
     */
    public $label;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $value;

    /**
     *
     * @var string
     */
    public $class;

    /**
     *
     * @var string
     */
    public $addClass;

    /**
     *
     * @var boolean
     */
    public $isInputGroup;

    /**
     *
     * @var boolean
     */
    public $isPrepend;

    /**
     *
     * @var boolean
     */
    public $isAppend;

    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->isInputGroup = filter_var($isInputGroup, FILTER_VALIDATE_BOOLEAN);
        $this->isPrepend = filter_var($isPrepend, FILTER_VALIDATE_BOOLEAN);
        $this->isAppend = filter_var($isAppend, FILTER_VALIDATE_BOOLEAN);
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->addClass = $addClass;
        $this->addGroupClass = $addGroupClass;

        // don't field group field is an hidden input
        if($this->type === 'hidden'){
            $this->isInputGroup = false;
        }

        $this->sizingForm();
    }

    public function render() {}
    protected abstract function sizingForm();

}
