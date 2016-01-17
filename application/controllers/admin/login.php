<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin_model');
	}
	
	public function index(){
		if ($this->session->userdata('administrator')) {
			redirect(base_url() . 'admin');
		}else{
			//Загрузка вида
			$data['title'] = 'Вход на сайт';
			$this->view_libraries->view_admin('login', $data);
		}
	}
	public function authentication(){
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|callback_check_password');
		if($this->form_validation->run() == FALSE){
			//Загрузка вида и выводим ошибки
			$data['title'] = 'Вход на сайт';
     		$this->view_libraries->view_admin('login', $data);
     	}else{
     		//Если все хорошо
     		redirect(base_url() . 'admin');
     	}
	}

	public function check_password($password){
		$email = $this->security->xss_clean($this->input->post('email'));
		$result = $this->admin_model->check_user($email);
		if($result){
			//Проверка пароля
			if(password_verify($password, $result['password'])){
				//если все хорошо записываем данные в сессию
				$sess = array('useradmin' => $result['firstname']);
       			$this->session->set_userdata('administrator', $sess);
				return true;
			}else{
				$this->form_validation->set_message('check_password', 'Введены не верные данные или у Вас нет доступа!');
     			return false;
			}
		}else{
			$this->form_validation->set_message('check_password', 'Введены не верные данные или у Вас нет доступа!');
     		return false;
		}
	}
	//Выход
	function logout(){
   		$this->session->unset_userdata('administrator');
   		session_destroy();
   		redirect(base_url() . 'admin');
 	}
}