<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorprofile extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();
	}

	public function profile(){

		$id = $_SESSION['id'];
		$where = 'id='.$id;
		$data['author'] = $this->CRUD_model->getById($where,'author');
		$this->load->view("admin/author/profile",$data);
	}

	public function update_profile(){
		$this->form_validation->set_rules('name', 'Author Name', 'required');
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
			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
				$author_image=$this->CRUD_model->imageupload($_FILES['image'],'image', FCPATH . 'assets/images/author');
				
			}else{
				$author_image=$_POST['authorimage'];	
			}

			$data = array(
				'name' => $name,
				'image' => $author_image,
				'address' => $_POST['address']
			);
			
			$this->session->set_userdata('image',$author_image);						

			$cat_id=$this->CRUD_model->update($_POST['id'],'id',$data,'author');	

			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$cat_id);
			echo json_encode($res);exit;
		}
	}


	public function bankdetail(){

		$id = $_SESSION['id'];
		$where = 'author_id='.$id;
		$data['bankdetail'] = $this->CRUD_model->getById($where,'bank_detail');
		$this->load->view("admin/author/bank_detail",$data);
	}

	public function update_bankdetail(){
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
        $this->form_validation->set_rules('account_no', 'Account No', 'required');
        $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');
        $this->form_validation->set_rules('bank_holder_name', ' Bank Holder Name', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
             $errors = $this->form_validation->error_array();
            sort($errors); 	
            $array  = array('status'=>400,'message'=>$errors);
         	echo json_encode($array);exit;
        }
        else
        {
			$bank_name=$_POST['bank_name'];
			$account_no=$_POST['account_no'];
			$ifsc_code=$_POST['ifsc_code'];
			$bank_holder_name=$_POST['bank_holder_name'];
			$author_id  = $_SESSION['id'];
			$id = $_POST['id'];
			
			$data = array(
				'bank_name' => $bank_name,
				'account_no' => $account_no,
				'ifsc_code' => $ifsc_code,
				'bank_holder_name' => $bank_holder_name,
				'author_id' => $author_id
			);
			
			if($id)
			{
				$cat_id=$this->CRUD_model->update($id,'id',$data,'bank_detail');	
			}else
			{
				$cat_id=$this->CRUD_model->insert($data,'bank_detail');	
			}

			$res=array('status'=>'200','message'=>'Sucessfully updated','id'=>$cat_id);
			echo json_encode($res);exit;
		}
	}


	public function dashboard()
	{
		$id = $_SESSION['id'];
		$data['dashboard'] = $this->CRUD_model->getAuthorEarning($id);

		$where = "id=".$id;
		$book = $this->CRUD_model->get($where,'book');
		$data['book']=sizeof($book);

		$this->load->view("admin/author/dashboard",$data);
	}

	public function sales_report()
	{
		$month = date('Y-m');
		if(isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '' &&  isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '') 
		{
			$start_date = date('Y-m-d', strtotime($_REQUEST['start_date']));
			$end_date = date('Y-m-d', strtotime($_REQUEST['end_date']));

			$start_date = $start_date.' 00:00:01';
			$end_date = $end_date.' 23:59:59';
			
		}else{
			$start_date = $month.'-01 00:00:01';
			$end_date = $month.'-31 23:59:59';
		}

		$id = $_SESSION['id'];
		$data['transaction'] = $this->CRUD_model->getSalesReport($id, $start_date, $end_date);

		$this->load->view("admin/transaction/salesreport",$data);
	}


	public function payout()
	{
		$id = $_SESSION['id'];
		$where = 'author_id ='.$id.' AND year='.date('Y');
		$data['payout'] = $this->CRUD_model->get($where,'payout');
		
		$where = 'author_id='.$id;
		$data['bankdetail'] = $this->CRUD_model->getById($where,'bank_detail');
		

		$month = date('Y-m');
		$start_date = $month.'-01 00:00:01';
		$end_date = $month.'-31 23:59:59';
	
		$data['settlement'] = $this->CRUD_model->getSalesReportMonth($id, $start_date, $end_date);
		// p($data);
		$this->load->view("admin/transaction/payout",$data);
	}
}
