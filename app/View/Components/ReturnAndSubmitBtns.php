<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReturnAndSubmitBtns extends Component
{
    public $redirectPath;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($redirectPath)
    {
        $this->redirectPath = $redirectPath;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.return-and-submit-btns');
    }
}
