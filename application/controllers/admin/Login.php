<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
	}

	public function index(){

		if($this->session->userdata('id')) {
			redirect(base_url().'admin/dashboard');
		}else{
			
			$this->load->view("admin/login/login");
		}
	}

	public function adminlogin(){
		
		$email= $this->input->post('email');
		$password= $this->input->post('password');
		$where='password="'.md5($password).'" and email="'.$email.'"';

		$result = $this->CRUD_model->getById($where,'tbl_admin');


		if(isset($result->id)) {
			$this->session->set_userdata('email',$result->email);
			$this->session->set_userdata('id',$result->id);	
			$this->session->set_userdata('name',$result->name);
			
			$where_status = 'status=1'; 
			$currency = $this->CRUD_model->getById($where_status,'currency');
			if(isset($currency->code))
			{
				$this->session->set_userdata('currency_code',$currency->code);
				$this->session->set_userdata('currency_symbol',$currency->symbol);						
	
			}
			else{
				$where_status = 'code="INR"'; 
				$currency = $this->CRUD_model->getById($where_status,'currency');

				$this->session->set_userdata('currency_code',$currency->code);
				$this->session->set_userdata('currency_symbol',$currency->symbol);						
		}

			
			$result = array('status'=>200,'message'=>"Login successfully");
			echo json_encode($result);exit;
		

		} else {
			$result = array('status'=>400,'message'=>"User name and password is incorrect");
			echo json_encode($result);exit;
		}
	}

	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('name');
		redirect(base_url().'admin/login');
	}

}
