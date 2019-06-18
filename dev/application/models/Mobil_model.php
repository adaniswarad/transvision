<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil_model extends MY_Model {
	
	protected $_table_name = 'mobil';
	protected $_primary_key = 'mobil_id';
	protected $_order_by = 'mobil_id';
	protected $_order_by_type = 'ASC';

	public $rules = array(
		'mobil' => array(
			'field' => 'mobil',
			'label' => 'Mobil',
			'rules' => 'trim|required'
		), 
		'nopol' => array(
			'field' => 'nopol', 
			'label' => 'No Polisi', 
			'rules' => 'trim|required'
		), 
		'tipe' => array(
			'field' => 'tipe', 
			'label' => 'Tipe', 
			'rules' => 'trim|required'
		), 
		'merk' => array(
			'field' => 'merk', 
			'label' => 'Merk', 
			'rules' => 'trim|required'
		)
	);

	public $rules_register = array(
		'mobil' => array(
			'field' => 'mobil',
			'label' => 'Mobil',
			'rules' => 'trim|required'
		), 
		'nopol' => array(
			'field' => 'nopol', 
			'label' => 'No Polisi', 
			'rules' => 'trim|required'
		)
	);

	public $rules_update = array(
		'mobil' => array(
			'field' => 'mobil',
			'label' => 'Mobil',
			'rules' => 'trim|required'
		), 
		'nopol' => array(
			'field' => 'nopol', 
			'label' => 'No Polisi', 
			'rules' => 'trim|required'
		)
	);

	function __construct() {
		parent::__construct();
	}
}

?>