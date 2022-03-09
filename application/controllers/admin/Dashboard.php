<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->model("User_model");
            $this->load->model("Product_model");
    }

	public function index()
	{
                //this is to check user is login or admin user
                
                if(!isset($this->session->userdata['logged_in']) || $this->session->userdata['logged_in'] == ''){
                        redirect(base_url('sign_in'));
                        exit;
                } else if(isset($this->session->userdata['role']) && $this->session->userdata['role'] == ROLE_USER){
                        redirect(base_url('sign_in'));
                        exit;
                }
                //This is to get active users
                $data = array();
                
                //This is to get active users
                $active_users = $this->User_model->get_active_users();
                $data['active_users'] = $active_users;

                //This is to get active user with attached product
                $active_users_with_attached_product = $this->User_model->get_active_users_with_attached_product();
                $data['active_users_with_attached_product'] = $active_users_with_attached_product;

                //This is to get active products
                $active_products = $this->Product_model->get_active_product_list(true);
                $data['active_products'] = $active_products;

                $active_products_without_users = $this->Product_model->get_active_product_without_user_attach(true);
                $data['active_products_without_users'] = $active_products_without_users;

                //This is to get amount of active product
                $amount_of_active_product = $this->Product_model->get_amount_of_active_products();
                $data['amount_of_active_product'] = $amount_of_active_product;

                $total_price_of_active_product = $this->Product_model->get_total_price_of_active_products();
                $data['total_price_of_active_product'] = $total_price_of_active_product;
                

                $this->load->view('header');
                $this->load->view('admin/dashboard/index', $data);
                $this->load->view('footer');
	}

    
}

