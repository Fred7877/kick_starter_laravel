<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleAndPermissionDataTable extends DataTable
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
            ->editColumn('name', function($model) {
                return view('admin.role-and-permission.parts.column-name', [
                    'name' => $model->name,
                    'permissions' => $model->getPermissionNames(),
                ]);
            })
            ->addColumn('actions', function ($model) {
                return view('layouts.datatable-actions-btn', [
                    'route' => route('roles-and-permissions.edit', $model->id),
                    'modelId' => $model->id,
                    'modelType' => get_class($model)
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
            ->setTableId('roles-and-permissions-table')
            ->addTableClass('table-striped table-bordered')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
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
            Column::make('actions'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_and_permissions_' . date('YmdHis');
    }
}
