<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    public function get_product_list($count = false, $param = array()){
        
        $this->db->select("*, IF(products.status = 1, 'Active', 'Inactive') as status");
        $this->db->from("products");
        
        if(isset($param['search_txt']) && $param['search_txt'] !=''){
            $search_txt = $param['search_txt'];
            $this->db->group_start();
            $this->db->like("products.title", $search_txt);
            $this->db->or_like("products.description", $search_txt);
            $this->db->or_like("products.image", $search_txt);
            $this->db->or_like("IF(products.status = 1, 'Active', 'Inactive')", $search_txt);
            $this->db->group_end();
        }

        if(isset($count) && $count == true){
            $result = $this->db->get();
            return $result->num_rows();
        } else {

            //THis is for ordering
            $columns = array("products.id", 
                                "products.title",
                                "products.description",
                                "products.image",
                                "products.status",
                                "products.created_at");
            if(isset($param['order_field']) && $param['order_field'] !='' && isset($param['order_dir']) && $param['order_dir'] !='' ){
                $this->db->order_by($columns[$param['order_field']], $param['order_dir']);
            }

            //This is for pagination
            if(isset($param['start']) && $param['start']!='' && isset($param['length']) && $param['length'] !=''){
                $this->db->limit($param['length'], $param['start']);
            }

            $result = $this->db->get();
            return $result->result_array();
        }
        
    }

    public function get_active_product_list($count = false){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("status", ACTIVE);
        $result = $this->db->get();
        if(isset($count) && $count == true){
            return $result->num_rows();
        } else {
            return $result->result_array();
        }
    }

    public function get_active_product_without_user_attach($count = false){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("status", ACTIVE);
        $this->db->where("ID NOT IN (SELECT DISTINCT product_id from user_products)");
        $result = $this->db->get();
        if(isset($count) && $count == true){
            return $result->num_rows();
        } else {
            return $result->result_array();
        }
    }

    public function get_product_details($id){
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("id", $id);
        $result = $this->db->get();
        return $result->row_array();
    }
    
    /*
    Function to get amount of active product based on user
    */
    public function get_amount_of_active_products()
    {
        $this->db->select("SUM(user_products.qty) as amount");
        $this->db->from("products");
        $this->db->join("user_products", "user_products.product_id = products.id", "INNER");
        $this->db->where("products.status", ACTIVE);
        $result = $this->db->get();
        $row = $result->row_array();
        return isset($row['amount'])?$row['amount']:0;
        
    }

    /*
    Function to get total Price of active product based on user
    */
    public function get_total_price_of_active_products()
    {
        $this->db->select("SUM(user_products.qty * user_products.price) as amount");
        $this->db->from("products");
        $this->db->join("user_products", "user_products.product_id = products.id", "INNER");
        $this->db->where("products.status", ACTIVE);
        $result = $this->db->get();
        $row = $result->row_array();
        return isset($row['amount'])?$row['amount']:0;
        
    }
	
}
