<?php
namespace Application\Service;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class DatabaseService
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Adapter $client)
    {
        $this->client = $client;
    }

    public function getStats()
    {
        $metadata = new \Zend\Db\Metadata\Metadata($this->client);

        return $metadata;
    }

    public function getSql()
    {
        return new Sql($this->client);
    }
    
    public function getTableList()
    {
        $connection = $this->client->getDriver()->getConnection();
        $result = $connection->execute('select * from information_schema.tables');
        
        $stmt = $result->getResource();
        
        $resultSet = $stmt->fetchAll(\PDO::FETCH_OBJ);
        
        var_dump($resultSet);
    }
}
