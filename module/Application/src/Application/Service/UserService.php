<?php
namespace Application\Service;

use Elasticsearch\Client;
use Zend\Db\Adapter\Adapter;

class UserService
{

    /**
     * @var Adapter
     */
    private $adapter;

    /**
     * @var Client
     */
    private $client;


    public function __construct(Adapter $adapter, Client $client)
    {
        $this->adapter = $adapter;
        $this->client = $client;
    }

    public function getAssignees()
    {
        $connection = $this->adapter->getDriver()->getConnection();
        $result = $connection->execute('SELECT * FROM assignees');

        $stmt = $result->getResource();

        $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $resultSet;
    }
}
