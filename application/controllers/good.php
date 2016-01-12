<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Good extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
	}

	public function index($id = null){
		$this->show($id = null);
	}

	public function showGood($idGood){
		if(!empty($idGood) && is_numeric($idGood) ){
			$data['info'] = $this->main_model->getInfoGood($idGood);
			$data['title'] = $data['info']['title'];
			if ($this->session->userdata('enter')) {
				$session = $this->session->userdata('enter');
				$data['username'] = $session['username'];
			}
			$this->view_libraries->view('good', $data);
		}else{
			$data['title'] = 'Ошибка';
			$data['error'] = 'Товар не найден';
			$data['link'] = '';
			$this->view_libraries->view('error', $data);
		}
		
	}
}