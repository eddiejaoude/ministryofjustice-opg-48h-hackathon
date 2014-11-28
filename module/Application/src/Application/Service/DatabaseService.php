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

        $stats = array();
        foreach($metadata->getTableNames() as $tableName) {
            $stats[$tableName] = array(
                'size' => $this->getTableSize($tableName),
                'total' => $this->getTableCount($tableName)
            );
        }

        return $stats;
    }

    public function getTableSize($table)
    {
        $connection = $this->client->getDriver()->getConnection();
        $result = $connection->execute('SELECT
            pg_size_pretty(pg_relation_size(C.oid)) AS "size"
          FROM pg_class C
          LEFT JOIN pg_namespace N ON (N.oid = C.relnamespace)
          WHERE relname = \'' . $table . '\'
          ORDER BY pg_relation_size(C.oid) DESC');

        $stmt = $result->getResource();

        $resultSet = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resultSet[0]->size;
    }
    public function getTableCount($table)
    {
        $connection = $this->client->getDriver()->getConnection();
        $result = $connection->execute('SELECT
            COUNT(*)
          FROM ' . $table);

        $stmt = $result->getResource();

        $resultSet = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $resultSet[0]->count;
    }
}
