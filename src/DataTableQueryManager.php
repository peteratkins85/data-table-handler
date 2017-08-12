<?php

namespace ShinraCoder\DataTableHandler;

/**
 * Class DataTableQueryManager
 * @package ShinraCoder\DataTableHandler
 * @author Peter Atkins <peter.atkins85@gmail.com>
 */
abstract class DataTableQueryManager implements DataTableQueryManagerInterface
{
    /**
     * @var int
     */
    protected $resultTotal;

    /**
     * @var int
     */
    protected $filteredResultTotal;

    public function getFilteredResultTotal()
    {
        return $this->filteredResultTotal;
    }

    public function getResultTotal()
    {
        return $this->resultTotal;
    }

    public function setFilteredResultTotal($filteredResultTotal)
    {
        $this->filteredResultTotal = $filteredResultTotal;

        return $this;
    }

    public function setResultTotal($resultTotal)
    {
        $this->resultTotal = $resultTotal;

        return $this;
    }

    /**
     * @param DataTable $dataTable
     * @return mixed
     */
    abstract public function queryData(DataTable $dataTable);
}
