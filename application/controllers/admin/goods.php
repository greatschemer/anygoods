<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	public function index(){
		if ($this->session->userdata('administrator')) {
			$session = $this->session->userdata('administrator');
			$data['title'] = 'Админ панель - Товарф';
			$data['useradmin'] = $session['useradmin'];
			$this->view_libraries->view_admin('goods/body', $data);
		}else{
			redirect(base_url() . 'admin/login');
		}
	}


}