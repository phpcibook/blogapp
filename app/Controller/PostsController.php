<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

	public $components = ['Paginator', 'RequestHandler', 'Session'];

	public $helpers = [
		'Html' => ['className' => 'BoostCake.BoostCakeHtml'],
		'Form' => ['className' => 'BoostCake.BoostCakeForm'],
	];

	public function index() {
		$this->set('posts', $this->Paginator->paginate());
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create($this->request->data);
			if ($this->Post->save()) {
				$this->Session->setFlash(
					__('新しい記事を受け付けました。'),
					'alert',
					['plugin' => 'BoostCake', 'class' => 'alert-success']
				);

				return $this->redirect(['action' => 'index']);
			} else {
				$this->Session->setFlash(
					__('記事の投稿に失敗しました。入力内容を確認して再度投稿してください。'),
					'alert',
					['plugin' => 'BoostCake', 'class' => 'alert-success']
				);
			}
		}
	}
}