<?php

class DATABASE_CONFIG {

	public $default;

	public $test;

	public function __construct() {
		$this->default = [
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => $this->read('MYSQL_DB_HOST'),
			'login' => $this->read('MYSQL_USERNAME'),
			'password' => $this->read('MYSQL_PASSWORD'),
			'database' => $this->read('MYSQL_DB_NAME'),
			'prefix' => $this->read('MYSQL_PREFIX'),
			'encoding' => 'utf8',
		];
		$this->test = [
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => $this->read('MYSQL_DB_HOST'),
			'login' => $this->read('MYSQL_USERNAME'),
			'password' => $this->read('MYSQL_PASSWORD'),
			'database' => $this->read('MYSQL_TEST_DB_NAME'),
			'prefix' => $this->read('MYSQL_PREFIX'),
			'encoding' => 'utf8',
		];
	}

	public function read($key, $default = null) {
		$value = env($key);
		if ($value !== null) {
			return $value;
		}

		$value = Configure::read($key);
		if ($value !== null) {
			return $value;
		}

		return $default;
	}
}
