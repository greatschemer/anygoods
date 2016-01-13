<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//Если загружаем библиотеку корзина то библиотеку сессии можно не грузить (Надеюсь я правильно понял)
		$this->load->library('cart');
		$this->load->model('main_model');
		$this->load->model('cart_model');
	}
	//Корзина
	public function index(){
		$data['title'] = 'Корзина';
		if ($this->session->userdata('enter')) {
			$session = $this->session->userdata('enter');
			$data['username'] = $session['username'];
		}
		$this->view_libraries->view('cart', $data);
	}

	//Добавить в корзину
	public function addToCart($idGood){
		
		if(!empty($idGood) || is_numeric($idGood)){
			//Проверка товара
			if($this->main_model->check_goods($idGood)){
				//добавление товара
				//Тут пишем логику добавление товара в сессию через Shopping Cart Class

				//Редирект обратно если товар добавлен
				if($this->agent->referrer()){
    				redirect($this->agent->referrer());
    			}else{
     				redirect(base_url());
     			}
			}else{
				//Если нет такого товара в БД
				$data['title'] = 'Ошибка';
				$data['error'] = 'Товар не найден';
				$data['link'] = '';
				$this->view_libraries->view_error($data);
			}
			
		}else{
			//Если передаем пустое значение или оно не число
			redirect(base_url());
		}
	}

	//Обновить корзину
	public function updateCart(){

	}

	//Очистить корзину
	public function clearCart(){

	}
	//Оформление заказа
	public function checkout(){

	}

}