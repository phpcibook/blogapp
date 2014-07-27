<?php

    Environment::configure('development', true, [  // (1) 
        'MYSQL_DB_HOST'  => 'localhost',           // (2)
        'MYSQL_USERNAME' => 'webapp',              // (3)
        'MYSQL_PASSWORD' => 'passw0rd',            // (4)
        'MYSQL_DB_NAME'  => 'blog',                // (5)
        'MYSQL_TEST_DB_NAME' => 'test_blog',       // (6)
        'MYSQL_PREFIX'   => '',                    // (7)
    ], function() {
        CakePlugin::load('Bdd');
    });

