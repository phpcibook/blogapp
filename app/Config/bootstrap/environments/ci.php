<?php

    Environment::configure('ci', false, [
        'MYSQL_DB_HOST'  => 'localhost',
        'MYSQL_USERNAME' => 'webapp',
        'MYSQL_PASSWORD' => 'passw0rd',
        'MYSQL_DB_NAME'  => 'test_blog',      // (1)
        'MYSQL_TEST_DB_NAME' => 'test_blog',
        'MYSQL_PREFIX'   => '',
    ], function() {
        CakePlugin::load('Bdd');
CakePlugin::load('Fabricate'); 

// ここから
    $prefix = '.ci_';

    Cache::config('_cake_core_', array(
        'prefix' => $prefix . 'cake_core_',
    ));

    Cache::config('_cake_model_', array(
        'prefix' => $prefix . 'cake_model_',
    ));
// ここまで追加
    });

