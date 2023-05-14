<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();

		error_reporting(0);
		$this->load->library("session");
		$this->load->helper('url');
	}

	public function index(){
		$data['page'] = $this->CRUD_model->get('','page','id','desc');
		$this->load->view("admin/page/list",$data);
	}

	public function edit(){
		$where='id="'.$_GET['id'].'"';
		$data['page'] = $this->CRUD_model->getById($where,'page');
		$this->load->view("admin/page/edit",$data);
	}

	public function update(){
		// $this->form_validation->set_rules('page_name', 'page_name', 'required');
        $this->form_validation->set_rules('title', 'title ', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        if ($this->form_validation->run() == FALSE)
        {
             $errors = $this->form_validation->error_array();
            sort($errors); 	
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$data = array(
				'title' => $_POST['title'],
				'description' => $_POST['description']
			);
			
			$cat_id=$this->CRUD_model->update($_POST['id'],'id',$data,'page');	

			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$cat_id);
			echo json_encode($res);exit;
		}
	}

	public function fetch_data(){  

    	$table = "page";
	  	$select_column = array("id","title","page_name");  
	  	$order_column = array(null, "page_name", "title");  
	  	$search = array('page_name','title');
	  	$where = '';
	  	
		
       	$fetch_data = $this->CRUD_model->make_datatables($table, $select_column,$order_column,$search,$where);  
       	$data = array();  
       	foreach($fetch_data as $key=> $row)  
       	{  
            $sub_array = array();
            $sub_array[] = string_cut($row->page_name,100);
            $sub_array[] = string_cut($row->title,100);  
            $sub_array[] = ' <a href="'.base_url().'admin/page/edit?id='.$row->id.'"><img src="'.base_url().'/assets/imgs/edit.png" /></a>';
            // $sub_array[] = '<a href="'.base_url().'admin/page/edit?id='.$row->id.'"><i class="fa fa-edit"> </i></a>';
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
