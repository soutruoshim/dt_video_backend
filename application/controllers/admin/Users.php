<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		$CI->load->library('session');
		frontendcheck();

		error_reporting(0);
		$this->load->library("session");
		$this->load->helper('url');
	}


	public function index(){
		$where = 'role_id != 1';
		$data['userlist'] = $this->CRUD_model->get($where,'user','id','desc');
		$this->load->view("admin/user/list",$data);
	}

	public function add(){
		$this->load->view("admin/user/add");
	}

	public function save(){
		$this->form_validation->set_rules('fullname', 'User Fullname', 'required');
		$this->form_validation->set_rules('email', 'User email', 'required');
		$this->form_validation->set_rules('password', 'User password', 'required');
		$this->form_validation->set_rules('mobile', 'User mobile', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	$errors = $this->form_validation->error_array();
            sort($errors); 	
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
        	$password =  isset($_POST['password']) ? $_POST['password'] : '';
        	unset($_POST['password']);

			$data = $_POST;

			if($password)
        	{
        		$data['password'] = md5($password);
        	}

			$where = 'email="'.$data['email'].'" ';
			$user = $this->CRUD_model->get($where,'user');

			if(sizeof($user)>0){
				$res=array('status'=>'400','msg'=>'Email is already exists.');
				echo json_encode($res);exit;	
			}

			$where = 'mobile = "'.$data['mobile'].'" ';
			$user = $this->CRUD_model->get($where,'user');

			if(isset($user->id)){
				$res=array('status'=>'400','msg'=>'Mobile Number is already exists.');
				echo json_encode($res);exit;	
			}

			$id = $this->CRUD_model->insert($data,'user');
			$res=array('status'=>'200','msg'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);exit;
		}
	}

	public function edit(){
		$id=$_GET['id'];
		$where='id="'.$id.'"';
		$data['userlist'] = $this->CRUD_model->getById($where,'user');
		$this->load->view("admin/user/edit",$data);
	}

	public function update(){
		$this->form_validation->set_rules('fullname', 'User Fullname', 'required');
		$this->form_validation->set_rules('email', 'User email', 'required');
		$this->form_validation->set_rules('mobile', 'User mobile', 'required');
        if ($this->form_validation->run() == FALSE)
        {
        	$errors = $this->form_validation->error_array();
            sort($errors); 	
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
        	$password =  isset($_POST['password']) ? $_POST['password'] : '';
        	unset($_POST['password']);
        	
			$data =$_POST;	

			if($password)
        	{
        		$data['password'] = md5($password);
        	}

			$id= $this->input->post('id');

			$id=$this->CRUD_model->update($id,'id',$data,'user');
		
			if($id){
				$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$id);
				echo json_encode($res);exit;
			}else{
				$res=array('status'=>'400','message'=>'failed','id'=>$id);
				echo json_encode($res);exit;
			}
		}
	}

	public function transaction(){
		$field ='transaction.*, user.fullname, author.name as author_name';
		$joinid1 ='user.id = transaction.user_id';
		$joinid2 ='author.id = transaction.author_id';
		$data['transaction'] = $this->CRUD_model->get_two_join_allrecord('transaction', 'user','author', $joinid1, $joinid2, $field);
		$this->load->view("admin/user/transaction",$data);
	}

	public function fetch_data(){  

    	$table = "user";
	  	$select_column = array("id","image","fullname", "email","mobile","type","created_at");  
	  	$order_column = array(null, "fullname", "mobile", "created_at");  
	  	$search = array("image","fullname", "email","mobile","created_at");

       	$fetch_data = $this->CRUD_model->make_datatables($table, $select_column,$order_column,$search);  
       	$data = array();  
       	foreach($fetch_data as $key=> $row)  
       	{  
       		$base_url = base_url();
            $sub_array = array();  
			$image = get_image_path($row->image,'user');
			
            $sub_array[] = '<span class="avatar-control"><img src="'.$image .'"  width="100" height="100" class="avatar-img" />'.string_cut($row->fullname,15).'</span>';
            $sub_array[] = string_cut($row->email,15);  
            $sub_array[] = $row->mobile;  
            $type = '';
            if($row->type == 1){
            	$type = 'Normal';
            }else
            {
            	$type = 'Social';
            }
            $sub_array[] =$type;

            $sub_array[] = dateformate($row->created_at);
            $sub_array[] = ' <a href="'.base_url().'admin/users/edit?id='.$row->id.'"><img src="'.$base_url.'/assets/imgs/edit.png" /></a> <a href="javaScript:void(0)" onclick="delete_record('.$row->id.',\'user\')"><img src="'.$base_url.'assets/imgs/trash.png" /></a>';
            $data[] = $sub_array;  
       	}
       	$output = array(  
            "draw"             => intval($_POST["draw"]),  
            "recordsTotal"     => $this->CRUD_model->get_all_data($table),  
            "recordsFiltered"  => $this->CRUD_model->get_filtered_data($table,$select_column,$order_column,$search=null),  
            "data"             => $data  
       	);  
       	echo json_encode($output);  
    }
}