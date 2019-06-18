<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class User extends Backend_Controller {
	
	protected $user_detail;

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array();
		$this->site->view('user', $data);
	}

	public function login()	{
		$post = $this->input->post(null, true);
		
		if (isset($post['username'])) {
			$this->user_detail = $this->User_model->get_by(array('username' => $post['username'], 'group' => 'admin'), 1, null, true);
		}

		$this->form_validation->set_message('required', '%s kosong, tolong diisi!');

		$rules = $this->User_model->rules;
		$this->form_validation->set_rules($rules);	

		if ($this->form_validation->run() == false) {	
			$this->site->view('login');
		} else {
			$login_data = array(
				'user_id' => $this->user_detail->user_id,
				'username' => $post['username'],
				'group' => $this->user_detail->group,
				'email' => $this->user_detail->email,
				'last_login' => $this->user_detail->last_login,
				'logged_in' => true
			);

			$this->session->set_userdata($login_data);

			redirect(set_url('permohonan'));
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect(set_url('login'));
	}

	public function action($param) {
		global $SConfig;
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			if ($param == 'ambil') {
				$post = $this->input->post();
				if (!empty($post['id'])) {
					$data = $this->User_model->get($post['id']);
					echo json_encode(array('response' => 'success', 'data' => $data));
				} else {
					$offset = null;

					if (!empty($post['hal_aktif']) && $post['hal_aktif'] > 1) {
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage;
					}

					if (!empty($post['cari']) && ($post['cari'] != 'null')) {
						$cari = $post['cari'];
						$total_rows = $this->User_model->count(array("username LIKE" => "%$cari%"));
						@$record = $this->User_model->get_by(array("username LIKE" => "%$cari%"), $SConfig->_backend_perpage, $offset, false, "user_id, username, group, email");
					} else {
						$record = $this->User_model->get_by(null, $SConfig->_backend_perpage, $offset, false, "user_id, username, group, email");
						$total_rows = $this->User_model->count();					
					}

					echo json_encode(array(
						'total_rows' => $total_rows,
						'perpage' => $SConfig->_backend_perpage,
						'record' => $record
					));
				}
			} else if ($param == 'tambah' || $param == 'update') {
				if ($param == 'update') {
					$rules = $this->User_model->rules_update;
				} else {
					$rules = $this->User_model->rules_register;
				}
				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() == true) {
					$group = 'user';
					$post = $this->input->post();
					$data = array(
						'email' => $post['email'],
						'username' => $post['username'],
						'password' => bCrypt($post['password'], 12),
						'group' => (!empty($post['group'])) ? $group = $post['group'] : $group = '',
						'created_on' => date("Y-m-d H:i:s"),
						'last_login' => date("Y-m-d H:i:s")
					);

					if ($param == 'update') {
						if (!empty($post['password'])) {
							$data['password'] = bCrypt($post['password'], 12);
						} else {
							unset($data['password']);
						}

						$this->User_model->update($data, array('user_id' => $post['user_id']));
						$getId = $post['user_id'];
					} else {
						$getId = $this->User_model->insert($data);
					}

					$result = array('response' => 'success');
				} else {
					$result = array('response' => 'failed', 'errors' => $this->form_validation->error_array());
				}

				echo json_encode($result);
			} else if ($param == 'hapus') {
				$post = $this->input->post();
				if (!empty($post['user_id'])) {
					$this->User_model->delete($post['user_id']);
					$result = array('response' => 'success');
				}
				echo json_encode($result);
			}
		}
	}

	public function email_check($str) {
		/* bisa digunakan untuk mengecek ke dalam database nantinya */
		if ($this->User_model->count(array('email' => $str)) > 0) {
            $this->form_validation->set_message('email_check', 'Email sudah digunakan, mohon ganti yang lain.');
            return false;
        } else {
            return true;
        }
    }

    public function username_check($str) {
    	/* bisa digunakan untuk mengecek ke dalam database nantinya */
    	if ($this->User_model->count(array('username' => $str)) > 0) {
    		$this->form_validation->set_message('username_check', 'Username sudah digunakan, mohon ganti yang lain.');
    		return false;
    	} else
    		return true;
    }

	public function password_check($str) {
		$user_detail = $this->user_detail;

    	if (@$user_detail->password == crypt($str, @$user_detail->password)) {
    		return true;
		} else if (@$user_detail->password) {
			$this->form_validation->set_message('password_check', 'Password anda salah.');
			return false;
		} else {
			$this->form_validation->set_message('password_check', 'Anda tidak memiliki hak akses admin.');
			return false;
		}
	}

	public function temporary_register() {
		$data_user_baru = array(
			'username' => 'admin',
			'password' => bCrypt('admin', 12),
			'group' => 'admin',
			'email' => 'admin@gmail.com'
		);

		$this->User_model->insert($data_user_baru);
	}
}

?>