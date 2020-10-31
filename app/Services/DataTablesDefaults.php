<?php

namespace App\Services;

class DataTablesDefaults
{
    public static function getParameters($params = [])
    {
        $defaults =  [
            'language' => [
                'paginate' => [
                    'next'       => \Lang::get('datatable.next'),
                    'previous'   => \Lang::get('datatable.previous')
                ],
                'buttons' => [
                    'print'      => \Lang::get('datatable.print'),
                    'reload'     => \Lang::get('datatable.reload'),
                    'csv'        => \Lang::get('datatable.csv'),
                    'colvis'     => \Lang::get('datatable.colvis'),
                    'pageLength' => \Lang::get('datatable.page_length')
                ],
                'search'         => \Lang::get('datatable.search'),
                'emptyTable'     => \Lang::get('datatable.empty_table'),
                'info'           => \Lang::get('datatable.info'),
                'infoEmpty'      => \Lang::get('datatable.info_empty'),
                'infoFiltered'   => \Lang::get('datatable.info_filtered'),
                'loadingRecords' => \Lang::get('datatable.loading_records'),
                'processing'     => \Lang::get('datatable.processing'),
                'zeroRecords'    => \Lang::get('datatable.zero_records')
            ],
            'dom' => 'Bfrtip',
            'order' => [
                [0, 'asc']
            ],
            'pageLength' => 25,
            'scrollX' => true,
            'buttons' => [
                'print',
                'reload',
                'csv',
                'colvis',
                'pageLength'
            ]
        ];

        foreach($params as $key => $value) {
            $defaults[$key] = $value;
        }

        return $defaults;
    }
}
