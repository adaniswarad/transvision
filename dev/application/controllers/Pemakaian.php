<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemakaian extends Backend_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Pemakaian_model', 'Permohonan_model', 'Mobil_model'));
	}

	public function index() {
		$data = array();
		$this->site->view('pemakaian', $data);
	}

	public function action($param) {
		global $SConfig;
		if ($param == 'ambil') {
			$post = $this->input->post();
			if (!empty($post['id'])) {
				echo json_encode(array(
					'response' => 'success',
					'data' => $this->Pemakaian_model->get($post['id'])
				));
			} else {
				$total_rows = $this->Pemakaian_model->count();
				$offset = null;

				if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1)
					$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;

				$record = $this->Pemakaian_model->get_pemakaian_list();

				echo json_encode(
					array(
						'total_rows' => $total_rows,
						'perpage' => $SConfig->_backend_perpage,
						'record' => $record
					)
				);
			}
		} else if ($param == 'update') {
			$rules = $this->Pemakaian_model->rules_update;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == true) {
				$post = $this->input->post();
				$data = array(
					'catatan' => $post['catatan'],
					'km_awal' => $post['km_awal'],
					'km_akhir' => $post['km_akhir']
				);

				$this->Pemakaian_model->update($data, array('pemakaian_id' => $post['pemakaian_id']));
				$result = array('response' => 'success');
			} else {
				$result = array('response' => 'failed', 'errors' => $this->form_validation->error_array());
			}

			echo json_encode($result);
		}
	}

	public function show_map() {
		$get = $this->input->get();

		if (!empty($get['id'])) {
			$pos = $this->Pemakaian_model->get_by(array('pemakaian_id' => $get['id']));
			$data = array(
				'lat' => $pos[0]->lat,
				'lng' => $pos[0]->lng
			);
			$this->site->view('map', $data);
		}
	}

	public function print_pemakaian() {
		$get = $this->input->get();
		if (!empty($get['id'])) {
			$data = array('id' => $get['id']);
			$this->site->view('print', $data);
		}
	}
}