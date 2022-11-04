<?php 

namespace Code\QueryBuilder;

class Executor 
{   
    private $query;
    private $connection;

    private $params = [];

    public function __construct(\PDO $connection, $query = null)
    {
        $this->query = $query;
        $this->connection = $connection;
    }

    public function setParams($bind, $value)
    {
        $this->params[] = ['bind' => $bind, 'value' => $value];
        return $this;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function execute()
    {
        $process = $this->connection->prepare($this->query->getSql());

        foreach ($this->params as $param ) {
            $type = gettype($param['value']) == 'string' ? \PDO::PARAM_STR  : \PDO::PARAM_INT;
            $process->bindValue($param['bind'],$param['value'] ,$type);
        }



        $process->execute();
        return $this->connection->lastInsertId();

    }
}