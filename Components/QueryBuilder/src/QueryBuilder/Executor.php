<?php

namespace Code\QueryBuilder;

class Executor
{
    private $query;
    private $connection;

    private $params = [];
    private $result;

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
        if (count($this->params) > 0) {

            foreach ($this->params as $param) {

                $type = gettype($param['value']) == 'integer' ? \PDO::PARAM_INT : \PDO::PARAM_STR;
                $process->bindValue($param['bind'], $param['value'], $type);

            }
        }

        $returnProcess = $process->execute();
        $this->result = $process;
        return $returnProcess;
    }

    public function getResult()
    {
        if (!$this->result) null;
        // var_dump($this->result->fetchAll(\PDO::FETCH_ASSOC));die;
        return $this->result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
