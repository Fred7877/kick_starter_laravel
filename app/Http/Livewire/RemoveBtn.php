<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RemoveBtn extends Component
{
    use LivewireAlert;

    public $modelId;
    public $modelType;
    public $routeRedirect;
    public $messageModalAsk;
    public $messageModalSuccess;
    public $messageModalError;

    protected $listeners = ['remove', 'confirmed'];

    public function confirmed()
    {
        $model = $this->modelType::find($this->modelId);
        if ($this->checking($model)) {
            $model->delete();
            $this->flash('success', $this->messageModalSuccess, [], $this->routeRedirect);
        } else {
            $this->flash('error', $this->messageModalError, [], $this->routeRedirect);
        }
    }

    /**
     * Rules for checking if the model could be remove.
     *
     * @param $model
     * @return bool
     */
    private function checking($model)
    {
        $checking = true;
        if ($model instanceof User) {
            $checking = !$model->isAdministrator() && User::role($model->name)->get()->isEmpty();
        }

        return $checking;
    }

    public function remove()
    {
        $this->confirm($this->messageModalAsk, [
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'Oui',
            'cancelButtonText' => 'Non',
        ]);
    }

    public function render()
    {
        return view('livewire.remove-btn');
    }
}
