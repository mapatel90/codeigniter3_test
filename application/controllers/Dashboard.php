<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->model("User_model");
            $this->load->model("Product_model");
            $this->load->model("User_product_model");
    }

	public function index()
	{
                //This is to get active users
                $data = array();
                
                $products = $this->Product_model->get_active_product_list();
                $data['products'] = $products;

                $this->load->view('header');
                $this->load->view('dashboard/index', $data);
                $this->load->view('footer');
	}

    

    
}

