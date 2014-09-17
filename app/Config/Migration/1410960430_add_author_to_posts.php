<?php
class AddAuthorToPosts extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = '';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_field' => array(
				'posts' => array(
					'author_id' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'length' => 36),
					'indexes' => array(
						'BY_AUTHOR_ID' => array('column' => 'author_id', 'unique' => false),
					),
				),
			),
		),
		'down' => array(
			'drop_field' => array(
				'posts' => array('author_id'),
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @return boolean Should process continue
 */
	public function after($direction) {
		return true;
	}
}
