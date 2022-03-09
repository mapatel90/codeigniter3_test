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

                if(!empty($post))
                {
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

                        $product_count = $this->Product_model->get_product_list(true, $param);
                        $products = $this->Product_model->get_product_list(false, $param);

                        if(!empty($products)){
                                foreach($products as $key => $product){
                                        $action = "<a href='".base_url("admin/product/seller/".$product['id'])."' class='btn btn-success'>Seller</a>";
                                        $products[$key]['action'] = $action;
                                        $products[$key]['created_at'] = date("d/m/y H:i:s", strtotime($product['created_at']));
                                }
                        }

                        $json_data = array(
                                "draw" => intval($post['draw']),
                                "recordsTotal" => intval($product_count),
                                "recordsFiltered" => intval($product_count),
                                "data" => $products,
                        );
                        echo json_encode($json_data);
                        exit(0);
                }

                
        }

        public function seller($id){

                $data = array();
                $data['id'] = $id;

                //This is to get product details
                $product = $this->Product_model->get_product_details($id);
                $data['product'] = $product;

                $this->load->view('header');
                $this->load->view('admin/product/seller', $data);
                $this->load->view('footer');
        }

        public function attached_product_list($id){
                $post = $this->input->post();
                if(!empty($post)){
                        
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

                        $user_product_count = $this->User_product_model->get_product_seller_list($id, true, $param);
                        $user_product_list = $this->User_product_model->get_product_seller_list($id, false, $param);

                        if(!empty($user_product_list)){
                                foreach($user_product_list as $key => $product){
                                        $user_product_list[$key]['price'] = '$'.$product['price'];
                                        $user_product_list[$key]['total'] = '$'.$product['total'];
                                        $user_product_list[$key]['created_at'] = date('m/d/Y H:i:s', strtotime($product['created_at']));
                                }
                        }

                        $json_data = array(
                                "draw" => intval($post['draw']),
                                "recordsTotal" => intval($user_product_count),
                                "recordsFiltered" => intval($user_product_count),
                                "data" => $user_product_list,
                            );
                        echo json_encode($json_data);
                        exit(0);
                }
        }

    
}

