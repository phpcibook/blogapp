<?php
use Behat\Behat\Context\Step\Given,
	Behat\Behat\Context\Step\When,
	Behat\Behat\Context\Step\Then;
App::uses('Fabricate', 'Fabricate.Lib');

$steps->When('/^以下の内容で記事を投稿する$/', function($world, $table) {
	return [
		new When('"' . Router::url(['controller' => 'posts', 'action' => 'add']) . '" を表示している'),
		new When('次のように入力する:', $table),
		new When('"投稿" ボタンをクリックする'),
	];
});

$steps->Then('/^新しい記事が登録されていること$/', function($world) {
	$world->assertSession()->elementTextContains('css', 'article > header', '新しい記事を受け付けました。');
});

$steps->Then('/^新しい記事が登録できないこと$/', function($world) {
	$world->assertSession()->elementTextContains('css', 'article > header', '記事の投稿に失敗しました。入力内容を確認して再度投稿してください。');
});
