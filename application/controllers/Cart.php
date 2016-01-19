<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//Если загружаем библиотеку корзина то библиотеку сессии можно не грузить (Надеюсь я правильно понял)
		$this->load->library('cart');
		$this->load->helper('url');
	}

	//Корзина
	public function index(){

		// Корзина пользователя
		$user_cart = $this->cart->contents();

		$data['cart'] = $this->view_libraries->view('cart', array('cart_items' => $user_cart), true);

	}

	//Добавить в корзину
	public function addToCart()
	{
		$data['title'] = 'Добавление товара в корзину';

		$id = $this->input->post('id');
		$count = $this->input->post('count');

		$this->load->model('main_model');
		$query = $this->cart_model->getInfoGood($id);

		if ($query) {

			foreach ($query->result() as $row) {

				$data2 = array(
						'id' => $id,
						'qty' => $count,
						'price' => $row->price,
						'name' => $row->title
				);

				$this->cart->insert($data2);


			}
			redirect('goods');
		}
	}

	//Обновить корзину
	public function updateCart(){

		$total = $this->cart->total_items();

		$item = $this->input->post('rowid');
		$qty = $this->input->post('qty');

		for($i=0;$i < $total;$i++)
		{
			$data = array(
					'id' => $item[$i],
					'qty' => $qty[$i]
			);

			$this->cart->update($data);
		}

		redirect('cart');
	}

	//Очистить корзину
	public function clearCart(){

		$this->cart->destroy();
		redirect('cart');

	}

	//Оформление заказа
	public function checkout(){

//		$data['title'] = 'Корзина';
//		if ($this->session->userdata('enter')) {
//			$session = $this->session->userdata('enter');
//			$data['username'] = $session['username'];
//		}
	}

}