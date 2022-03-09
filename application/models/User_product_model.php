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

    public function get_user_product_list($user_id, $count= false, $param = array())
    {
        $this->db->select("user_products.*, products.title, products.image, IF(products.status = 1, 'Active', 'Inactive') as status");
        $this->db->from("user_products");
        $this->db->join("products", "products.id = user_products.product_id", "LEFT");
        $this->db->where("user_id", $user_id);

        if(isset($param['search_txt']) && $param['search_txt'] !=''){
            $search_txt = $param['search_txt'];
            $this->db->group_start();
            $this->db->like("products.id", $search_txt);
            $this->db->or_like("products.title", $search_txt);
            $this->db->or_like("IF(products.status = 1, 'Active', 'Inactive')", $search_txt);
            $this->db->or_like("products.image", $search_txt);
            $this->db->or_like("user_products.price", $search_txt);
            $this->db->or_like("user_products.qty", $search_txt);
            $this->db->group_end();
        }
        
        if(isset($count) && $count == true){

            $result  = $this->db->get();
            return $result->num_rows();
        } else {

            //THis is for ordering
            $columns = array("products.id", 
                                "products.title",
                                "products.image",
                                "user_products.qty",
                                "user_products.price",
                                "products.status",
                                "user_products.created_at");
            if(isset($param['order_field']) && $param['order_field'] !='' && isset($param['order_dir']) && $param['order_dir'] !='' ){
                $this->db->order_by($columns[$param['order_field']], $param['order_dir']);
            }

            //This is for pagination
            if(isset($param['start']) && $param['start']!='' && isset($param['length']) && $param['length'] !=''){
                $this->db->limit($param['length'], $param['start']);
            }

            $result  = $this->db->get();
            return $result->result_array();
        }
    }


    public function get_product_seller_list($product_id, $count= false, $param = array())
    {
        $this->db->select("user_products.*, products.title, products.image, IF(products.status = 1, 'Active', 'Inactive') as status, users.username, (user_products.qty * user_products.price) as total");
        $this->db->from("user_products");
        $this->db->join("products", "products.id = user_products.product_id", "LEFT");
        $this->db->join("users", "users.id = user_products.user_id", "LEFT");
        $this->db->where("user_products.product_id", $product_id);
        
        if(isset($param['search_txt']) && $param['search_txt'] !=''){
            $search_txt = $param['search_txt'];
            $this->db->group_start();
            $this->db->like("users.username", $search_txt);
            $this->db->or_like("products.title", $search_txt);
            $this->db->or_like("IF(products.status = 1, 'Active', 'Inactive')", $search_txt);
            $this->db->or_like("products.image", $search_txt);
            $this->db->or_like("user_products.price", $search_txt);
            $this->db->or_like("user_products.qty", $search_txt);
            $this->db->group_end();
        }
        
        if(isset($count) && $count == true){
            $result  = $this->db->get();
            return $result->num_rows();
        } else {

            //THis is for ordering
            $columns = array("user_products.id", 
                                "users.username",
                                "products.title",
                                "products.image",
                                "user_products.qty",
                                "user_products.price",
                                "total",
                                "products.status",
                                "user_products.created_at");
            if(isset($param['order_field']) && $param['order_field'] !='' && isset($param['order_dir']) && $param['order_dir'] !='' ){
                $this->db->order_by($columns[$param['order_field']], $param['order_dir']);
            }

            //This is for pagination
            if(isset($param['start']) && $param['start']!='' && isset($param['length']) && $param['length'] !=''){
                $this->db->limit($param['length'], $param['start']);
            }

            $result  = $this->db->get();
            return $result->result_array();
        }
    }

}
