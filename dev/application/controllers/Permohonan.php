<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends Backend_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Permohonan_model', 'Pemakaian_model', 'Mobil_model'));
	}

	public function index() {
		$data = array();
		$this->site->view('permohonan', $data);
	}

	public function action($param) {
		global $SConfig;

		if ($param == 'ambil') {
			$post = $this->input->post();
			// Ambil data
			if (!empty($post['id'])) {
				echo json_encode(array(
					'response' => 'success',
					'data' => $this->Permohonan_model->get_permohonan_single($post['id'])
				));
			} else {
				$offset = null;

				if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1) {
					$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
				}

				$record = $this->Permohonan_model->get_permohonan(array('status_permohonan' => 0), $SConfig->_backend_perpage, $offset);
				$total_rows = $this->Permohonan_model->count();

				echo json_encode(array(
					'total_rows' => $total_rows,
					'perpage' => $SConfig->_backend_perpage,
					'record' => $record
				));
			}
		} else if ($param == 'update') {
			$rules = $this->Permohonan_model->rules_update;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == true) {
				$post = $this->input->post();
				$data = array(
					'tujuan' => $post['tujuan'],
					'keperluan' => $post['keperluan'],
					'jum_penumpang' => $post['jum_penumpang'],
					'tgl_pemakaian' => $post['tgl_pemakaian'],
					'lama_pemakaian' => $post['lama_pemakaian'],
					'dasar_pemakaian' => $post['dasar_pemakaian'],
					'status_permohonan' => 1
				);

				/* data ini dimasukkan ke tabel pemakaian */
				$data_pemakaian = array(
					'id_permohonan' => $post['permohonan_id'],
					'id_mobil' => $post['mobil_parent'],
					'kode_pemakaian' => $post['kode_pemakaian']
				);

				$this->Permohonan_model->update($data, array('permohonan_id' => $post['permohonan_id']));
				$this->Pemakaian_model->insert($data_pemakaian);
				$result = array('response' => 'success');
			} else {
				$result = array('response' => 'failed', 'errors' => $this->form_validation->error_array());
			}

			echo json_encode($result);
		} else if ($param == 'hapus') {
			$post = $this->input->post(null, true);
			if (!empty($post['permohonan_id'])) {
				$this->Permohonan_model->delete($post['permohonan_id']);
				$result = array('response' => 'success');
			}
			echo json_encode($result);
		} else if ($param == 'tolak') {
			$post = $this->input->post();
			if (!empty($post['permohonan_id'])) {
				$data = array('status_permohonan' => 2);
				$this->Permohonan_model->update($data, array('permohonan_id' => $post['permohonan_id']));
				$result = array('response' => 'success');
			}
			echo json_encode($result);
		}
	}

	/* bukan sampah lho! */
	public function get_mobil() {
		$record = $this->Mobil_model->get_by();
		echo json_encode(array('record' => $record));
	}

}