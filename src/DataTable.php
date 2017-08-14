<?php

namespace ShinraCoder\DataTableHandler;

/**
 * Class DataTable
 * @package ShinraCoder\DataTableHandler
 * @author peter.atkins85@gmail.com
 */
class DataTable
{
    /**
     * @var string
     */
    protected $search;

    /**
     * @var array
     */
    protected $order;

    /**
     * @var int
     */
    protected $length;

    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $draw;

    /**
     * @var array
     */
    protected $results = [
        'data'            => [],
        'recordsTotal'    => 0,
        'recordsFiltered' => 0,
        'draw'            => 1,
    ];

    /**
     * @var int
     */
    protected $recordsTotal = 0;

    /**
     * @var int
     */
    protected $recordsFiltered = 0;

    /**
     * @var array
     */
    protected $request;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @var array
     */
    protected $fields;

    protected $dataTableQueryManager;

    /**
     * DataTable constructor.
     * @param                                $request
     * @param DataTableQueryManagerInterface $dataTableQueryManager
     */
    public function __construct(array $request, DataTableQueryManagerInterface $dataTableQueryManager)
    {
        $this->init($request);
        $this->dataTableQueryManager = $dataTableQueryManager;
        $this->setResults($this->dataTableQueryManager->queryData($this));
    }

    /**
     * Init from query request
     *
     * @param $request
     */
    public function init($request)
    {
        if (!empty($request['search']['value'])) {
            $this->setSearch(trim($request['search']['value']));
        }

        if (array_key_exists('draw', $request)) {
            $this->setDraw((int) $request['draw']);
        }

        if (array_key_exists('columns', $request) && is_array($request['columns'])) {
            $this->setColumns($request['columns']);
        }

        if (array_key_exists('order', $request) && is_array($request['order'])) {
            foreach ($request['order'] as $order) {
                $this->addOrder($order);
            }
        }

        $this->setRequest($request)
            ->setStart(array_key_exists('start', $request) ? (int) $request['start'] : 0)
            ->setLength(array_key_exists('length', $request) ? (int) $request['length'] : 10);
    }

    /**
     * @param array $order
     * @return $this
     */
    public function addOrder(array $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns)
    {
        foreach ($columns as $key => $column) {
            $this->addColumn($column);

            if (isset($column['data']) && !empty($column['data'])) {
                $this->fields[$key] = $column;
            }
        }
    }

    /**
     * @param array $column
     * @return $this
     */
    public function addColumn(array $column)
    {
        $this->columns[] = $column;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    public function addField($field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return string
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param $results
     * @return $this
     */
    public function setResults($results)
    {
        $this->results = [
            'data'            => $results,
            'recordsTotal'    => $this->dataTableQueryManager->getResultTotal(),
            'recordsFiltered' => $this->dataTableQueryManager->getFilteredResultTotal(),
            'draw'            => $this->getDraw(),
        ];

        return $this;
    }

    /**
     * @return int
     */
    public function getRecordsTotal()
    {
        return $this->recordsTotal;
    }

    /**
     * @param int $recordsTotal
     * @return DataTable
     */
    public function setRecordsTotal($recordsTotal)
    {
        $this->recordsTotal = (int) $recordsTotal;

        return $this;
    }

    /**
     * @return int
     */
    public function getRecordsFiltered()
    {
        return $this->recordsFiltered;
    }

    /**
     * @param int $recordsFiltered
     * @return DataTable
     */
    public function setRecordsFiltered($recordsFiltered)
    {
        $this->recordsFiltered = (int) $recordsFiltered;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * @param mixed $orderBy
     * @return DataTable
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param string $order
     * @return DataTable
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param array $request
     * @return DataTable
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param string $search
     * @return DataTable
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @param int $length
     * @return DataTable
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @param int $start
     * @return DataTable
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @param int $draw
     * @return DataTable
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }
}
