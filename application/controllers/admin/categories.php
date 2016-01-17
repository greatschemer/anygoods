<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->model('categories_model');
	}
	
	public function index(){
		if ($this->session->userdata('administrator')) {
			$session = $this->session->userdata('administrator');
			$data['title'] = 'Админ панель - Категории';
			$data['categories'] = $this->categories_model->getAllCategories();
			$data['useradmin'] = $session['useradmin'];
			$this->view_libraries->view_admin('categories/body', $data);
		}else{
			redirect(base_url() . 'admin/login');
		}
	}

	//Добавление категории
	public function add(){
		if ($this->session->userdata('administrator')) {
			$session = $this->session->userdata('administrator');
			$data['title'] = 'Админ панель - Категории - Добавление товара';
			$data['useradmin'] = $session['useradmin'];
			
			if($this->input->post('add')){
				$this->form_validation->set_rules('title', 'Название категории', 'trim|required|callback_checkTitle');
				if($this->form_validation->run() == FALSE){
					//Если не прошла валидация грузим вид
					$this->view_libraries->view_admin('categories/add', $data);
				}else{
					//Добавляем данные в БД
					$title = $this->security->xss_clean($this->input->post('title'));
					$insert = array('title' => $title);
					if($this->categories_model->add($insert)){
						$this->session->set_flashdata('success', 'Категория успешно добавлена!');
     					redirect(base_url().'admin/categories');
					}else{
						$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     					redirect(base_url().'admin/categories');
					}
				}
			}else{
				$this->view_libraries->view_admin('categories/add', $data);
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
	}
	//Редактирование категории
	public function edit($id = null){
		if($this->session->userdata('administrator')){
			//Если id введен и он числоb и такое id есть в базе
			if(!empty($id) && is_numeric($id) && $this->checkId($id)){

				$session = $this->session->userdata('administrator');
				$data['useradmin'] = $session['useradmin'];
				//Получаем информацию о товаре
				$data['info'] = $this->categories_model->getInfo($id);
				$data['title'] = 'Админ панель - Категории - Редактирование';
				//Если была нажата кнопка сохранить
				if($this->input->post('save')){
					//если не произведены изменения
					if($this->security->xss_clean($this->input->post('title')) == $data['info']['title']){
						$this->session->set_flashdata('success', 'Категория успешно Обновлена!');
     					redirect(base_url().'admin/categories');
					}

					$this->form_validation->set_rules('title', 'Название категории', 'trim|required|callback_checkTitle');
					if($this->form_validation->run() == FALSE){
						//Если не прошла валидация грузим вид

						$this->view_libraries->view_admin('categories/edit', $data);
					}else{
					//Обновляем данные БД
					$title = $this->security->xss_clean($this->input->post('title'));
					$update = array('title' => $title);
					if($this->categories_model->update($id, $update)){
						$this->session->set_flashdata('success', 'Категория успешно Обновлена!');
     					redirect(base_url().'admin/categories');
					}else{
						$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     					redirect(base_url().'admin/categories');
					}
				}
				}else{
					
					$this->view_libraries->view_admin('categories/edit', $data);
				}

			}else{
				redirect(base_url().'admin/categories');
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
		
	}
	//Удаление категории
	public function delete($id){
		if($this->session->userdata('administrator')){
			//Если id введен и он числоb и такое id есть в базе
			if(!empty($id) && is_numeric($id)){
				
				if($this->categories_model->delete($id)){
					$this->session->set_flashdata('success', 'Запись успешно удалена!');
     				redirect(base_url().'admin/categories');
				}else{
					$this->session->set_flashdata('success', 'Произошла системная ошибка!');
     				redirect(base_url().'admin/categories');
				}
			}else{
				redirect(base_url().'admin/categories');
			}
		}else{
			redirect(base_url() . 'admin/login');
		}
	}

	//Проверка есть ли такой тайтл
	public function checkTitle($title){
		$title = $this->security->xss_clean($this->input->post('title'));
		$result = $this->categories_model->check_title($title);
		if($result){
			return true;
		}else{
			$this->form_validation->set_message('checkTitle', 'Категория "' . $title . '" уже существует');
			return false;
		}
	}

	//Проверка id
	public function checkId($id){
		$result = $this->categories_model->check_id($id);
		if($result){
			return true;
		}else{
			return false;
		}
	}
}