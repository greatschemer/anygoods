<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
 
  //Проверяем есть ли пользователь с там email
  public function check_user($email){
    $this->db->select('firstname, email, password');
    $this->db->from('users');
    $this->db->where('email', $email);
    $this->db->where('active', '2');
    $this->db->limit(1);
    $result = $this->db->get();

    if($result->num_rows() == 1){
      return $result->row_array();
    }else{
      return false;
    }
  }
  //Проверяем есть ли такой пользователь
  public function check_email($email){
    $this->db->select('email');
    $this->db->from('users');
    $this->db->where('email', $email);
    $result = $this->db->get();

    if($result->num_rows() > 0){
      return false;
    }else{
      return true;
    }

  }
  //Получаем всех пользователей
  public function getAllUsers(){
    $this->db->select('id, firstname, lastname, bdate, email, active, regdate');
    $this->db->where('active !=', '0');
    $this->db->from('users');
    $result = $this->db->get();

    if($result->num_rows() > 0){
      return $result->result_array();
    }else{
      return false;
    }
  }
  //Создание пользователя - дублирую с main_model не знаю пока зачем =)
  public function add_user($insert){
    $this->db->insert('users', $insert);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }
  //Проверка id
  public function check_id($id){
    $this->db->select('id');
    $this->db->where('id', $id);
    $this->db->from('users');
    $this->db->limit(1);
    $result = $this->db->get();
    if($result->num_rows() == 1){
      return true;
    }else{
      return false;
    }
  }
  public function getInfo($id){
    $this->db->select('id, firstname, lastname, email, bdate, active');
    $this->db->where('id', $id);
    $this->db->from('users');
    $this->db->limit(1);
    $result = $this->db->get();
    if($result->num_rows() == 1){
      return $result->row_array();
    }else{
      return false;
    }
  }
  public function update($id, $update){
    $this->db->where('id', $id);
    $this->db->update('users', $update);
    if($this->db->affected_rows() > 0){
      return true;
    }else {
      return false;
    }
  }
  public function delete($id){
    $update = array('active' => '0');
    $this->db->where('id', $id);
    $this->db->update('users', $update);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }
}