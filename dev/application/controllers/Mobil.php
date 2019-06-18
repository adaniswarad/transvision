<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends Backend_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Mobil_model'));
	}

	public function index() {
		$data = array();
		$this->site->view('mobil', $data);
	}

	public function action($param) {
		global $SConfig;
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if ($param == 'ambil') {
				$post = $this->input->post();
				if (!empty($post['id'])) {
					$data = $this->Mobil_model->get($post['id']);
					echo json_encode(array('response' => 'success', 'data' => $data));
				} else {
					$offset = null;

					if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1) {
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}

					$record = $this->Mobil_model->get_by();
					$total_rows = $this->Mobil_model->count();

					echo json_encode(
						array(
							'total_rows' => $total_rows,
							'perpage' => $SConfig->_backend_perpage,
							'record' => $record
						)
					);
				}
			} else if ($param == 'tambah' || $param == 'update') {
				if ($param == 'update') {
					$rules = $this->Mobil_model->rules_update;
				} else {
					$rules = $this->Mobil_model->rules_register;
				}
				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() == true) {
					$post = $this->input->post();
					$data = array(
						'mobil' => $post['mobil'],
						'nopol' => $post['nopol'],
						'tipe' => $post['tipe'],
						'merk' => $post['merk']
					);

					if ($param == 'update') {
						$this->Mobil_model->update($data, array('mobil_id' => $post['mobil_id']));
						$getId = $post['mobil_id'];
					} else {
						$getId = $this->Mobil_model->insert($data);
					}

					$result = array('response' => 'success');
				} else {
					$result = array('response' => 'failed', 'errors' => $this->form_validation->error_array());
				}
				echo json_encode($result);
			} else if ($param == 'hapus') {
				$post = $this->input->post();
				if (!empty($post['mobil_id'])) {
					$this->Mobil_model->delete($post['mobil_id']);
					$result = array('response' => 'success');
				}
				echo json_encode($result);
			}
		}
	}
}