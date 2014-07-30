<?php
App::uses('Post', 'Model');
App::uses('Fabricate', 'Fabricate.Lib');   // 追加

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

// ここから
        /**
         * @dataProvider exampleValidationErrors
         */
        public function testバリデーションエラー($column, $value, $message) {
            $post = Fabricate::build('Post', [$column=>$value]);    // 変更3
            $this->assertFalse($post->validates());    // 変更4
            $this->assertEquals([$message], $this->Post->validationErrors[$column]);
        }
        public function exampleValidationErrors() {
            return [
                ['title', '', 'タイトルは必須入力です'],
                ['title', str_pad('', 256, "a"), 'タイトルは255文字以内で入力してください'],
            ];
        }
    // ここまで追加します


}


