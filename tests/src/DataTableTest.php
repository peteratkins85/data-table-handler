<?php

use \PHPUnit\Framework\TestCase;
use \ShinraCoder\DataTableHandler\DataTable;

class DataTableTest extends TestCase
{
    /**
     * @var array
     */
    private $dataTableRequest;

    /**
     * @var DataTable
     */
    private $dataTable;

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
                            'data'       => '',
                            'name'       => '',
                            'searchable' => 'false',
                            'orderable'  => 'true',
                            'search'     =>
                                [
                                    'value' => '',
                                    'regex' => 'false',
                                ],
                        ],
                    1 =>
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
                    2 =>
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
                    3 =>
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
                    4 =>
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
                    5 =>
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
            'start'   => '10',
            'length'  => '15',
            'search'  =>
                [
                    'value' => 'testFirstName',
                    'regex' => 'false',
                ],
        ];

        $this->dataTable = new DataTable($this->dataTableRequest, $dataTableQueryManager);
    }

    public function testGetDraw()
    {
        $this->assertEquals('3', $this->dataTable->getDraw());
    }

    public function testGetStart()
    {
        $this->assertEquals('10', $this->dataTable->getStart());
    }

    public function testGetLength()
    {
        $this->assertEquals('15', $this->dataTable->getLength());
    }

    public function testGetSearch()
    {
        $this->assertEquals('testFirstName', $this->dataTable->getSearch());
    }

    public function testGetColumns()
    {
        $this->assertArraySubset($this->dataTableRequest['columns'], $this->dataTable->getColumns());
    }

    public function testGetFields()
    {
        $this->assertEquals('firstName', $this->dataTable->getFields()[1]['data']);
        $this->assertEquals('lastName', $this->dataTable->getFields()[2]['data']);
        $this->assertEquals('email', $this->dataTable->getFields()[3]['data']);
        $this->assertEquals('phoneNumber', $this->dataTable->getFields()[4]['data']);
        $this->assertEquals('mobileNumber', $this->dataTable->getFields()[5]['data']);
    }
}

