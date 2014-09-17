<?php
// features/support/hooks.php
App::uses('CakeTestCase', 'TestSuite');
class BddAllFixture extends CakeTestCase {

	public $fixtures = [
		'app.post', 'plugin.users.user'
	];
}

$hooks->beforeSuite(function($event) {
	// Do something before whole test suite
});
$hooks->afterSuite(function($event) {
	// Do something after whole test suite
});

$hooks->beforeFeature('', function($event) {
	// do something before each feature
});
$hooks->afterFeature('', function($event) {
	// do something after each feature
});

$hooks->beforeScenario('', function($event) {
	// do something before each scenario
	$manager = new CakeFixtureManager();
	$fixture = new BddAllFixture();
	$manager->fixturize($fixture);
	$manager->load($fixture);
});
$hooks->afterScenario('', function($event) {
	// do something after each scenario
});

