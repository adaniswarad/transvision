<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Website Setting Configuration
*/
class Site {
	
	public $template;

	function view($pages, $data = null) {
		$_this =& get_instance();

		$data ? $_this->load->view($this->template.'/'.$pages, $data) :
				$_this->load->view($this->template.'/'.$pages);
	}

	function is_logged_in() {
		$_this =& get_instance();

		$user_session = $_this->session->userdata;

		if ($_this->uri->segment(1) == 'login') {
			if (isset($user_session['logged_in']) && $user_session['logged_in'] == true && $user_session['group'] == 'admin') {
				redirect(set_url('permohonan'));
			}
		} else {
			if (!isset($user_session['logged_in']) || $user_session['group'] != 'admin') {
				$_this->session->sess_destroy();
				redirect(set_url('login'));
			}
		}
	}
}

?>