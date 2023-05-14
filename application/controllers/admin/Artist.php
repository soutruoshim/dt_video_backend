<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();

		error_reporting(0);
		$this->load->library("session");
		$this->load->helper('url');
	}

	public function index(){
		$data['artistlist'] = $this->CRUD_model->get('','artist','id','desc');
		$this->load->view("admin/artist/list",$data);
	}

	public function add(){
		$this->load->view("admin/artist/add");
	}

	public function save(){
		$this->form_validation->set_rules('name', 'artist Name', 'required');
        $this->form_validation->set_rules('bio', 'Bio ', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = $this->form_validation->error_array();
            sort($errors);
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '')
			{ 
				$artist_image = $this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/artist');
			}else
			{
				$res=array('status'=>'400','message'=>array('Please select artist image.'));
				echo json_encode($res);exit;	
			}

			$bio = '';
			if(isset($_POST['bio']) && $_POST['bio'] != '')
			{
				$bio = $_POST['bio'];
			}else
			{
				$res=array('status'=>'400','message'=>array('Please select artist image.'));
				echo json_encode($res);exit;		
			}



			$data = array(
				'name' => $_POST['name'],
				'image' => $artist_image,
				'bio' => $_POST['bio'],
				'address' => $_POST['address']
			);

			$id=$this->CRUD_model->insert($data,'artist');
			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);exit;
		}
	}

	public function edit(){
		$where='id="'.$_GET['id'].'"';
		$data['artist'] = $this->CRUD_model->getById($where,'artist');
		$this->load->view("admin/artist/edit",$data);
	}

	public function update(){
		$this->form_validation->set_rules('name', 'artist Name', 'required');
        $this->form_validation->set_rules('bio', 'Bio ', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == FALSE)
        {
             $errors = $this->form_validation->error_array();
            sort($errors); 	
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$name=$_POST['name'];
			
			$data = array(
				'name' => $name,
			
				'bio' => $_POST['bio'],
				'address' => $_POST['address']
			);

			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
				$data['image']=$this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/artist');
				
			}
			
			$cat_id=$this->CRUD_model->update($_POST['id'],'id',$data,'artist');	

			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$cat_id);
			echo json_encode($res);exit;
		}
	}

	public function fetch_data(){  

    	$table = "artist";
	  	$select_column = array("id","image","name", "bio");  
	  	$order_column = array(null, "name", "bio");  
	  	$search = array('name','bio');
	  	$where = '';
       	$fetch_data = $this->CRUD_model->make_datatables($table, $select_column,$order_column,$search,$where);  
       	$data = array();  
       	foreach($fetch_data as $key=> $row)  
       	{  
            $sub_array = array();  
           	$sub_array[] = '<span class="avatar-control"><img src="'.base_url().'assets/images/artist/'.$row->image.'"  width="50" height="35" class="avatar-img"  /></span>';  
            $sub_array[] = string_cut($row->name,15);
            $sub_array[] = string_cut(strip_tags($row->bio),70);  
             $sub_array[] = ' <a href="'.base_url().'admin/artist/edit?id='.$row->id.'"><img src="'.base_url().'/assets/imgs/edit.png" /></a> <a href="javaScript:void(0)" onclick="delete_record('.$row->id.',\'artist\')"><img src="'.base_url().'assets/imgs/trash.png" /></a>';
           
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
