<?php
namespace Application\Service;

use Elasticsearch\Client;

class ElasticSearchService
{

    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getStats()
    {
        return $this->client
                ->indices()
                ->stats();
    }
}
