<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();		
		$this->load->library('session');
		$this->load->model('login_model');
	}
	
	//по умолчанию грузится форма входа
	public function index(){
		$data['title'] = 'Вход на сайт';
		$this->view_libraries->view('login', $data);
	}

	//Регистрация нового пользователя
	public function registration(){
		$data['title'] = 'Регистрация нового пользователя';
		
		//Если нажата кновка регистрации
		if($this->input->post('reg')){
			$this->form_validation->set_rules('firstname', 'Имя', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Фамилия', 'trim|required');
			$this->form_validation->set_rules('bdate', 'Дата рождения', 'trim');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_check_email_reg');
			$this->form_validation->set_rules('pass1', 'Пароль', 'trim|required|min_length[6]|callback_check_password');

			if($this->form_validation->run() == FALSE){
				//Загрузка вида и выводим ошибки
     			$this->view_libraries->view('registration', $data);
     		}else{
     			//Если валидация прошла
     			$firstname = $this->security->xss_clean($this->input->post('firstname'));
     			$lastname = $this->security->xss_clean($this->input->post('lastname'));
     			$bdate = $this->security->xss_clean($this->input->post('bdate'));
     			$email = $this->security->xss_clean($this->input->post('email'));
     			$password = $this->security->xss_clean($this->input->post('pass1'));
     			$datetime = new DateTime();
     			
     			$inset = array(
     				'firstname' => $firstname,
     				'lastname' => $lastname,
     				'bdate' => $bdate,
     				'email' => $email,
     				'password' => password_hash($password, PASSWORD_BCRYPT),
     				'active' => '1',
     				'regdate' => $datetime->format('Y-m-d')
     			);
     			//Добавляем данные в БД
     			if($this->login_model->add_user($inset)){
     				$this->session->set_flashdata('success', 'Пользователь успешно добавлен!');
     				redirect('login');
     			}else{
     				$data['error'] = 'Произошла системная ошибка';
     				$this->view_libraries->view('registration', $data);
     			}
     		}
		}else{
			//Загрузка вида
			$this->view_libraries->view('registration', $data);
		}
	}

	//РЕГИСТРАЦИЯ - Проверка есть ли такой Email в бд 
	public function check_email_reg($email){
		if($this->login_model->check_email($email)){
			return true;
		}else{
			$this->form_validation->set_message('check_email_reg', 'Пользователь с таким email('.$email.') уже зарегистрирован!');
     		return false;
		}
	}
	//РЕГИСТРАЦИЯ - Проверка совпадают ли пароли
	public function check_password($pass1){
		$pass2 = $this->security->xss_clean($this->input->post('pass2'));
		if($pass1 === $pass2){
			return true;
		}else{
			$this->form_validation->set_message('check_password', 'Пароли не совпадают');
			return false;
		}
	}
	//Вход пользователя на сайт
	public function authentication(){
		$data['title'] = 'Вход на сайт';

		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Пароль', 'trim|required|min_length[6]|callback_check_password_login');

		if($this->form_validation->run() == FALSE){
			//Загрузка вида и выводим ошибки
     		$this->view_libraries->view('login', $data);
     	}else{
     		//Если все хорошо
     		redirect('main');
     	}
	}
	//Проверка Пользователя
	public function check_password_login($password){
		$email = $this->security->xss_clean($this->input->post('email'));
		$result = $this->login_model->check_user($email);
		if($result){
			//Проверка пароля
			if(password_verify($password, $result['password'])){
				//если все хорошо записываем данные в сессию
				$sess = array('username' => $result['firstname']);
       			$this->session->set_userdata('enter', $sess);
				return true;
			}else{
				$this->form_validation->set_message('check_password_login', 'Пользователя с таким email не существует либо введен не верно пароль!');
     			return false;
			}
		}else{
			$this->form_validation->set_message('check_password_login', 'Пользователя с таким email не существует либо введен не верно пароль!');
     		return false;
		}
	}
	//Выход
	function logout(){
   		$this->session->unset_userdata('enter');
   		session_destroy();
   		redirect('main', 'refresh');
 	}

}