<?php

namespace App\DataTables;

use App\Traits\UserTrait;
use App\Helpers\RoleHelper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RolesDataTable extends DataTable
{
    use UserTrait;

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($query) {
                return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input role_checkbox" id="checkbox' . $query->id . '" name="role_checkbox[]" value="' . $query->id . '"><label class="custom-control-label" for="checkbox' . $query->id . '"></label>
                </div>';
            })
            ->addColumn('action', function ($query) {
                $status = $this->getCheckRoleExcept($query->name);
                // $status = true;
                $delUrl = $status ? route('role.destroy', $query->id) : '#';
                return view('backend.roles._action', [
                    'table' => 'role-table',
                    'status' => $status,
                    'model' => $query,
                    'del_url' => $delUrl,
                    'edit_url' => route('role.edit', $query->id)
                ]);
            })
            ->rawColumns(['checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Role $model
     * @return QueryBuilder
     */
    public function query(Role $model): QueryBuilder
    {
        $roles = RoleHelper::showRoles();

        /** @var object User */
        $currentUser = Auth::user();

        return $currentUser->hasRole('super-admin') ?
            $model->latest()->newQuery() :
            $model->whereIn('name', $roles)->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return HtmlBuilder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('role-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
            ->orderBy(1)
            ->orders([])
            ->buttons([
                Button::make('add'),
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                // Button::make('reset'),
                Button::make('reload'),
            ])
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,

                'drawCallback' => 'function() {

                    $(".delete").click(function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        deleteData(table,url);
                    })

                    $("#bulk_delete").click(function() {
                        let url = $(this).data("url");
                        let table = "role-table";
                        let selectClass = "role_checkbox";
                        multiDelCheckbox(table,url,selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".role_checkbox").prop("checked",true);
                        } else {
                            $(".role_checkbox").prop("checked",false);
                        }
                    })
                }'
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('checkbox')
                ->title('<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="selectAll"><label class="custom-control-label" for="selectAll"></label></div>')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-sm btn-danger" data-url="' . route('roles.mass.destroy') . '"><i class="bi bi-trash3"></i></button>')
                ->titleAttr('')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('name')->title('Role')
                ->orderable(false),
            Column::make('guard_name')->title('Guard')
                ->orderable(false),
            Column::computed('action')->title('Action')
                ->addClass('text-center')
                ->width(60),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}
