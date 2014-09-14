<?php
App::uses('Post', 'Model');

/**
 * Post Test Case
 *
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}

/**
 * @dataProvider exampleValidationErrors
 */
	public function testバリデーションエラー($column, $value, $message) {
		$default = ['title' => 'タイトル', 'body' => '本文'];
		$this->Post->create(array_merge($default, [$column => $value]));
		$this->assertFalse($this->Post->validates());
		$this->assertEquals([$message], $this->Post->validationErrors[$column]);
	}

	public function exampleValidationErrors() {
		return [
			['title', '', 'タイトルは必須入力です'],
			['title', str_pad('', 256, "a"), 'タイトルは255文字以内で入力してください'],
		];
	}
}
