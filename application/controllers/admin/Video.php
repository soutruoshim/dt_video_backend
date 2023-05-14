<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function __construct() {
		parent::__construct();
		frontendcheck();
	}
	public function index(){
		$data['category'] = $this->CRUD_model->get_all_active_category('video','category','category.id = video.category_id','category.*');

		$page_id = 1;
		$config["per_page"] = 15;
		
		if(isset($_GET['page']))
		{	
			$page_id=$_GET['page'];
		}
		$where = '';
		

		$type = '';
		if(isset($_GET['type']))
		{	
			$type=$_GET['type'];
			
			if($type == 'url')
			{
				$type = 'external';
			}else
			{
				$type = 'youtube';
			}
		}
		
		$category_id = 0;
		if(isset($_GET['category_id']))
		{	
			$category_id=$_GET['category_id'];
		}
		
		$name = '';
		if(isset($_GET['name']))
		{	
			$name=$_GET['name'];
		}

		$totla_record = 0;
		$totla_record = count($this->Admin_modal->get_videoList($category_id,$name,$type));

		$total_pages = 1;
		if($totla_record > 10)
		{
			$total_pages = ceil($totla_record / $config["per_page"]);
		}

		$pagination['page'] = $page_id;
		$pagination['total_pages'] = $total_pages;
		$pagination['totla_record'] = $totla_record;
		$pagination['per_page'] = $config["per_page"];
		
		$data['video'] = $this->Admin_modal->videoList($config["per_page"], $page_id,$category_id,$name,$type);
		$data['pagination'] = $pagination;

		$this->load->view("admin/video/list",$data);
	}

	public function add(){
		$data['categorylist'] = $this->CRUD_model->get('','category','id','desc');
		$data['artistlist'] = $this->CRUD_model->get('','artist','id','desc');
		$this->load->view("admin/video/add",$data);
	}

	public function save(){  
		$this->form_validation->set_rules('name', 'video name', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');
		$this->form_validation->set_rules('artist_id', 'artist', 'required');
		$this->form_validation->set_rules('is_feature', 'feature', 'required');
		$this->form_validation->set_rules('video_type', 'video type', 'required');
		$this->form_validation->set_rules('is_paid', 'is paid', 'required');

		if(isset($_POST['video_type']) && $_POST['video_type'] == 'video')
		{
			$this->form_validation->set_rules('mp3_file_name', 'video file', 'required');
		}

		if(isset($_POST['video_type']) && $_POST['video_type'] != 'video')
		{
			$this->form_validation->set_rules('url', 'video file', 'required');
		}

		if ($this->form_validation->run() == FALSE)
        {
            $errors = $this->form_validation->error_array();
            sort($errors);
			$array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$description = $_POST['description'];
			$category_id = $_POST['category_id'];
			$artist_id = $_POST['artist_id'];
			$is_feature = $_POST['is_feature'];
	        $name = $_POST['name'];

	        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '')
			{
				$image = $this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/video');
			}else
			{
				$array  = array('status'=>400,'message'=>array('Please Select Cover Poster'));
         		echo json_encode($array);exit;
			}

			if(isset($_POST['mp3_file_name']) && $_POST['mp3_file_name'] != ''){
				$video_url=$_POST['mp3_file_name'];
			}else{
				$video_url=$_POST['url'];
			}
			$is_paid = isset($_POST['is_paid']) ? $_POST['is_paid'] : 0;
			$data = array(
				'category_id' => $category_id,
				'is_feature' => $is_feature,
				'is_paid' => $is_paid,
				'artist_id' => $artist_id,	
				'name' => $name,	
				'description' => $description,
				'video_type'=>$_POST['video_type'],
				'url'=>$video_url,
				'image'=>$image,
			);

			// p($data);
			$video_id=$this->CRUD_model->insert($data,'video');
			$result=array("status"=>'200',"msg"=>'Sucessfully added video',"video_id"=>$video_id);
			echo json_encode($result);	
		}
	}

	public function edit(){
		$id=$_GET['id'];
		$data['categorylist'] = $this->CRUD_model->get('','category','id','desc');
		$data['artistlist'] = $this->CRUD_model->get('','artist','id','desc');
		$where='id="'.$id.'"';
		$data['video'] = $this->CRUD_model->getById($where,'video');
		$this->load->view("admin/video/edit",$data);
	}

	public function update(){
		$this->form_validation->set_rules('name', 'video name', 'required');
		$this->form_validation->set_rules('category_id', 'category', 'required');
		$this->form_validation->set_rules('artist_id', 'artist', 'required');
		$this->form_validation->set_rules('is_feature', 'feature', 'required');
		$this->form_validation->set_rules('video_type', 'video type', 'required');
		$this->form_validation->set_rules('is_paid', 'is paid', 'required');
		
		if ($this->form_validation->run() == FALSE)
        {
            $errors = $this->form_validation->error_array();
            sort($errors);
			$array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$v_id=$_POST['id'];
			
			$description = $_POST['description'];
			$category_id = $_POST['category_id'];
			$artist_id = $_POST['artist_id'];
			$is_feature = $_POST['is_feature'];
	        $name = $_POST['name'];

	        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '')
			{
				$image = $this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/video');
			}else
			{
				$image = $_POST['image_1'];
			}

			if($_POST['video_type'] == 'video')
			{
				if(isset($_POST['mp3_file_name']) && $_POST['mp3_file_name'] != ''){
					$url = $_POST['mp3_file_name'];
				}else{
					$url = $_POST['mp3_file_1'];
				}
			}
			else
			{
				$url = $_POST['url'];
			}

			$is_paid = isset($_POST['is_paid']) ? $_POST['is_paid'] : 0;

			$data = array(
				'category_id' => $category_id,
				'is_feature' => $is_feature,
				'is_paid' => $is_paid,
				'artist_id' => $artist_id,	
				'name' => $name,	
				'description' => $description,
				'video_type'=>$_POST['video_type'],
				'url'=>$url,
				'image'=>$image,
			);

			$video_id=$this->CRUD_model->update($v_id,'id',$data,'video');

			$result=array("status"=>200,"msg"=>'Successfully Updated.',"video_id"=>$video_id);
			echo json_encode($result);
		}	
	}
	
    public function videorename($mp3_file_name){
    
    	$targetDir =   FCPATH . 'assets/images/video';
    	$ext = pathinfo($mp3_file_name);
    	$catImages =  str_replace(' ', '_', $ext['filename']);
    	$new_name   = time().'.'.$ext['extension'];	
    	rename( $targetDir.'/'.$_POST['mp3_file_name'], $targetDir.'/'.$new_name) ; 
    	return $new_name;
    }

    public function update_video_status()
    {
    	$id = $_POST['id'];
    	$status = $_POST['status'];
    	if($status == 1)
    	{
    		$status = 0;	
    	}
    	else
    	{
    		$status = 1;
    	}

    	$data = array( 'status' => $status);
		$video_id=$this->CRUD_model->update($id,'id',$data,'video');
		$result=array("status"=>200,"msg"=>'Successfully Updated.',"video_id"=>$video_id,'video_status'=>$status);
		echo json_encode($result);	
    }
}