<?php


class cart_model extends CI_Model {
    public function getGoods(){
        $this->db->select('categories.title as ctitle, goods.id, goods.title, goods.brand, goods.price, goods.count');
        $this->db->from('goods');
        $this->db->join('categories', 'categories.id = goods.id_category', 'left');

        $result = $this->db->get();
        return $result->result_array();
    }

    // вставка данных в таблицу
    public function addGoods($id)
    {
        $created_at = new DateTime();
        $data['created_at'] = $created_at->format('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}