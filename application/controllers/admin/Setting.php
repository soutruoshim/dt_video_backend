<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		$CI->load->library('session');
		frontendcheck();
	}
	
	public function index(){
		// Get SMTP Setting
		$smtpWhere='id="1"';
		$smtp_detail = $this->CRUD_model->getById($smtpWhere,'smtp_setting');
		$data['smtp_setting'] = $smtp_detail;

		// Get Setting List
		$data['settinglist'] = get_setting();

		// Get Setting List
		$data['currency'] = $this->CRUD_model->get('','currency');
		
		$where='id="'.$this->session->userdata('id').'"';
		$admin = $this->CRUD_model->getById($where,'artist');
		$data['admin'] = $admin;
		
		// Get Setting List
		$this->load->view("admin/settings/index",$data);
	}	

	public function save(){
		$data = $_POST;
		if (isset($_FILES['app_image']) && !empty($_FILES['app_image']['name'])) {
			$app_image_logo = $this->CRUD_model->imageupload($_FILES['app_image'],'app_image',FCPATH . 'assets/images/app');
			$data['app_logo'] = $app_image_logo;
		}

		foreach ($data as $key => $value) {
			if($value)
			{
				$array['value'] = $value;
				$result = $this->CRUD_model->update($key,'key',$array,'general_setting');
			}
		}

		$res=array('status'=>'200','message'=>'Sucessfully updated');
		echo json_encode($res);
	}

	public function save_smtp_setting()
	{
		if($_POST)
		{
			$data = $_POST;
			$id = 1;
			$added_id = $this->CRUD_model->update($id,'id',$data,'smtp_setting');
			if($added_id){
				$res=array('status'=>'200','message'=>'Update setting sucessfully','id'=>$added_id);
			}else{
				$res=array('status'=>'400','message'=>'Please try again');
			}
		}else
		{
			$res=array('status'=>'400','message'=>'The password and confirmation password do not match.');
		}
		echo json_encode($res);exit;
	}

	public function change_password(){
		// Get Setting List
		$data['settinglist'] = get_setting();

		$where='id="'.$this->session->userdata('id').'"';
		$admin = $this->CRUD_model->getById($where,'admin');
		$data['admin'] = $admin;
		
		// Get Setting List
		$this->load->view("admin/settings/change_password",$data);
	}

	public function save_change_password(){

        if (isset($_POST['password']) && $_POST['password'] != '') {
            $password  = $_POST['password'];
            $confirm_password  =$_POST['confirm_password'];
        
            $id = $_POST['id'];
            $data =  array('password' => md5($password));
            $res_id=$this->CRUD_model->update($id, 'id', $data, 'admin');

            if ($res_id) {
                $res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$res_id);
                echo json_encode($res);
            } else {
                $res=array('status'=>'400','message'=>'fail');
                echo json_encode($res);
            }
        }else{
			$res=array('status'=>'400','message'=>'Please enter password');
                echo json_encode($res);
		}
	}

	public function admob(){
		// Get SMTP Setting
		$smtpWhere='id="1"';
		$smtp_detail = $this->CRUD_model->getById($smtpWhere,'smtp_setting');
		$data['smtp_setting'] = $smtp_detail;

		// Get Setting List
		$data['settinglist'] = get_setting();
		
		// Get Setting List
		$this->load->view("admin/settings/admob",$data);
	}

	public function smtp(){
		// Get SMTP Setting
		$smtpWhere='id="1"';
		$smtp_detail = $this->CRUD_model->getById($smtpWhere,'smtp_setting');
		$data['smtp_setting'] = $smtp_detail;

		// Get Setting List
		$data['settinglist'] = get_setting();
		
		// Get Setting List
		$this->load->view("admin/settings/smtp",$data);
	}

	public function save_currency()
	{
		$id = $_POST['currency'];
		$data['status']  = 0;
		$result = $this->CRUD_model->update_currency();

		$status['status']  = 1;
		$result = $this->CRUD_model->update($id,'id',$status,'currency');

		if($result){
			$res=array('status'=>'200','message'=>'Sucessfully default currency');
			echo json_encode($res);
		}else{
			$res=array('status'=>'400','message'=>'fail');
			echo json_encode($res);
		}	
	}
}