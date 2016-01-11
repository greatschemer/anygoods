<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('main_model');
	}

	public function index(){
		$data['title'] = 'Категории';
		$data['categories'] = $this->main_model->getAllCategories();
		if ($this->session->userdata('enter')) {
			$session = $this->session->userdata('enter');
			$data['username'] = $session['username'];
		}
		$this->view_libraries->view('categories', $data);
	}

	public function showCategory($idCategory){

		if($this->check_category($idCategory)){
			$data['goods'] = $this->main_model->getGoodsCategory($idCategory);
			$data['title'] = 'Категория ' . $data['goods'][0]['ctitle'];
			if ($this->session->userdata('enter')) {
				$session = $this->session->userdata('enter');
				$data['username'] = $session['username'];
			}
			$this->view_libraries->view('category', $data);
		}else{
			$data['title'] = 'Ошибка';
			$data['error'] = 'Такой категории не найдено';
			$data['link'] = 'categories';
			$this->view_libraries->view('error', $data);
		}

	}
	//Проверка существует ли категория
	public function check_category($idCategory){
		if($this->main_model->check_category($idCategory) && is_numeric($idCategory)){
			return true;
		}else{
			return false;
		}
	}
}