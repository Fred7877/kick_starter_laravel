<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class RemoveBtn extends Component
{
    use LivewireAlert;

    public $modelId;
    public $modelIdToRemove;
    public $modelType;
    public $routeRedirect;

    protected $listeners = ['confirmed'];

    public function confirmed()
    {
        if ($this->modelIdToRemove === $this->modelId) {
            $this->modelType::find($this->modelIdToRemove)->delete();

            $this->alert('success', 'l\'utilisateur a bien été supprimé.', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);

            $this->redirect($this->routeRedirect);
        }
    }

    public function remove($id)
    {
        $this->modelIdToRemove = $id;

        $this->confirm('Voulez-vous supprimer cette utilisateur ?', [
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
