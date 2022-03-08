<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->model("User_model");
    }

	public function index()
	{
                //this is to check user is login or admin user
                
                if(!isset($this->session->userdata['logged_in']) || $this->session->userdata['logged_in'] == ''){
                        redirect(base_url('sign_in'));
                        exit;
                } else if(isset($this->session->userdata['role']) && $this->session->userdata['role'] == ROLE_USER){
                        echo "Test";exit;
                        redirect(base_url('sign_in'));
                        exit;
                }
                //This is to get active users
                $data = array();
                
                $active_users = $this->User_model->get_active_users();
                $data['active_users'] = $active_users;

                $this->load->view('header');
                $this->load->view('admin/dashboard/index', $data);
                $this->load->view('footer');
	}

    
}

