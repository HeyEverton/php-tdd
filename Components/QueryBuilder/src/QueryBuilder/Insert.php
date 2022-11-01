<?php
namespace Code\QueryBuilder;

class Insert
{
    private $sql;

    public function __construct(string $table, array $fields = array())
    {
        $this->sql = 'INSERT INTO ' . $table;

        if (count($fields) > 0 )
            $this->sql .= '(' . implode(', ', $fields) . ')';
        
        $this->sql .= ' VALUES(:' . implode(', :', $fields) . ')';
        return $this;
    }

    public function getSql()
    {
        return $this->sql;
    }
}   