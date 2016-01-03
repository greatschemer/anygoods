<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
 
  //Проверяем есть ли пользователь с там email
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

  //Создание пользователя
  public function add_user($insert){
    $this->db->insert('users', $insert);
    if ($this->db->affected_rows() > 0) {
      return true;
    }else {
      return false;
    }
  }

  public function check_user($email){
    $this->db->select('firstname, email, password');
    $this->db->from('users');
    $this->db->where('email', $email);
    $this->db->limit(1);
    $result = $this->db->get();

    if($result->num_rows() == 1){
      return $result->row_array();
    }else{
      return false;
    }
  }

}
?>