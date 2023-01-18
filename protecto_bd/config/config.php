<?php

function getDbConfig () {
    return [
        'db' => [
            'host' => 'localhost',
            'user' => 'aitor97',
            'pass' => '12345',
            'name' => 'GameShop',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];
}
