<?php

Environment::configure('ci', false, [
	'MYSQL_DB_HOST' => 'localhost',
	'MYSQL_USERNAME' => 'webapp',
	'MYSQL_PASSWORD' => 'passw0rd',
	'MYSQL_DB_NAME' => 'test_blog',
	'MYSQL_TEST_DB_NAME' => 'test_blog',
	'MYSQL_PREFIX' => '',
]);
