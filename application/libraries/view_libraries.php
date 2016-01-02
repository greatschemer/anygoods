<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_libraries {
	//Библиотека вида
    function view($dir, $data) {
    	$CI =& get_instance();

	    $CI->load->view($dir . '/head', $data);
		$CI->load->view($dir . '/body', $data);
		$CI->load->view($dir . '/footer', $data);	        
    }
}

?>