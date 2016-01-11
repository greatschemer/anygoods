<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
	}

	public function index(){
		$data['title'] = 'Главная страница';
		$data['goods'] = $this->main_model->getAllGoods();
		if ($this->session->userdata('enter')) {
			$session = $this->session->userdata('enter');
			$data['username'] = $session['username'];
		}
		$this->view_libraries->view('main', $data);
	}

}