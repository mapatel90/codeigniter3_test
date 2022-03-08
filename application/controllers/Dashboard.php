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

    public function attach_product(){

        $response = array();
        $response['status'] = 0;

        $post = $this->input->post();
        if(!empty($post)){

            $product_id = isset($post['product_id'])?$post['product_id']:'';
            $qty = isset($post['qty'])?$post['qty']:'';
            $price = isset($post['price'])?$post['price']:'';

            $data_product = array();
            $data_product['user_id'] = (isset($this->session->userdata['id']))?$this->session->userdata['id']:'';
            $data_product['product_id'] = $product_id;
            $data_product['qty'] = $qty;
            $data_product['price'] = $price;
            $data_product['created_at'] = date("Y-m-d H:i:s");

            $this->User_product_model->save($data_product);

            $response['status'] = 1;
            $response['success'] = "Product Attached Successfully.";
        }
        echo json_encode($response);exit;
    }

    public function attached_product_list(){
        $post = $this->input->post();

        if(!empty($post)){
            $user_id = (isset($this->session->userdata['id']))?$this->session->userdata['id']:'';
            $products = array();
            if(isset($user_id) && $user_id > 0){

                $products_count = $this->User_product_model->get_user_product_list($user_id, true);
                $products = $this->User_product_model->get_user_product_list($user_id);

                if(!empty($products)){
                    foreach($products as $key => $product){
                        $products[$key]['price'] = "$".$product['price'];
                    }
                }
            }

            $json_data = array(
                "draw" => intval($post['draw']),
                "recordsTotal" => intval($products_count),
                "recordsFiltered" => intval($products),
                "data" => $products,
            );
            echo json_encode($json_data);
            exit(0);
        }
        echo '<pre>';
        print_r($post);
        die;
    }
}

