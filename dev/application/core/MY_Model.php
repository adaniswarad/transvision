<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Base Model
*/
class MY_Model extends CI_Model {
	
	protected $_table_name;
	protected $_primary_key;
	protected $_order_by;
	protected $_order_by_type;
	protected $_primary_filter = 'intval';
	protected $_type;
	public $rules;

	function __construct() {
		parent::__construct();
	}

	public function insert($data, $batch = false) {
		if ($batch == true) { // Menginsert data secara banyak
			$this->db->insert_batch('{PRE}'.$this->_table_name, $data);
		} else {
			$this->db->set($data);
			$this->db->insert('{PRE}'.$this->_table_name);
			$id = $this->db->insert_id();
			return $id;
		}
	}

	public function update($data, $where = array()) {
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('{PRE}'.$this->_table_name);
	}

	public function get($id = null, $single = false) {
		if ($id != null) { // mencari detail dari sesuatu
			$filter = $this->_primary_filter;
			$id = $filter($id); // penguatan bahwa bernilai integer
			$this->db->where($this->_primary_key, $id);
			$method = 'row'; // agar bisa diakses menggunakan array
		} else if ($single == true) {
			$method = 'row';
		} else {
			$method = 'result'; // diakses menggunakan objek
		}

		if ($this->_order_by_type) {
			$this->db->order_by($this->_order_by, $this->_order_by_type);
		} else {
			$this->db->order_by($this->_order_by);
		}

		return $this->db->get('{PRE}'.$this->_table_name)->$method();
	}

	public function get_by($where = null, $limit = null, $offset = null, $single = false, $select = null) {
		if ($select) {
			$this->db->select($select);
		}

		if ($where) {
			$this->db->where($where);
		}

		if ($limit && $offset) {
			$this->db->limit($limit, $offset);
		} else if ($limit) {
			$this->db->limit($limit);
		}

		return $this->get(null, $single);
	}

	public function delete($id) {
		$filter = $this->_primary_filter;
		$id = $filter($id);

		if (!$id) {
			return false;
		}

		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete('{PRE}'.$this->_table_name);
	}

	public function delete_by($where = null) {
		if ($where) {
			$this->db->where($where);
		}

		$this->db->delete('{PRE}'.$this->_table_name);
	}

	public function count($where = null) {
		if ($where) {
			$this->db->where($where);
		}

		$this->db->from('{PRE}'.$this->_table_name);
		return $this->db->count_all_results();
	}

}

?>