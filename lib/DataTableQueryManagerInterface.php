<?php

namespace ShinraCoder\DataTableHandler;

/**
 * Interface DataTableQueryManagerInterface
 * @package ShinraCoder\DataTableHandler
 */
interface DataTableQueryManagerInterface
{
    /**
     * Expected multidimensional array row results e.g.
     * [
     *      [
     *          'field1',
     *          'field2',
     *          'field3,
     *      ]
     * ]
     * @param DataTable $dataTable
     * @return mixed
     */
    public function queryData(DataTable $dataTable);

    /**
     * The DataTable class will use this method to set
     * its property "RecordsTotal"
     * @return mixed
     */
    public function getResultTotal();

    /**
     * The DataTable class will use this method to set
     * its property "RecordsFiltered"
     * @return mixed
     */
    public function getFilteredResultTotal();
}
