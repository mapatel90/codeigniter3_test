<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
            $this->load->model("User_model");
    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function sign_up(){

        $response = array();
        $response['status'] = 0;
        $post = $this->input->post();
        if(!empty($post)){
            $this->load->helper('string');

            $activation_string = random_string('alnum', 32);

            $username = isset($post['username'])?$post['username']:'';
            $email = isset($post['email'])?$post['email']:'';
            $role = isset($post['role'])?$post['role']:'';
            $password = isset($post['password'])?$post['password']:'';
            $confirm_password = isset($post['confirm_password'])?$post['confirm_password']:'';

            //This is to save data in user
            $dataUser = array();
            $dataUser['role'] = $role;
            $dataUser['username'] = $username;
            $dataUser['email'] = $email;
            $dataUser['password'] = md5($password);
            $dataUser['token'] = $activation_string;
            $dataUser['status'] = INACTIVE;
            $dataUser['created_at'] = date("Y-m-d H:i:s");
            
            $result = $this->User_model->saveUser($dataUser);
            
            
            $this->load->library('email');
            
			$this->email->from(FROM_EMAIL, FROM_NAME);
			$this->email->to($email);
			$this->email->subject("Verify your email address to Test Codeigniter 3");

            $url = base_url("activation/".$activation_string);
			$message_email = '<p>Hi '.$username.' ,</p>';
			$message_email .= '<p>Please click on below link to verify <a href="'.$url.'">Click Here</a></p>';
			$this->email->message($message_email);
            $is_send = $this->email->send(true);

            if($result){
                $response['status'] = 1;
                $response['success'] = "User registered successfully.";
            } else {
                $response['error'] = "Something issue";
            }
            
            echo json_encode($response);exit;
        }

        $this->load->view('header');
        $this->load->view('user/sign_up');
        $this->load->view('footer');
    }

    /*
    Function to check Login
    */
    public function sign_in(){

        $response = array();
        $response['status'] = 0;
        $post = $this->input->post();
        if(!empty($post)){
            
            $email = isset($post['email'])?$post['email']:'';
            $password = isset($post['password'])?$post['password']:'';

            $dataUser['email'] = $email;
            $dataUser['password'] = md5($password);
            $result = $this->User_model->login($dataUser);

            if(!empty($result)){
                if(isset($result['status']) && $result['status'] == ACTIVE){

                    $this->session->set_userdata('logged_in', 1);
                    $this->session->set_userdata('role', $result['role']);
                    $this->session->set_userdata('username', $result['username']);
                    $this->session->set_userdata('email', $result['email']);
                    $this->session->set_userdata('id', $result['id']);

                    if(isset($result['role']) && $result['role'] == ROLE_ADMIN){
                        $redirect_url = base_url("admin/dashboard");
                    } else {
                        $redirect_url = base_url("dashboard");
                    }
                    
                    $response['status'] = 1;
                    $response['success'] = "User logged in successfully.";
                    $response['redirect_url'] = $redirect_url;

                } else if(isset($result['status']) && $result['status'] == INACTIVE){
                    $response['error'] = "Your email is not verified yet.";
                }
            } else {
                $response['error'] = "No user found with this login details.";
            }

            echo json_encode($response);exit;
        }

        $this->load->view('header');
        $this->load->view('user/sign_in');
        $this->load->view('footer');
    }
    
    /*
    Function to check email exist or not
     */
    public function check_email_exist(){
        $response = '';
        $post = $this->input->post();
        if(!empty($post)){
            $email = isset($post['email'])?$post['email']:'';

            $userCount = $this->User_model->check_email($email);
            if($userCount > 0){
                $response = false;
            }
            else {
                $response = true;
            }
        }
        echo json_encode($response);exit;
    }

    /*
    Function to verify user
     */
    public function user_activation($token)
    {
        //This is to check token exist
        if(isset($token) && $token != ''){
            $userDetails = $this->User_model->get_user_with_token($token);
            if(!empty($userDetails)){
                if(isset($userDetails['status']) && $userDetails['status'] == INACTIVE){
                    $updateUser = array();
                    $updateUser['token'] = '';
                    $updateUser['status'] = ACTIVE;
                    $result = $this->User_model->saveUser($updateUser, $userDetails['id']);
                    redirect(base_url('/sign_in'), 'refresh');
                }
            } else {
                echo "No user found with this token";exit;
            }
        } else {
            echo "Token is not exist";exit;
        }
    }

    /*
    Function to log out
    */
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('sign_in'));
        exit;
    }
}

