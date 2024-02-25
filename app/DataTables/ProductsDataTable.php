<?php

namespace App\DataTables;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('category', function ($query) {
                return $query->category()->first()->name;
            })
            ->editColumn('price', function ($query) {
                return 'Rp. '. number_format($query->price);
            })
            ->editColumn('status', function ($query) {
                return $query->status == 1 ? '<span class="badge rounded-pill text-bg-primary">Active</span>' : '<span class="badge rounded-pill text-bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($query) {
                return view('backend.products._action', [
                    'table' => 'products-table',
                    'model' => $query,
                    'del_url' => route('products.destroy', $query->id),
                    'edit' => [
                        'id' => $query->id,
                        'name' => $query->name,
                        'price' => $query->price,
                        'stock' => $query->stock,
                        'status' => $query->status,
                        'category_id' => $query->category_id,
                        'is_favorite' => $query->is_favorite,
                        'description' => $query->description,
                        'image' => $query->image,
                    ]
                ]);
            })
            ->rawColumns(['category', 'status', 'price']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery()->with('category')->orderBy('id', 'DESC');
        ;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('products-table')
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
            Column::make('category')->title(__('table.category'))
                ->orderable(false),
            Column::make('price')->title(__('table.price'))
                ->orderable(false),
            Column::make('status')->title(__('table.status'))
                ->orderable(false),
            Column::computed('action')->title(__('table.action'))
                ->addClass('text-center')
                ->width(60),
        ];
    }

    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
