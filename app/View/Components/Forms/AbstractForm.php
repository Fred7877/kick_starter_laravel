<?php


namespace App\View\Components\Forms;

use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

abstract class AbstractForm extends Component
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
     *
     * @var boolean
     */
    public $row;

    /**
     *
     * @var boolean
     */
    public $disabled;

    /**
     * @var string
     */
    public $classLabel;

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
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->id = $id;
        $this->placeholder = $placeholder;
        $this->addClass = $addClass;
        $this->addGroupClass = $addGroupClass;
        $this->disabled = $disabled;

        if ($isInputGroup !== null) {
            $this->isInputGroup = filter_var($isInputGroup, FILTER_VALIDATE_BOOLEAN);
        } else {
            $this->isInputGroup = Config::get('kick-starter.styles.components.input.isInputGroup');
        }

        if(!$this->isInputGroup) {
            if ($row !== null) {
                $this->row = $row;
            } else {
                $this->row = Config::get('kick-starter.styles.components.input.row');
            }
        } else {
            $this->row = $row;
        }

        if ($isPrepend !== null) {
            $this->isPrepend = filter_var($isPrepend, FILTER_VALIDATE_BOOLEAN);
        } else {
            $this->isPrepend = Config::get('kick-starter.styles.components.input.isPrepend');
        }

        if ($isAppend !== null) {
            $this->isAppend = filter_var($isAppend, FILTER_VALIDATE_BOOLEAN);
        } else {
            $this->isAppend = Config::get('kick-starter.styles.components.input.isAppend');
        }

        if ($class !== '') {
            $this->class = $class;
        } else {
            $this->class = Config::get('kick-starter.styles.components.input.class');
        }

        if ($classLabel !== null) {
            $this->classLabel = $classLabel;
        } else {
            $this->classLabel = Config::get('kick-starter.styles.components.input.classLabel');
        }

        $this->sizingForm();
    }

    public function render()
    {
    }

    protected abstract function sizingForm();

}
