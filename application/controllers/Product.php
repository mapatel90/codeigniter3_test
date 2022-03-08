<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	
        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
                $this->load->model("Product_model");
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

    
}

