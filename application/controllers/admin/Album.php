<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();

		error_reporting(0);
		$this->load->library("session");
		$this->load->helper('url');
	}

	public function index(){
		$data['albumdata'] = $this->CRUD_model->get('','album','id','desc');
		$this->load->view("admin/album/list",$data);
	}

	public function add(){
		$data['videos'] = $this->CRUD_model->get('','video','id','desc');
		$this->load->view("admin/album/add",$data);
	}

	public function save(){
		$this->form_validation->set_rules('name', 'album Name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
			$array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {

			$name = $_POST['name'];
			$where='name="'.$name.'"';
			
			$album = $this->CRUD_model->get($where,'album');

			if(sizeof($album)>0){
				$res=array('status'=>'400','message'=>'album name is already exists.');
				echo json_encode($res);exit;	
			}
			
			if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '')
			{ 
				$album_image = $this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/album');
			}else
			{
				$res=array('status'=>'400','message'=>'Please select album image.');
				echo json_encode($res);exit;	
			}

			$data = array(
				'name' => $name,
				'image' => $album_image,
				'video_ids' => implode(',', $_POST['video_ids'])
			);
		
			$id=$this->CRUD_model->insert($data,'album');
			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$id);
			echo json_encode($res);exit;
		}
	}

	public function edit(){
		$where='id="'.$_GET['id'].'"';
		$data['videos'] = $this->CRUD_model->get('','video','id','desc');
		$data['album'] = $this->CRUD_model->getById($where,'album');
		$this->load->view("admin/album/edit",$data);
	}

	public function update(){
		$this->form_validation->set_rules('name', 'album Name', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $errors = validation_errors();
			$array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$name=$_POST['name'];
			$data = array(
				'name' => $name,
				'video_ids' => implode(',', $_POST['video_ids'])				
			);

			if(isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

				$data['image'] = $this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/album');
			}
		
			$cat_id=$this->CRUD_model->update($_POST['id'],'id',$data,'album');

			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$cat_id);
			echo json_encode($res);exit;
		}
	}

	public function getalbum()
	{
		$album = $this->CRUD_model->get('','album');
		$result = array('status'=>'200','message'=>'Get album Sucessfully','result'=>$album);
		echo json_encode($result);exit;
	}

	public function fetch_data(){  

    	$table = "album";
	  	$select_column = array("id","image","name", "created_at");  
	  	$order_column = array(null, "image", "name", "created_at");  
	  	$search = array("image","name", "created_at");

       	$fetch_data = $this->CRUD_model->make_datatables($table, $select_column,$order_column,$search);  
       	$data = array();  
       	foreach($fetch_data as $key=> $row)  
       	{	
       		$sub_array = array();  
           	$sub_array[] = '<span class="avatar-control"><img src="'.base_url().'assets/images/album/'.$row->image.'"  width="100" height="100" class="avatar-img" /></span>';  
            $sub_array[] = string_cut($row->name,15);
            $sub_array[] = dateformate($row->created_at);

            $sub_array[] = ' <a href="'.base_url().'admin/album/edit?id='.$row->id.'"><img src="'.base_url().'/assets/imgs/edit.png" /></a> <a href="javaScript:void(0)" onclick="delete_record('.$row->id.',\'album\')"><img src="'.base_url().'assets/imgs/trash.png" /></a>';
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
