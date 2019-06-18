<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

	protected $_table_name = 'user';
	protected $_primary_key = 'user_id';
	protected $_order_by = 'user_id';
	protected $_order_by_type = 'DESC';

	public $rules = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required|callback_password_check'
		)
	);

	public $rules_register = array(
		'username' => array(
			'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|callback_username_check'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required|min_length[5]'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|callback_email_check'
		),
	);

	public $rules_update = array(
		'username' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required'
		),
		'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email'
		),
	);

	function __construct() {
		parent::__construct();
	}

	function get_user($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		return parent::get_by($where, $limit, $offset, $single, $select);
	}
}

?>