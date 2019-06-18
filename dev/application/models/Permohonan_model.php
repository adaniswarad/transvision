<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_model extends MY_Model {
	
	protected $_table_name = 'permohonan';
	protected $_primary_key = 'permohonan_id';
	protected $_order_by = 'permohonan_id';
	protected $_order_by_type = 'DESC';

	public $rules_update = array(
		'tujuan' => array(
			'field' => 'tujuan',
			'label' => 'Tujuan',
			'rules' => 'trim|required'
		),
		'keperluan' => array(
			'field' => 'keperluan',
			'label' => 'Keperluan',
			'rules' => 'trim|required'
		),
		'jum_penumpang' => array(
			'field' => 'jum_penumpang',
			'label' => 'Jumlah Penumpang',
			'rules' => 'trim|required'
		),
		'tgl_pemakaian' => array(
			'field' => 'tgl_pemakaian',
			'label' => 'Tanggal Pemakaian',
			'rules' => 'trim|required'
		),
		'kode_pemakaian' => array(
			'field' => 'kode_pemakaian',
			'label' => 'Kode Pemakaian',
			'rules' => 'trim|required'
		)
	);

	function __construct() {
		parent::__construct();
	}

	function get_permohonan($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		$this->db->select('{PRE}user.username, {PRE}permohonan.*');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get_by($where, $limit, $offset, $single, $select);
	}

	function get_accepted_permohonan($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		$this->db->select('{PRE}user.username, {PRE}permohonan.*');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get_by($where, $limit, $offset, $single, $select);
	}

	function get_permohonan_single($id = null) {
		$this->db->select('{PRE}user.username, {PRE}permohonan.*');
		$this->db->join('{PRE}user', 'id_user = user_id', 'LEFT');
		return parent::get($id);
	}
}

?>