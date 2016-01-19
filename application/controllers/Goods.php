<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Goods extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Сетка товаров';

        //Получение всех товаров
        $this->load->model('cart_model');
        $goods = $this->cart_model->getGoods();

        //Таблица товаров
        $data['content'] = $this->view_libraries->view('goods', array('goods' => $goods), true);
    }
}