<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model{
 
  //Получение всех товаров
  public function getAllGoods(){
    $this->db->select('goods.title, id_category, categories.title as ctitle');
    $this->db->from('goods');
    $this->db->join('categories', 'categories.id = goods.id_category', 'left');
    $result = $this->db->get();

    return $result->result_array();
  
  }

  //Получение всех категорий и колл-во товаров в каждой
  public function getAllCategories(){
    $this->db->select('categories.id, categories.title, COUNT(goods.id) as total');
    $this->db->from('categories');
    $this->db->join('goods', 'goods.id_category = categories.id', 'left');
    $this->db->group_by('goods.id_category');
    $result = $this->db->get();

    return $result->result_array();

  }
  //Проверка существует ли категори
  public function check_category($id_category){
    $this->db->select('id');
    $this->db->from('categories');
    $this->db->where('id', $id_category);

    $result = $this->db->get();

    if($result->num_rows() > 0){
      return true;
    }else{
      return false;
    }
  }
  //Выводим товар определенной категории
  public function getGoodsCategory($id_category){
    $this->db->select('categories.title as ctitle, goods.title, goods.brand, goods.price');
    $this->db->where('id_category', $id_category);
    $this->db->from('goods');
    $this->db->join('categories', 'categories.id = goods.id_category', 'left');

    $result = $this->db->get();
    return $result->result_array();
  }
}
?>