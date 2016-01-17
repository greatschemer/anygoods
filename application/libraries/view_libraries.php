<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_libraries {
	//Библиотека вида
    function view($dir, $data) {
    	$CI =& get_instance();

	    $CI->load->view('site/head', $data);
		$CI->load->view('site/' . $dir . '/body', $data);
		$CI->load->view('site/footer', $data);	        
    }
    //Библиотека вида ошибок
    function view_error($data) {
    	$CI =& get_instance();

		$CI->load->view('site/error/body', $data);
       
    }
    function view_admin($dir, $data) {
        $CI =& get_instance();

        $CI->load->view('admin/head', $data);
        $CI->load->view('admin/' . $dir , $data);
        $CI->load->view('admin/footer', $data);   
       
    }
}

?>