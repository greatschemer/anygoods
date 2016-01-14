<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
	}

	public function index(){
		$data['title'] = 'Поиск';
		if ($this->session->userdata('enter')) {
			$session = $this->session->userdata('enter');
			$data['username'] = $session['username'];
		}

		if($this->input->post('go')){
			$string = $this->security->xss_clean($this->input->post('search'));
			if(!empty($string)){
				if($result = $this->main_model->searchGoods($string)){
					$data['result'] = $result;
				}else{
					$data['error_serach'] = 'Поиск не дал результатов';
				}
			}else{
				$data['error_serach'] = 'Поле не должно быть пустым!';
			}
		}

		$this->view_libraries->view('search', $data);
	}

}