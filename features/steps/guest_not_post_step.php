<?php
use Behat\Behat\Context\Step\Given,
	Behat\Behat\Context\Step\When,
	Behat\Behat\Context\Step\Then;

$steps->When('/^"([^"]*)" 画面に遷移しようとする$/', function($world, $page) {
	return [
		new When('"' . $page . '" へ移動する'),
	];
});

$steps->Then('/^"([^"]*)" が表示されていること$/', function($world, $page) {
	return [
		new Then($page . ' を表示していること'),
	];
});
