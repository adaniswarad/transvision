<?php 

function get_template_directory($path, $dir_file) {
	global $SConfig;
	$replace_path = str_replace('\\', '/', $path);
	$get_digit_doc_root = strlen($SConfig->_document_root);
	$full_path = substr($replace_path, $get_digit_doc_root);
	return $SConfig->_site_url.$full_path.'/'.$dir_file;
}

function get_template($view) {
	$_this =& get_instance();
	return $_this->site->view($view);
}

function set_url($sub) {
	$_this =& get_instance();
	return site_url('/'.$sub);
}

function is_active_page_print($page, $class)
{
	$_this =& get_instance();
	if ($page == $_this->uri->segment(1)) {
		return $class;
	}
}

function title() {
	$_this =& get_instance();
	global $SConfig;

	$array_page = array(
		'permohonan' => 'Daftar Permohonan',
		'pemakaian' => 'Daftar Pemakaian',
		'mobil' => 'Daftar Mobil',
		'user' => 'Daftar User'
	);

	$title = null;
	if (array_key_exists($_this->uri->segment(1), $array_page)) {
		return $array_page[$_this->uri->segment(1)] . ' | ' . $SConfig->_cms_name;
	}
}

function form_dropdown_status() {
	$options = array(
		'' => '-- Pilih status permohonan --',
		'0'	=> 'Pending',
		'1' => 'Accept',
		'2'	=> 'Reject'
	);
	return form_dropdown('status_permohonan', $options, '', 'id="status_permohonan"');
}

function form_dropdown_group() {
	$options = array(
		'' => 'Pilih Group',
		'admin'	=> 'Administrator',
		'user'	=> 'User'
	);
	return form_dropdown('group', $options, 0, 'id="group"');
}

?>