<?php

use \PHPUnit\Framework\TestCase;
use \ShinraCoder\DataTableHandler\DataTable;

class DataTableTest extends TestCase
{
    /**
     * @var array
     */
    private $dataTableRequest;

    public function setUp()
    {

        $dataTableQueryManager = $this->getMockBuilder(\ShinraCoder\DataTableHandler\PdoDataTableQueryManager::class)
            ->setMethods(['queryData'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->dataTableRequest = [
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

        $dataTable = new DataTable($dataTableRequest, $dataTableQueryManager);
    }

    public function testGetColumns()
    {
        assert()
    }

}

