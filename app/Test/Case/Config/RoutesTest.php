<?php
class RoutesTest extends CakeTestCase {

	public function exampleUrls() {
		return [
			['新規投稿', '/blogs/new', ['controller' => 'posts', 'action' => 'add']],
			['記事一覧', '/hoge/blog', ['controller' => 'posts', 'action' => 'index', 'user_account' => 'hoge']],
			['ログイン', '/users/login', ['controller' => 'app_users', 'action' => 'login']],
			['ログアウト', '/users/logout', ['controller' => 'app_users', 'action' => 'logout']],
		];
	}

/**
 * @dataProvider exampleUrls
 */
	public function test配列形式からURL文字列に変換できること($name, $string, $array) {
		$this->assertEquals($string, Router::url($array), $name);
	}

/** 
 * @dataProvider exampleUrls
 */
	public function testURL文字列から逆引きできること($name, $string, $array) {
		$default = ['controller' => '', 'action' => '', 'pass' => [], 'named' => [], 'plugin' => null];
		$this->assertEquals(array_merge($default, $array), Router::parse($string), $name);
	}
}
