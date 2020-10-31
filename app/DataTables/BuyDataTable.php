<?php

namespace App\DataTables;

use App\Models\Buy;
use App\Services\DataTablesDefaults;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

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
        if(Request::is('*delivered*')){
            $buys = Buy::select(
                "buys.*",
                DB::raw("(
                    SELECT users.name
                    FROM users
                    WHERE users.id = buys.user_id
                ) as client_name")
            )->where('is_delivered', true);
        }else{
            $buys = Buy::select(
                "buys.*",
                DB::raw("(
                    SELECT users.name
                    FROM users
                    WHERE users.id = buys.user_id
                ) as client_name")
            )->where('is_delivered', false);
        }

        return DataTables::of($buys)
            // ->editColumn("user_id", function ($debt) {
            //     $id = $debt->id;
            //     $url = route("debts.dashboard",[request()->client_id, $id]);
            //     return "<a href='{$url}'>{$id}</a>";
            // })
            ->filterColumn('user_id', function($query, $keyword){
                $query->whereRaw("(
                    SELECT users.name
                    FROM users
                    WHERE users.id = buys.user_id
                ) like ?", ["%{$keyword}%"]);
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
            ->addAction(['width' => '120px', "title" => \Lang::get("datatables.action")])
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
            "client_name" => ["name" => "user", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.cliente")],
            "total_value" => ["total_value" => "user", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.total_value")],
            "date" => ["date" => "user", "render" => "(data!=null)? ((data.length>180)? data.substr(0,180)+'...' : data) : '-'", "title" => \Lang::get("attributes.date")],
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
