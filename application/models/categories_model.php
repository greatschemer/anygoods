<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model{

  //Получаем все категории
  public function getAllCategories(){
    $this->db->select('id, title');
    $this->db->where('is_delete', '0');
    $this->db->from('categories');
    $result = $this->db->get();

    if($result->num_rows() > 0){
      return $result->result_array();
    }else{
      return false;
    }
  }
  //Проверка есть ли такая категория в БД
  public function check_title($title){
    $this->db->select('title');
    $this->db->where('title', $title);
    $this->db->where('is_delete', '0');
    $this->db->from('categories');
    $this->db->limit(1);
    $result = $this->db->get();
    if($result->num_rows() > 0){
      return false;
    }else{
      return true;
    }
  }
  //Проверка id
  public function check_id($id){
    $this->db->select('id');
    $this->db->where('id', $id);
    $this->db->from('categories');
    $this->db->limit(1);
    $result = $this->db->get();
    if($result->num_rows() == 1){
      return true;
    }else{
      return false;
    }
  }
  //Добавление категории в БД
  public function add($insert){
    $this->db->insert('categories', $insert);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }
  //Получаем информацию о конкретной категори
  public function getInfo($id){
    $this->db->select('id, title');
    $this->db->where('id', $id);
    $this->db->from('categories');
    $this->db->limit(1);
    $result = $this->db->get();
    if($result->num_rows() == 1){
      return $result->row_array();
    }else{
      return false;
    }
  }
  //Обновление категории
  public function update($id, $update){
    $this->db->where('id', $id);
    $this->db->update('categories', $update);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }
  //Удаление категории
  public function delete($id){
    $update = array('is_delete' => '1');
    $this->db->where('id', $id);
    $this->db->update('categories', $update);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }
}