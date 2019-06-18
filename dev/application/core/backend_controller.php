<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Backend_Controller extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper(array('admin_helper'));
		$this->load->library(array('form_validation'));
		$this->load->model(array());

		$this->site->template = 'templatevamp';
	}

}

?>