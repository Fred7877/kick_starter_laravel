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

    protected $listeners = ['confirmed'];

    public function confirmed()
    {
        if ($this->modelIdToRemove === $this->modelId) {
            $model = $this->modelType::find($this->modelIdToRemove);

            if($this->checking($model)) {
                $this->alert('error', $this->messageModalError, [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);

            } else {
                $model->delete();

                $this->alert('success', $this->messageModalSuccess, [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }
            $this->redirect($this->routeRedirect);
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
        if($model instanceof User) {
            return $model->isAdministrator();
        }

        return User::role($model->name)->get()->isNotEmpty();
    }

    public function remove($id)
    {
        $this->modelIdToRemove = $id;

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
