<?php
use Behat\Behat\Context\Step\Given,
	Behat\Behat\Context\Step\When,
	Behat\Behat\Context\Step\Then;

$steps->Given('/^ログインしていない$/', function($world) {
	return [
		new Given('"' . Router::url(['controller' => 'app_users', 'action' => 'logout']) . '" を表示している'),
	];
});

$steps->When('/^"([^"]*)" の投稿を一覧表示する$/', function($world, $username) {
	$user = $world->getUser($username);
	return [
		new When('"' . Router::url(['controller' => 'posts', 'action' => 'index', 'user_account' => $user['username']]) . '" を表示している'),
	];
});

$steps->Then('/^"([^"]*)" の投稿が新しい順で (\d+) 件表示されている$/', function($world, $username, $num) {
	return [
		new Then("ページ 1 に投稿が新しい順で {$num} 件表示されている"),
	];
});
