<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $model;
    public $columns = [];
    public $search = '';
    public $numberResult = 10;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['confirmRemove'];

    public function confirmRemove()
    {
        $this->alert('success', 'Bravo !', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        if($this->model instanceof Collection) {
            $this->model = get_class($this->model->first());
        }

        if ($this->columns === []) {
            $this->columns = Schema::getColumnListing(Str::plural(Str::lower(Str::afterLast($this->model, '\\'))));
        }
    }

    public function render()
    {
        $query = $this->model::query();
        foreach($this->columns as $column){
            $query->orWhere($column, 'LIKE', '%' . $this->search . '%');
        }

        return view('livewire.table', ['models' =>
            $query->paginate($this->numberResult)
        ]);
    }
}
