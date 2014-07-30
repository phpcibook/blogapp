<?php
App::uses('PostsController', 'Controller');
App::uses('Fabricate', 'Fabricate.Lib');    // 追加

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
	public $fixtures = array(
		'app.post'
	);
// ここから
        public function setUp() {
            parent::setUp();		// (2) 親クラスのsetUp()を呼ぶ
            $this->controller = $this->generate('Posts', [	// (3) コントローラをモックする
                'components' => ['Paginator', 'Session'],	// (4) モックするコンポーネントを列挙
                'models'     => ['Post' => ['save']],		// (5) モックするモデルを列挙
                'methods'    => ['redirect']			// (6) モックするメソッドを列挙
            ]);
            $this->controller->autoRender = false;		// (7) 自動でrenderしないようにする
        }
        public function testIndexアクションではページングの結果がpostsにセットされること() {
            $post = Fabricate::build('Post');   // 変更1
            $this->controller->Paginator->expects($this->once())
                ->method('paginate')->will($this->returnValue($post->data));  // 変更2
            $vars = $this->testAction('/user/blog', ['method'=>'get', 'return'=>'vars']);
            $this->assertEquals($post->data, $vars['posts']);  // 変更2
        }
        public function testAddアクションで保存が失敗したときメッセージがセットされること() {
            $this->controller->Post->expects($this->once())		// (10) 保存が失敗したことにする
                ->method('save')->will($this->returnValue(false));
            $this->controller->Session->expects($this->once())	// (11) メッセージがセットされるべき
                ->method('setFlash')->with($this->equalTo('記事の投稿に失敗しました。入力内容を確認して再度投稿してください。'));

            $this->testAction('/blogs/new', ['method'=>'post', 'data'=>['title'=>'Title1','body'=>'Body1']]);
        }
        public function testAddアクションで保存が成功したときはメッセージがセットされ一覧表示にリダイレクトされること() {
            $this->controller->Post->expects($this->once())
                ->method('save')->will($this->returnValue(true));
            $this->controller->Session->expects($this->once())
                ->method('setFlash')->with($this->equalTo('新しい記事を受け付けました。'));
            $this->controller->expects($this->once())			// (12) indexにリダイレクトされるべき
                ->method('redirect')->with($this->equalTo(['action'=>'index']));

            $this->testAction('/blogs/new', ['method'=>'post', 'data'=>['title'=>'Title1','body'=>'Body1']]);
        }
    // ここまで追加します

}
