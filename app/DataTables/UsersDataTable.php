<?php

namespace App\DataTables;

use App\Models\User;
use App\Helpers\RoleHelper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return EloquentDataTable
     * @throws Exception
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($query) {
                return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input user_checkbox" id="checkbox' . $query->id . '" name="user_checkbox[]" value="' . $query->id . '"><label class="custom-control-label" for="checkbox' . $query->id . '"></label>
                </div>';
            })
            ->addColumn('roles', function ($query) {
                foreach ($query->getRoleNames() as $role) {
                    $roles[] = "<span class='badge text-bg-success'>$role</span>";
                }
                return implode(' ', $roles);
            })
            ->addColumn('active', function ($query) {
                return "<span class='badge text-bg-success'>" . __('button.active') . "</span>";
            })
            ->addColumn('action', function ($query) {
                $action = [
                    'table' => 'user-table',
                    'model' => $query,
                ];

                /** @var object User */
                $currentUser = Auth::user();

                if ($currentUser->hasRole('super-admin')) {
                    if (!$query->hasRole('super-admin')) {
                        $action['del_url'] = route('user.destroy', $query->id);
                        $action['edit_url'] = route('user.edit', $query->id);
                    }
                } elseif ($currentUser->hasRole(['admin'])) {
                    if (!$query->hasRole('super-admin') or Auth::id() == $query->id) {
                        $action['del_url'] = route('user.destroy', $query->id);
                        $action['edit_url'] = route('user.edit', $query->id);
                    }
                } else {
                    if (!$query->hasRole('super-admin') or !$query->hasRole('admin') or Auth::id() == $query->id) {
                        $action['del_url'] = route('user.destroy', $query->id);
                        $action['edit_url'] = route('user.edit', $query->id);
                    }
                }
                return view('backend.users._action', $action);
            })
            ->rawColumns(['roles', 'checkbox', 'active']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return QueryBuilder
     */
    public function query(User $model): QueryBuilder
    {
        $roles = RoleHelper::showRoles();

        /** @var object User */
        $currentUser = Auth::user();

        return $currentUser->hasRole('super-admin') ?
            $model->with('roles')->latest()->newQuery() :
            $model->role($roles)->with('roles')->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
            ->orderBy(1)
            ->orders([])
            ->buttons(
                Button::make('add'),
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                // Button::make('reset'),
                Button::make('reload'),
            )
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,

                'drawCallback' => 'function() {
                    "use strict";

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        deleteData(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "user-table";
                        let selectClass = "user_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on("click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".user_checkbox").prop("checked",true);
                        } else {
                            $(".user_checkbox").prop("checked",false);
                        }
                    })
                }'
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('checkbox')
                ->title('<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="selectAll"><label class="custom-control-label" for="selectAll"></label></div>')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="' . route('users.mass.destroy') . '">' . __('button.delete') . '</button>')
                ->titleAttr('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('name')->title(__('table.name'))
                ->orderable(false),
            Column::make('roles')->title(__('table.roles'))
                ->orderable(false),
            Column::make('active')->title(__('table.status'))
                ->orderable(false),
            Column::computed('action')->title(__('table.action'))
                ->addClass('text-center')
                ->width(60),
        ];
    }

    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
