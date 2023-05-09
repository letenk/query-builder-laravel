<?php

namespace App\QueryBuilder;

class QueryBuilder{
    protected $table;
    protected $select = "*";
    protected $where = [];
    protected $orderBy = [];
    protected $offset;
    protected $limit;

    /**
     * @param $table
     */
    public function __construct($table)
    {
        $this->table = $table;
    }

    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    public function where($variable, $operator, $value)
    {
        $this->where[] = [$variable, $operator, $value];
        return $this;
    }

    public function orderBy($variable, $order = 'asc')
    {
        $this->orderBy[] = [$variable, $order];
        return $this;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function get()
    {
        $query = "SELECT {$this->select} FROM {$this->table}";

        if(!empty($this->where)){
            $query .= ' WHERE ';
            $condition = [];

            foreach ($this->where as $where){
                $condition[] .= "{$where[0]} {$where[1]} {$where[2]}";
            }

            $query .= implode(" AND ", $condition);
        }

        if(!empty($this->orderBy)){
            $query .= ' ORDER BY ';
            $condition = [];

            foreach ($this->orderBy as $orderBy){
                $condition[] .= "{$orderBy[0]} {$orderBy[1]}";
            }

            $query .= implode(", ", $condition);
        }

        if($this->offset){
            $query .= " OFFSET {$this->offset}";
        }

        if($this->limit){
            $query .= " LIMIT {$this->limit}";
        }

        return $query;
    }
}
