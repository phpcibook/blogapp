<?php
App::uses('PostsController', 'Controller');
App::uses('Fabricate', 'Fabricate.Lib');

/**
 * PostsController Test Case
 *
 */
class PostsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = [
		'app.post'
	];

	public function setUp() {
		parent::setUp();
		$this->controller = $this->generate('Posts', [
			'components' => ['Paginator', 'Session', 'Auth'],
			'models' => ['Post' => ['save']],
			'methods' => ['redirect']
		]);
		$this->controller->autoRender = false;
	}

	public function testIndexアクションではページングの結果がpostsにセットされること() {
		$post = Fabricate::build('Post');
		$this->controller->Paginator->expects($this->once())
			->method('paginate')->will($this->returnValue($post->data));
		$vars = $this->testAction('/user/blog', ['method' => 'get', 'return' => 'vars']);
		$this->assertEquals($post->data, $vars['posts']);
	}

	public function testAddアクションで保存が失敗したときメッセージがセットされること() {
		$this->controller->Auth->expects($this->any())
			->method('loggedIn')->will($this->returnValue(true));
		$this->controller->Post->expects($this->once())
			->method('save')->will($this->returnValue(false));
		$this->controller->Session->expects($this->once())
			->method('setFlash')->with($this->equalTo('記事の投稿に失敗しました。入力内容を確認して再度投稿してください。'));

		$this->testAction('/blogs/new', ['method' => 'post', 'data' => ['title' => 'Title1', 'body' => 'Body1']]);
	}

	public function testAddアクションで保存が成功したときはメッセージがセットされ一覧表示にリダイレクトされること() {
		$this->controller->Auth->expects($this->any())
			->method('loggedIn')->will($this->returnValue(true));
		$this->controller->Auth->staticExpects($this->any())
			->method('user')->will($this->returnValue(['id' => '1', 'username' => 'user1']));
		$this->controller->Post->expects($this->once())
			->method('save')->will($this->returnValue(true));
		$this->controller->Session->expects($this->once())
			->method('setFlash')->with($this->equalTo('新しい記事を受け付けました。'));
		$this->controller->expects($this->once())
			->method('redirect')->with($this->equalTo(['action' => 'index', 'user_account' => 'user1']));
		$this->testAction('/blogs/new', ['method' => 'post', 'data' => ['title' => 'Title1', 'body' => 'Body1']]);
	}

}
