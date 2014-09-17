<?php
$world->getPathTo = function($path) use($world) {
	switch ($path) {
	case '新規投稿': return Router::url(['controller' => 'posts', 'action' => 'add']);
	case 'ログイン画面': return Router::url(['controller' => 'app_users', 'action' => 'login']);
	default: return $path;
	}
};

$world->getUser = function($username) use($world) {
	$users = ['会員' => ['username' => 'testuser', 'password' => 'secretkey']];
	$user = $world->getModel('Users.User')->findByUsername($users[$username]);
	$user['User']['password'] = $users[$username]['password'];
	return $user['User'];
};

?>