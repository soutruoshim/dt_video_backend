<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
	}

	public function delete_record(){
		$id=$_POST['id'];
		$tablename=$_POST['tablename'];
		$this->CRUD_model->delete_all($id,'id',$tablename);
		return true;
	}
}
