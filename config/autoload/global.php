<?php

$hosts = array();
if (getenv('ES_URL')) {
    $hosts = array(
        getenv('ES_URL')
    );
}

return array(
    'elasticsearch' => array(
        'cluster' => array(
            'hosts' => $hosts
        )
    ),
    'database' => array(
        'driver' => 'Pdo_Pgsql',
        'hostname' => getenv('DB_URL'),
        'port' => getenv('DB_PORT'),
        'database' => getenv('DB_NAME'),
        'username' => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD')
    )
);
