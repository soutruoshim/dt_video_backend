<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaction extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		$CI->load->library('session');
		frontendcheck();
	}

	public function index(){

		$id = $_SESSION['id'];
		$where = 'author_id='.$id;

		$table1= "transaction";
		$table2= "book"; 
		$table3= "user"; 
		$joinid1= "transaction.book_id=book.id"; 
		$joinid2= "transaction.user_id = user.id";
		$field = "transaction.*,user.fullname,book.title";
		$data['transaction'] = $this->CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field);
		$this->load->view("admin/transaction/transaction",$data);

	}
}