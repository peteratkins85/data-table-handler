<?php
/**
 * Created by PhpStorm.
 * User: peter
 * Date: 12/08/2017
 * Time: 15:15
 */

namespace ShinraCoder\DataTableHandler;

use PDO;
use PDOStatement;


class PdoDataTableQueryManager extends DataTableQueryManager
{
    /**
     * @var PDO
     */
    protected $dbConnection;

    /**
     * @var string
     */
    protected $primeTable;

    /**
     * @var DataTable
     */
    protected $dataTable;

    /**
     * @var PDOStatement
     */
    protected $statement;

    /**
     * @var array
     */
    protected $searchedFields;

    /**
     * @var array
     */
    protected $queryParams = [];

    /**
     * @var string
     */
    private $where;

    /**
     * @var string
     */
    private $select;

    /**
     * @var string
     */
    private $join;

    /**
     * @var string
     */
    private $order;

    /**
     * @var string
     */
    private $limit;

    public function __construct(PDO $dbConnection, $primeTable)
    {
        $this->dbConnection = $dbConnection;
        $this->primeTable = $primeTable;
    }

    /**
     * @param DataTable $dataTable
     * @return mixed
     */
    public function queryData(DataTable $dataTable)
    {
        $this->dataTable = $dataTable;
        $this->fields = $dataTable->getFields();
        $this->select = $this->getSelectStatement();
        $this->where = $this->getWhereStatement();
        $this->join = $this->getJoinStatement();
        $this->order = $this->getOrderStatement();
        $this->limit = $this->getLimitStatement();
        $query = $this->buildQuery();

        $this->statement = $this->dbConnection->prepare($query);
        $params = $this->getParameters();

        $this->statement->execute($params);
        $this->statement->setFetchMode(PDO::FETCH_ASSOC);
        $results = $this->statement->fetchAll();
        $this->setMetaData($this->statement->rowCount());

        return $results;
    }


    public function getLimitStatement()
    {
        return ' LIMIT '. $this->dataTable->getStart() . ', ' . $this->dataTable->getLength();

    }

    /**
     * @return string
     */
    public function buildQuery()
    {
        return 'SELECT SQL_CALC_FOUND_ROWS  ' . $this->select . ' FROM ' . $this->primeTable . $this->join . $this->where . $this->order . $this->limit;
    }

    public function setMetaData()
    {
        if ($this->where) {
            $query = 'SELECT count(*) FROM ' . $this->primeTable . $this->join;
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            $this->setResultTotal($statement->fetchColumn());

            $query = 'SELECT count(*) FROM ' . $this->primeTable . $this->join . $this->where;
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            $this->setFilteredResultTotal($statement->fetchColumn());
        } else {
            $query = 'SELECT count(*) FROM ' . $this->primeTable . $this->join;
            $statement = $this->dbConnection->prepare($query);
            $statement->execute();
            $total = $statement->fetchColumn();
            $this->setResultTotal($total);
            $this->setFilteredResultTotal($total);
        }

    }

    /**
     * @return string
     */
    public function getSelectStatement()
    {
        $fields = $this->dataTable->getFields();
        $selectQuery = '';
        $i = 0;

        foreach ($fields as $key => $field) {
            $separator = $i > 0 ? ', ' : null;
            $selectQuery .= $separator . trim($field['data']);
            $i++;
        }

        return $selectQuery;
    }

    /**
     * @return null|string
     */
    public function getWhereStatement()
    {
        $whereStatement = null;
        $operator = ' AND ';
        $i = 0;

        foreach ($this->fields as $key => &$field) {
            if (!empty($field['search']['value'])) {
                $whereStatement = $whereStatement ?: ' WHERE 1 ';
                $this->searchedFields[$key] = true;
                $whereStatement .= $operator . $field['data'] . ' LIKE ? ';
                $i++;
            }
        }

        return $whereStatement;
    }

    /**
     * @return mixed
     */
    public function getJoinStatement()
    {
        return null;
    }

    /**
     * @return null|string
     */
    public function getOrderStatement()
    {
        $orderStatement = null;
        $columns = $this->dataTable->getColumns();

        foreach ($this->dataTable->getOrder() as $order) {
            if (!empty($order['column'])) {
                $orderStatement = $orderStatement ?: ' ORDER BY ';
                $orderStatement .= ' ' . $columns[$order['column']]['data'] . ' ' . $order['dir'];
            }
        }

        return $orderStatement;
    }

    /***
     * @return array|null
     */
    public function getParameters()
    {
        $parameters = null;

        foreach ($this->fields as $key => $field) {
            if (isset($this->searchedFields[$key])) {
                $parameters[] = '%' . $field['search']['value'] . '%';
            }
        }

        return $parameters;
    }
}