# data-table-handler
Manages the back end operations for data table version 1.10+

**Basic Usage**


```
$dataTable = new DataTable($request, $dataTableQueryManager);

$dataTableResponse = json_encode($dataTable->getResults());
```

The first argument passed will be the whole post/get payload containing the dataTable request and the second argument contains a dataTableQueryManager service which implements the DataTableQueryManagerInterface. 


```
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
```

The DataTable class will use the above interface to query and set the dataTable results using the **`queryData`** method making the query manager totally abstract.

Regardless if querying data from an API, Database, ORM etc it's irrelevant to the dataTable class as long as your passing back an array or results from the **`queryData`** method this will be handled seamlessly. 
