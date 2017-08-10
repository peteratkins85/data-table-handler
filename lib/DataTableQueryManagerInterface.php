<?php

namespace ShinraCoder\DataTableHandler;

/**
 * Interface DataTableQueryManagerInterface
 * @package ShinraCoder\DataTableHandler
 */
interface DataTableQueryManagerInterface
{
    /**
     * Expected multidimensional associative array results e.g.
     * [
     *      [
     *          'field1' => 'value1',
     *          'field2' => 'value2',
     *          'field3  => 'value3',
     *      ]
     * ]
     * @param DataTable $dataTable
     * @return mixed
     */
    public function queryData(DataTable $dataTable);

    /**
     * The DataTable class will uses this method to set
     * its property "RecordsTotal"
     * @return mixed
     */
    public function getResultTotal();

    /**
     * The DataTable class will uses this method to set
     * its property "RecordsFiltered"
     * @return mixed
     */
    public function getFilteredResultTotal();
}
