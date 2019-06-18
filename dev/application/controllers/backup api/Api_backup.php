<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Permohonan_model', 'Pemakaian_model', 'Mobil_model', 'User_model'));
	}

	public function coba() {
        $pemakaian = $this->db->get('pemakaian')->result();
        $this->response(array('pemakaian' => $pemakaian), 200);
    }

	public function login() {
		global $SConfig;

		$post = $this->input->post(null, true);
		$user = $this->User_model->get_by(array('email' => @$post['email'], 'group' => 'user'), 1, null, true);

		if (@$user->password == crypt(@$post['password'], @$user->password)) {
			$login_data = array(
				'user_id' => $user->user_id,
				'username' => $user->username,
				'email' => $user->email,
				'has_made_req' => $user->has_made_req,
				'peminjaman_id' => $user->peminjaman_id
			);
			$response = array('status' => 'success', 'user' => $login_data);
			echo json_encode($response);
		} else {
			$response = array('status' => 'failed');
			echo json_encode($response);
		}
	}

	public function pinjam() {
		global $SConfig;

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

		$get = $this->input->get(null, true);
		$post = $this->input->post(null, true);

		if (isset($post['action'])) {
			if ($post['action'] == 'create') {
				$data = array(
					'user_id' => $post['user_id'],
					'tujuan' => $post['tujuan'],
					'keperluan' => $post['keperluan'],
					'jum_penumpang' => $post['jum_penumpang'],
					'tgl_pemakaian' => $post['tgl_pemakaian']
				);
				/* insert data ke tabel peminjaman dan update field has_made_req di tabel user */
				if ($this->Peminjaman_model->insert($data)) {
					$insert_id = $this->db->insert_id();
					$has_made_req = array('has_made_req' => 1);
					$peminjaman_id = array('peminjaman_id' => $insert_id);
					$this->User_model->update($has_made_req, array('user_id' => $post['user_id']));
					$this->User_model->update($peminjaman_id, array('user_id' => $post['user_id']));
					echo json_encode(array('status' => 'success', 'peminjaman_id' => $insert_id));
				} else {
					echo json_encode(array('status' => 'failed'));
				}
			} else if ($post['action'] == 'delete') {
				if ($this->Peminjaman_model->delete($post['id'])) {
					array_push($response, array('status' => 'success'));
				} else {
					array_push($response, array('status' => 'failed'));
				}
				echo json_encode($result);
			}
		} else if (isset($post['user_id'])) {
			$record = $this->Peminjaman_model->get_by(array('user_id' => $post['user_id']));
			echo json_encode($record);
		} else {
			$record = $this->Peminjaman_model->get_by();
	 		echo json_encode($record);
		}
	}

	public function hasMadeRequest() {
		global $SConfig;

		$get = $this->input->get(null, true);
		$user = $this->User_model->get($get['user_id']);

		if ($user->has_made_req == 0) {
			echo json_encode(array('status' => 'able'));
		} else {
			echo json_encode(array('status' => 'unable'));
		}
	}

	public function cekStatusPermohonan() {
		global $SConfig;

		$post = $this->input->post(null, true);
		$peminjaman = $this->Peminjaman_model->get($post['peminjaman_id']);

		if ($peminjaman->status_req == 0) {
			echo json_encode(array('status' => 'pending'));
		} else if ($peminjaman->status_req == 1) {
			echo json_encode(array('status' => 'diizinkan'));
		} else {
			$has_made_req = array('has_made_req' => 0);
			$this->User_model->update($has_made_req, array('user_id' => $post['user_id']));
			echo json_encode(array('status' => 'ditolak'));
		}
	}

	public function upload() {
		global $SConfig;

		$post = $this->input->post();
		$image = $post["image"];
		$peminjaman_id = $post['peminjaman_id'];
		$km_awal = (int) $post["km_awal"];
		if ($image) {
			$target_dir = "uploads";

			if (!file_exists($target_dir)) {
				mkdir($target_dir);
			}

			$target_dir = $target_dir."/".rand()."_".time().".jpeg";
			$image_path = "http://192.168.100.7/lordennies/transvision-cls/$target_dir";
			$data = array('foto_km_awal' => $image_path, 'km_awal' => $km_awal);

			if (file_put_contents($target_dir, base64_decode($image))) {
				$this->Peminjaman_model->update($data, array('peminjaman_id' => $peminjaman_id));
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'failed'));
			}
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	public function akhir() {
		global $SConfig;

		$post = $this->input->post();
		$image = $post["image"];
		$peminjaman_id = $post['peminjaman_id'];
		$km_akhir = (int) $post["km_akhir"];
		if ($image) {
			$target_dir = "uploads";

			if (!file_exists($target_dir)) {
				mkdir($target_dir);
			}

			$target_dir = $target_dir."/".rand()."_".time().".jpeg";
			$image_path = "http://192.168.100.7/lordennies/transvision-cls/$target_dir";
			$data = array('foto_km_akhir' => $image_path, 'km_akhir' => $km_akhir);

			if (file_put_contents($target_dir, base64_decode($image))) {
				$this->Peminjaman_model->update($data, array('peminjaman_id' => $peminjaman_id));
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'failed'));
			}
		} else {
			echo json_encode(array('status' => 'failed'));
		}
	}

	public function detail() {
		global $SConfig;

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

		$post = $this->input->post(null, true);
		$record = $this->Peminjaman_model->get(1);
		echo json_encode($record);
	}
	
	public function setKoordinat() {
		global $SConfig;

		$post = $this->input->post(null, true);

		$data = array(
			'peminjaman_id' => $post['peminjaman_id'],
			'lat' => $post['lat'],
			'lng' => $post['lng']
		);

		if ($this->Route_model->insert($data)) {
			$response = array('status' => 'success');
		} else {
			$response = array('status' => 'failed');
		}
		echo json_encode($response);
	}

}