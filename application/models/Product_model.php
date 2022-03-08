<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function get_product_list($count = false){
        $this->db->select("*");
        $this->db->from("products");
        $result = $this->db->get();

        if(isset($count) && $count == true){
            return $result->num_rows();
        } else {
            return $result->result_array();
        }
        
    }

    public function get_active_product_list($count = false){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("status", ACTIVE);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_product_details($id){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("id", $id);
        $result = $this->db->get();
        return $result->row_array();
    }
    
	
}
