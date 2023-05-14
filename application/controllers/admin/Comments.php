<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();
	}

	public function index(){
	    $field = 'comment.*,book.title';
		$joinid = 'book.id = comment.book_id';
		$data['comments'] = $this->CRUD_model->get_join_allrecord('comment','book',$joinid,$field);
		$this->load->view("admin/comment/list",$data);
	}

	public function update(){
		$id = $_POST['id'];
		
		if($_POST['status'] == '1')
    	{
    		$status = '0';	
    	}
    	else
    	{
    		$status = '1';
    	}
    	$data = array( 'status' => $status);
		$res_id=$this->CRUD_model->update($id,'id',$data,'comment');
		
		if($res_id){
			$res=array('status'=>'200','msg'=>'Update status Sucessfully',
				'id'=>$id,'book_status'=>$status);
			echo json_encode($res);exit;
		}else{
			$res=array('status'=>'400','msg'=>'Please try again','book_status'=>$status);
			echo json_encode($res);exit;
		}
	}	
}