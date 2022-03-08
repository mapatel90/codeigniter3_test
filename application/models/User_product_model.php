<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function save($data){

        return $this->db->insert("user_products", $data);
    }

    public function get_user_product_list($user_id, $count= false)
    {
        $this->db->select("user_products.*, products.title, products.image, products.status");
        $this->db->from("user_products");
        $this->db->join("products", "products.id = user_products.product_id", "LEFT");
        $this->db->where("user_id", $user_id);
        $result  = $this->db->get();
        if(isset($count) && $count == true){
            return $result->num_rows();
        } else {
            return $result->result_array();
        }
    }

}
