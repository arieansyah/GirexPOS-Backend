<?php

namespace App\DataTables;

use App\Models\Backend\Master\Discount;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DiscountsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return(new EloquentDataTable($query))
            ->editColumn('value', function ($query) {
                return number_format($query->value);
            })
            ->editColumn('status', function ($query) {
                return $query->status ? '<span class="badge rounded-pill text-bg-primary">Active</span>' : '<span class="badge rounded-pill text-bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($query) {
                return view('backend.master.discounts._action', [
                    'table' => 'discounts-table',
                    'model' => $query,
                    'del_url' => route('discounts.destroy', $query->id),
                    'edit' => [
                        'id' => $query->id,
                        'name' => $query->name,
                        'description' => $query->description,
                        'type' => $query->type,
                        'value' => $query->value,
                        'status' => $query->status,
                        'expire_date' => $query->expire_date,
                    ]
                ]);
            })
            ->rawColumns(['value', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Discount $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('discounts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
            ->buttons(
                Button::make('reload'),
            )
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'serverSide' => true,

                'drawCallback' => 'function() {
                    "use strict";

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        deleteData(table, url);
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

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title(__('table.name'))
                ->orderable(false),
            Column::make('type')->title(__('table.type'))
                ->orderable(false),
            Column::make('value')->title(__('table.value'))
                ->orderable(false),
            Column::make('status')->title(__('table.status'))
                ->orderable(false),
            Column::make('expire_date')->title(__('table.expire_date'))
                ->orderable(false),
            Column::computed('action')->title(__('table.action'))
                ->addClass('text-center')
                ->width(60),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Discounts_' . date('YmdHis');
    }
}