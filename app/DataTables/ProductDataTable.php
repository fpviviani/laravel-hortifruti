<?php

namespace App\DataTables;

use App\Models\Product;
use App\Services\DataTablesDefaults;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Datatables;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $products = Product::select(
            "products.*"
        );
        return DataTables::of($products)
            ->editColumn("price", function ($product) {
                $formated = "R$ " . number_format($product->price, 2, ',', '.');
                return $formated;
            })
            ->addColumn("action", "products.datatables_actions")
            ->rawColumns(["action", "name"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', "title" => \Lang::get("datatable.action")])
            ->parameters(DataTablesDefaults::getParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            "name" => ["name" => "name", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.name")],
            "price" => ["name" => "price", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.price")],
            "stock" => ["name" => "stock", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.stock")],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'productsdatatable_' . time();
    }
}
