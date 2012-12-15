<?php
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'A username is required.'
			),
		),
		'password' => array(
			'required' => array(
				'rule' => array('notempty'),
				'message' => 'A password is required.'
			),
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inlist', array('admin', 'author')),
				'message' => 'Please enter a valid role.',
				'allempty' => false
			),
		),
	);
	
	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
}
