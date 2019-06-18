<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemakaian_model extends MY_Model {

	protected $_table_name = 'pemakaian';
	protected $_primary_key = 'pemakaian_id';
	protected $_order_by = 'pemakaian_id';
	protected $_order_by_type = 'DESC';

	public $rules_update = array(
		'berangkat' => array(
			'field' => 'berangkat',
			'label' => 'Berangkat',
			'rules' => 'trim|required'
		),
		'kembali' => array(
			'field' => 'kembali',
			'label' => 'Kembali',
			'rules' => 'trim|required'
		),
		'km_awal' => array(
			'field' => 'km_awal',
			'label' => 'KM Awal',
			'rules' => 'trim|required'
		),
		'km_akhir' => array(
			'field' => 'km_akhir',
			'label' => 'KM Akhir',
			'rules' => 'trim|required'
		)
	);

	function __construct() {
		parent::__construct();
	}

	function get_pemakaian_sekarang($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		$this->db->join('{PRE}permohonan', 'id_permohonan = permohonan_id', 'LEFT');
		$this->db->join('{PRE}mobil', 'id_mobil = mobil_id', 'LEFT');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get_by($where, $limit, $offset, $single, $select);
	}

	function get_pemakaian_list($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		$this->db->join('{PRE}permohonan', 'id_permohonan = permohonan_id', 'LEFT');
		$this->db->join('{PRE}mobil', 'id_mobil = mobil_id', 'LEFT');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get_by($where, $limit, $offset, $single, $select);
	}

	function get_pemakaian_detail($pemakaian_id) {
		$this->db->select('{PRE}user.username, {PRE}permohonan.*, {PRE}pemakaian.*, {PRE}mobil.*');
		$this->db->join('{PRE}permohonan', 'id_permohonan = permohonan_id', 'LEFT');
		$this->db->join('{PRE}mobil', 'id_mobil = mobil_id', 'LEFT');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get($pemakaian_id);
	}

	// function get_loc($id) {
	// 	$this->db->select('lat, lng');
	// 	$this->db->join('{PRE}route', 'pemakaian_id = pemakaian', 'LEFT');
	// 	$this->db->where(array('pemakaian' => $id));
	// 	$method = 'result';
	// 	return $this->db->get('{PRE}'.$this->_table_name)->$method();
	// }
}

?>