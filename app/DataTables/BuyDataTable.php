<?php

namespace App\DataTables;

use App\Models\Buy;
use App\Services\DataTablesDefaults;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Datatables;
use Request;
use DB;

class BuyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        if(Request::is('*not-delivered*')){
            $buys = Buy::select(
                "buys.*",
                DB::raw("(
                    SELECT users.name
                    FROM users
                    WHERE buys.user_id = users.id
                ) as client_name"),
                DB::raw("DATE_FORMAT(buys.date,'%d/%m/%Y') as readable_date")
            )->where('is_delivered', false);
        }else{
            $buys = Buy::select(
                "buys.*",
                DB::raw("(
                    SELECT users.name
                    FROM users
                    WHERE buys.user_id = users.id
                ) as client_name"),
                DB::raw("DATE_FORMAT(buys.date,'%d/%m/%Y') as readable_date")
            )->where('is_delivered', true);
        }

        return DataTables::of($buys)
            ->filterColumn('client_name', function($query, $keyword){
                $query->whereRaw("(
                    SELECT users.name
                    FROM users
                    WHERE buys.user_id = users.id
                ) like ?", ["%{$keyword}%"]);
            })
            ->editColumn("total_value", function ($buy) {
                $formated = "R$ " . number_format($buy->total_value, 2, ',', '.');
                return $formated;
            })
            ->filterColumn('readable_date', function($query, $keyword){
                $query->whereRaw("
                    DATE_FORMAT(buys.date,'%d/%m/%Y')
                like ?", ["%{$keyword}%"]);
            })
            ->addColumn("action", "buys.datatables_actions")
            ->rawColumns(["action", "client_name"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Buy $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Buy $model)
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
            "readable_date" => ["date" => "readable_date", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.date")],
            "client_name" => ["name" => "client_name", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.cliente")],
            "total_value" => ["date" => "total_value", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.total_value")],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'buysdatatable_' . time();
    }
}
