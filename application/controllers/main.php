<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index(){
		$data['title'] = 'Главная страница';
		$this->view_libraries->view('main', $data);
	}

}