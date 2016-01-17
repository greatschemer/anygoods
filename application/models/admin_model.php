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
  
}