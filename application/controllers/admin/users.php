<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('admin_model');
	}
	
	public function index(){
		if ($this->session->userdata('administrator')) {
			$session = $this->session->userdata('administrator');
			$data['title'] = 'Админ панель - Пользователи';
			$data['users'] = $this->admin_model->getAllUsers();
			$data['useradmin'] = $session['useradmin'];
			$this->view_libraries->view_admin('users/body', $data);
		}else{
			redirect(base_url() . 'admin/login');
		}
	}

	//Создание пользователя
	public function add(){
		if ($this->session->userdata('administrator')) {
			$session = $this->session->userdata('administrator');
			$data['title'] = 'Админ панель - пользователи - Добавление пользователя';
			$data['useradmin'] = $session['useradmin'];
			
			if($this->input->post('add')){
				$this->form_validation->set_rules('firstname', 'Имя', 'trim|required');
				$this->form_validation->set_rules('lastname', 'Фамилия', 'trim|required');
				$this->form_validation->set_rules('bdate', 'Дата рождения', 'trim');
				$this->form_validation->set_rules('active', 'Тип пользователя', 'trim');
				$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_check_email_reg');
				$this->form_validation->set_rules('pass1', 'Пароль', 'trim|required|min_length[6]|callback_check_password');

				if($this->form_validation->run() == FALSE){
					//Загрузка вида и выводим ошибки
	     			$this->view_libraries->view_admin('users/add', $data);
	     		}else{
	     			//Если валидация прошла
	     			$firstname = $this->security->xss_clean($this->input->post('firstname'));
	     			$lastname = $this->security->xss_clean($this->input->post('lastname'));
	     			$bdate = $this->security->xss_clean($this->input->post('bdate'));
	     			$email = $this->security->xss_clean($this->input->post('email'));
	     			$active = $this->security->xss_clean($this->input->post('active'));
	     			$password = $this->security->xss_clean($this->input->post('pass1'));
	     			$datetime = new DateTime();
	     			
	     			$inset = array(
	     				'firstname' => $firstname,
	     				'lastname' => $lastname,
	     				'bdate' => $bdate,
	     				'email' => $email,
	     				'active' => $active,
	     				'password' => password_hash($password, PASSWORD_BCRYPT),
	     				'regdate' => $datetime->format('Y-m-d')
	     			);
	     			//Добавляем данные в БД
	     			if($this->admin_model->add_user($inset)){
	     				$this->session->set_flashdata('success', 'Пользователь успешно добавлен!');
	     				redirect(base_url().'admin/users');
	     			}else{
	     				$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     					redirect(base_url().'admin/users');
	     			}
	     		}
			}else{
				$this->view_libraries->view_admin('users/add', $data);
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
	}

	//Редактирование пользователя
	public function edit($id = null){
		if($this->session->userdata('administrator')){
			//Если id введен и он числоb и такое id есть в базе
			if(!empty($id) && is_numeric($id) && $this->checkId($id)){

				$session = $this->session->userdata('administrator');
				$data['useradmin'] = $session['useradmin'];
				//Получаем информацию о пользователе
				$data['info'] = $this->admin_model->getInfo($id);
				$data['title'] = 'Админ панель - пользователи - Редактирование';
				//Если была нажата кнопка сохранить
				if($this->input->post('save')){
					$this->form_validation->set_rules('firstname', 'Имя', 'trim|required');
					$this->form_validation->set_rules('lastname', 'Фамилия', 'trim|required');
					$this->form_validation->set_rules('bdate', 'Дата рождения', 'trim');
					$this->form_validation->set_rules('active', 'Тип пользователя', 'trim');
					$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_check_email_reg['.$data['info']['email'].']');
	
					if($this->form_validation->run() == FALSE){
						//Загрузка вида и выводим ошибки
	     				$this->view_libraries->view_admin('users/edit', $data);
					}else{
					//Обновляем данные БД
					//Если валидация прошла
	     			$firstname = $this->security->xss_clean($this->input->post('firstname'));
	     			$lastname = $this->security->xss_clean($this->input->post('lastname'));
	     			$bdate = $this->security->xss_clean($this->input->post('bdate'));
	     			$email = $this->security->xss_clean($this->input->post('email'));
	     			$active = $this->security->xss_clean($this->input->post('active'));
	     			$datetime = new DateTime();
	     			
	     			$update = array(
	     				'firstname' => $firstname,
	     				'lastname' => $lastname,
	     				'bdate' => $bdate,
	     				'email' => $email,
	     				'active' => $active,
	     				'lastupdate' => $datetime->format('Y-m-d')
	     			);
					if($this->admin_model->update($id, $update)){
						$this->session->set_flashdata('success', 'Категория успешно Обновлена!');
     					redirect(base_url().'admin/users');
					}else{
						$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     					redirect(base_url().'admin/users');
					}
				}
				}else{
					
					$this->view_libraries->view_admin('users/edit', $data);
				}

			}else{
				redirect(base_url().'admin/users');
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
		
	}

	public function checkId($id){
		$result = $this->admin_model->check_id($id);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function check_email_reg($email, $info = null){
		if($this->admin_model->check_email($email) || $email == $info){
			return true;
		}else{
			$this->form_validation->set_message('check_email_reg', 'Пользователь с таким email('.$email.') уже зарегистрирован!');
     		return false;
		}
	}

	public function check_password($password1){
		$password2 = $this->security->xss_clean($this->input->post('pass2'));
		if($password1 == $password2){
			return true;
		}else{
			$this->form_validation->set_message('check_password', 'Пароли не совпадают!');
			return false;
		}
	}
	//Удаление категории
	public function delete($id){
		if($this->session->userdata('administrator')){
			//Если id введен и он числоb и такое id есть в базе
			if(!empty($id) && is_numeric($id)){
				
				if($this->admin_model->delete($id)){
					$this->session->set_flashdata('success', 'Запись успешно удалена!');
     				redirect(base_url().'admin/users');
				}else{
					$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     				redirect(base_url().'admin/users');
				}
			}else{
				redirect(base_url().'admin/users');
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
	}
}