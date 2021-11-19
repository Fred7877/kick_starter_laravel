<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class Banane extends DataTable
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
            ->addColumn('actions', function ($model) {
                return view('layouts.datatable-actions-btn', [
                    'route' => route('Bananes.edit', $model->id),
                    'modelId' => $model->id,
                    'modelType' => get_class($model),
                    'messageModalSuccess' => __('common.success_deleting_role'),
                    'messageModalError' => __('common.error_deleting_role'),
                    'messageModalAsk' => __('common.ask_remove_role'),
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Banane $model)
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
            ->setTableId('bananes-table')
            ->addTableClass('table-striped table-bordered')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([ // this to refresh and activate actions in livewire components after drawing the table
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

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Banane_' . date('YmdHis');
    }
}
