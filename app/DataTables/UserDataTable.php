<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('d/m/Y h:i');
            })
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at->format('d/m/Y h:i');
            })
            ->addColumn('actions', function ($model) {
                return view('layouts.datatable-actions-btn', [
                    'route' => route('users.edit', $model),
                    'modelId' => $model->id,
                    'modelType' => get_class($model),
                    'messageModalSuccess' => __('common.success_deleting_user'),
                    'messageModalError' => __('common.error_deleting_user'),
                    'messageModalAsk' => __('common.ask_remove_user'),
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->addTableClass('table-striped table-bordered')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->language('//cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json')
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )->parameters([ // this to refresh and activate actions in livewire components after drawing the table
                'drawCallback' => 'function(settings) {
                    if (window.livewire) {
                        window.livewire.rescan();
                    }
                }',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('actions')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
