<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	
        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
                $this->load->model("Product_model");
                $this->load->model("User_product_model");
        }

        public function index()
        {
                $post = $this->input->post();

                $product_count = $this->Product_model->get_product_list(true);
                $products = $this->Product_model->get_product_list();

                if(!empty($products)){
                        foreach($products as $key => $product){
                                $action = "<input type='button' class='btn btn-success' value='Attach' >";
                                $products[$key]['action'] = $action;
                        }
                }

                $json_data = array(
                        "draw" => intval($post['draw']),
                        "recordsTotal" => intval($product_count),
                        "recordsFiltered" => intval($products),
                        "data" => $products,
                    );
                echo json_encode($json_data);
                exit(0);
        }

        public function attached_product_list(){
                $post = $this->input->post();
        
                if(!empty($post)){
                    $user_id = (isset($this->session->userdata['id']))?$this->session->userdata['id']:'';
                    $products = array();
                    if(isset($user_id) && $user_id > 0){


                        $search_txt = isset($post['search']['value'])?$post['search']['value']:'';
                        $order_field = isset($post['order'][0]['column'])?$post['order'][0]['column']:'';
                        $order_dir = isset($post['order'][0]['dir'])?$post['order'][0]['dir']:'';
                        $start = isset($post['start'])?$post['start']:'';
                        $length = isset($post['length'])?$post['length']:'';

                        $param = array();
                        $param['search_txt'] = $search_txt;
                        $param['order_field'] = $order_field;
                        $param['order_dir'] = $order_dir;
                        $param['start'] = $start;
                        $param['length'] = $length;
        
                        $products_count = $this->User_product_model->get_user_product_list($user_id, true, $param);
                        $products = $this->User_product_model->get_user_product_list($user_id, false, $param);
        
                        if(!empty($products)){
                            foreach($products as $key => $product){
                                $products[$key]['price'] = "$".$product['price'];
                            }
                        }
                    }
        
                    $json_data = array(
                        "draw" => intval($post['draw']),
                        "recordsTotal" => intval($products_count),
                        "recordsFiltered" => intval($products_count),
                        "data" => $products,
                    );
                    echo json_encode($json_data);
                    exit(0);
                }
                echo '<pre>';
                print_r($post);
                die;
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

    
}

