<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}

	public function index(){
		$data['title'] = 'Главная страница';
		if ($this->session->userdata('enter')) {
			$session = $this->session->userdata('enter');
			$data['username'] = $session['username'];
		}
		$this->view_libraries->view('main', $data);
	}

}