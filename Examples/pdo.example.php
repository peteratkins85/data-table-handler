<?php

require '../vendor/autoload.php';

use ShinraCoder\DataTableHandler\PdoDataTableQueryManager;

$dbConnect = new PDO('mysql:host=localhost;dbname=dataTable', 'root', '');

$dataTableQueryManager = new PdoDataTableQueryManager($dbConnect, 'testTable');

$request = [
    'draw'    => '3',
    'columns' =>
        [
            0 =>
                [
                    'data'       => 'firstName',
                    'name'       => '',
                    'searchable' => 'true',
                    'orderable'  => 'true',
                    'search'     =>
                        [
                            'value' => '',
                            'regex' => 'false',
                        ],
                ],
            1 =>
                [
                    'data'       => 'lastName',
                    'name'       => '',
                    'searchable' => 'true',
                    'orderable'  => 'true',
                    'search'     =>
                        [
                            'value' => '',
                            'regex' => 'false',
                        ],
                ],
            2 =>
                [
                    'data'       => 'email',
                    'name'       => '',
                    'searchable' => 'true',
                    'orderable'  => 'true',
                    'search'     =>
                        [
                            'value' => '',
                            'regex' => 'false',
                        ],
                ],
            3 =>
                [
                    'data'       => 'phoneNumber',
                    'name'       => '',
                    'searchable' => 'true',
                    'orderable'  => 'true',
                    'search'     =>
                        [
                            'value' => '',
                            'regex' => 'false',
                        ],
                ],
            4 =>
                [
                    'data'       => 'mobileNumber',
                    'name'       => '',
                    'searchable' => 'true',
                    'orderable'  => 'true',
                    'search'     =>
                        [
                            'value' => '',
                            'regex' => 'false',
                        ],
                ],
        ],
    'order'   =>
        [
            0 =>
                [
                    'column' => '2',
                    'dir'    => 'asc',
                ],
        ],
    'start'   => '0',
    'length'  => '2',
    'search'  =>
        [
            'value' => '',
            'regex' => 'false',
        ],
];

$legacyRequest = array (
    'sEcho' => '1',
    'iColumns' => '5',
    'sColumns' => '',
    'iDisplayStart' => '0',
    'iDisplayLength' => '10',
    'mDataProp_0' => '0',
    'mDataProp_1' => '1',
    'mDataProp_2' => '2',
    'mDataProp_3' => '3',
    'mDataProp_4' => '4',
    'mDataProp_5' => '5',
    'mDataProp_6' => '6',
    'mDataProp_7' => '7',
    'sSearch' => '',
    'bRegex' => 'false',
    'sSearch_0' => '',
    'bRegex_0' => 'false',
    'bSearchable_0' => 'true',
    'sSearch_1' => '',
    'bRegex_1' => 'false',
    'bSearchable_1' => 'true',
    'sSearch_2' => '',
    'bRegex_2' => 'false',
    'bSearchable_2' => 'true',
    'sSearch_3' => '',
    'bRegex_3' => 'false',
    'bSearchable_3' => 'true',
    'sSearch_4' => '',
    'bRegex_4' => 'false',
    'bSearchable_4' => 'true',
    'sSearch_5' => '',
    'bRegex_5' => 'false',
    'bSearchable_5' => 'true',
    'sSearch_6' => '',
    'bRegex_6' => 'false',
    'bSearchable_6' => 'true',
    'sSearch_7' => '',
    'bRegex_7' => 'false',
    'bSearchable_7' => 'true',
    'iSortCol_0' => '0',
    'sSortDir_0' => 'asc',
    'iSortingCols' => '1',
    'bSortable_0' => 'false',
    'bSortable_1' => 'true',
    'bSortable_2' => 'true',
    'bSortable_3' => 'false',
    'bSortable_4' => 'false',
    'bSortable_5' => 'false',
    'bSortable_6' => 'false',
    'bSortable_7' => 'false',
    'campaignName' => 'dsfd',
    '_' => '1502643494660',
);

$dataTable = new \ShinraCoder\DataTableHandler\DataTable($request, $dataTableQueryManager);

echo json_encode($dataTable->getResults());

