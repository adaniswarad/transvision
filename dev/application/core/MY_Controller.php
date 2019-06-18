<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Base Controller
*/
class MY_Controller extends CI_Controller {

	public $data = array();

	function __construct() {
		parent::__construct();

		$this->load->helper(array('template_helper', 'user_helper'));
		$this->load->library(array('site', 'form_validation', 'session'));
		$this->load->model(array('User_model'));

		$this->site->is_logged_in();
	}
	
}

?>