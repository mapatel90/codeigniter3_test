<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }


    /*
    This is to create and update user
     */
    function saveUser($data, $id = ''){
 
        $response = array();
     
        // Select record
        if(isset($id) && $id!=''){
            $this->db->where('id', $id);
            $response = $this->db->update("users", $data);
        } else {
            $response = $this->db->insert("users", $data);
        }
        return $response;
    }

    /*
    This is to check email exist
    */
    public function check_email($email){

        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("email", $email);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /*
    Function to get user with token
    */
    public function get_user_with_token($token){
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("token", $token);
        $query = $this->db->get();
        return $query->row_array();
    }

    /*
    Function to get user with token
    */
    public function login($data){
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $data['password']);
        $query = $this->db->get();
        return $query->row_array();
    }

    /*
    Function to get active users
    */
    public function get_active_users(){
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("status", ACTIVE);
        $this->db->where("role", ROLE_USER);
        $result =  $this->db->get();
        return $result->num_rows();
    }
    
	
}
