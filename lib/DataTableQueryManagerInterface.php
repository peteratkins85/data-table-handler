<?php

namespace ShinraCoder\DataTableHandler;

interface DataTableQueryManagerInterface
{
    public function queryData(DataTable $dataTable);

    public function getResultTotal();

    public function getFilteredResultTotal();
}
