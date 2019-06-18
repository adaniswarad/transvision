<?php

function get_site($param) {
	global $SConfig;
	$display = null;

	switch($param) {
		case 'name':
			$display = $SConfig->_site_name;
			break;
		case 'url':
			$display = $SConfig->_site_url;
			break;
		default: break;
	}

	return $display;
}

?>