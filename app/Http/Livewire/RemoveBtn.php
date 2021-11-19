<?php

namespace App\Http\Livewire;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RemoveBtn extends Component
{
    use LivewireAlert;

    public $modelId;
    public $modelIdToRemove;
    public $modelType;
    public $routeRedirect;
    public $messageModalAsk;
    public $messageModalSuccess;
    public $messageModalError;

    protected $listeners = ['confirmed','remove'];

    public function confirmed($data)
    {
        if ($this->modelIdToRemove !== null) {
            $model = $this->modelType::find($this->modelIdToRemove);
            $model->delete();

            $this->flash('success', $this->messageModalSuccess, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ], $this->routeRedirect);
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
        if ($model instanceof User) {
            return $model->isAdministrator();
        }

        return User::role($model->name)->get()->isNotEmpty();
    }

    public function remove()
    {
       $this->modelIdToRemove = $this->modelId;

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
