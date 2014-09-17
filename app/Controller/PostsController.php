<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {

	public $components = ['Paginator', 'RequestHandler', 'Session'];

	public $helpers = [
		'Html' => ['className' => 'BoostCake.BoostCakeHtml'],
		'Form' => ['className' => 'BoostCake.BoostCakeForm'],
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	public function index() {
		$this->Paginator->settings = $this->Post->getPaginateSettings($this->request->user_account);
		$this->set('posts', $this->Paginator->paginate());
	}

	public function add() {
		if ($this->request->is('post')) {
			$current_user = $this->Auth->user();
			$this->request->data['Post']['author_id'] = $current_user['id'];

			$this->Post->create($this->request->data);
			if ($this->Post->save()) {
				$this->Session->setFlash(
					__('新しい記事を受け付けました。'),
					'alert',
					['plugin' => 'BoostCake', 'class' => 'alert-success']
				);

				return $this->redirect(['action' => 'index', 'user_account' => $current_user['username']]);
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