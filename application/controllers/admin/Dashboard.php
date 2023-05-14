<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		
		frontendcheck();

	}

	public function index(){
		/*for Book Count*/

		$category = $this->CRUD_model->getCount('','category');
		
		$data['category']=$category->total;

		$video = $this->CRUD_model->getCount('','video');
		$data['video']=$video->total;

		$user = $this->CRUD_model->getCount('','user');
		$data['user']=$user->total;

		$artist = $this->CRUD_model->getCount('','artist');
		$data['artist']=$artist->total;
		
		$package = $this->CRUD_model->getCount('','package');
		$data['package']=$package->total;
			
		/*for category Count*/
		// $earning = $this->CRUD_model->getAdminAuthorEarning();
		$data['earning'] = 10;
		$data['settinglist'] = get_setting();

		$this->load->view("admin/dashboard/dashboard", $data);

	}
}
