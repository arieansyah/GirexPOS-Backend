<?php

namespace App\DataTables;

use App\Models\Backend\Master\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('image', function ($query) {
                // check if image type link or path from stroage
                return "<img class='img-thumbnail' style='width: 150px' src=" . $query->image . ">";
            })
            ->addColumn('action', function ($query) {
                return view('backend.master.categories._action', [
                    'table' => 'categories-table',
                    'model' => $query,
                    'del_url' => route('categories.destroy', $query->id),
                    'edit' => [
                        'id' => $query->id,
                        'name' => $query->name,
                        'description' => $query->description,
                        'image' => $query->image,
                    ]
                ]);
            })
            ->rawColumns(['image', 'checkbox']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'DESC');;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('categories-table')
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
            Column::make('image')->title(__('table.image'))
                ->orderable(false),
            Column::computed('action')->title(__('table.action'))
                ->addClass('text-center')
                ->width(60),
        ];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
