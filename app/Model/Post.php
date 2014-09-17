<?php
App::uses('AppModel', 'Model');

/**
 * Post Model
 *
 * ブログ記事用モデルです
 *
 * @copyright php_ci_book
 * @link https://github.com/phpcibook/blogapp/blob/master/app/Model/Post.php
 * @since 1.0
 * @auther 作成者の名前 <test@example.com>
 *
 */
class Post extends AppModel {

/**
 * 一覧表示時のタイトルに使用するカラム名
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * バリデーションルール
 *
 * @var array
 */
	public $validate = [
		'title' => [
			'notEmpty' => [
				'rule' => ['notEmpty'],
				'message' => 'タイトルは必須入力です',
			],
			'maxLength' => [
				'rule' => ['maxLength', '255'],
				'message' => 'タイトルは255文字以内で入力してください',
			],
		],
	];

	public $actsAs = ['Containable'];

	public $recursive = -1;

	public $belongsTo = [
		'Author' => [
			'className' => 'Users.User',
			'foreignKey' => 'author_id'
		]
	];

	public function getPaginateSettings($username) {
		return [
			'limit' => 5,
			'order' => ['Post.id' => 'desc'],
			'contain' => ['Author'],
			'conditions' => ['Author.username' => $username],
		];
	}
}
