<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$CI =& get_instance();
		frontendcheck();
	}

	public function sales_report()
	{
		$month = date('Y-m');
		$author_id = '';
		if(isset($_REQUEST['start_date']) && $_REQUEST['start_date'] != '' &&  isset($_REQUEST['end_date']) && $_REQUEST['end_date'] != '') 
		{
			$author_id = isset($_REQUEST['author_id']) ? $_REQUEST['author_id'] : '';

			$start_date = date('Y-m-d', strtotime($_REQUEST['start_date']));
			$end_date = date('Y-m-d', strtotime($_REQUEST['end_date']));

			$start_date = $start_date.' 00:00:01';
			$end_date = $end_date.' 23:59:59';
		}else{
			$start_date = $month.'-01 00:00:01';
			$end_date = $month.'-31 23:59:59';
		}

		$id = $_SESSION['id'];
		$where = 'role_id=2';	
		$data['author'] = $this->CRUD_model->get($where,'author');

		$data['transaction'] = $this->CRUD_model->getSalesReport($author_id, $start_date, $end_date);

		$this->load->view("admin/report/salesreport",$data);
	}


	public function settlement()
	{
		$month = date('Y-m');
		$Year = date('Y');
		$author_id = isset($_REQUEST['author_id']) ? $_REQUEST['author_id'] : '';

		if(isset($_REQUEST['month'])) 
		{	
			$start_date = $Year.'-'.$_REQUEST['month'].'-01 00:00:01';
			$end_date = $Year.'-'.$_REQUEST['month'].'-31 23:59:59';
		}else{
			$start_date = $month.'-01 00:00:01';
			$end_date = $month.'-31 23:59:59';
		}

		$id = $_SESSION['id'];
		$where = 'role_id=2';	
		$data['author'] = $this->CRUD_model->get($where,'author');

		$data['settlement'] = $this->CRUD_model->getSalesReportMonth($author_id, $start_date, $end_date);
		// p($data['settlement']);
		$this->load->view("admin/report/settlement",$data);
	}

	public function settlement_update()
	{

		$month = $_POST['month'];
		$author_id = $_POST['author_id'];
		$year = date('Y')	;
		$authorSettlement= [];
		foreach ($author_id as $value) {
			$author_id = $value;
			$start_date = $year.'-'.$month.'-01 00:00:01';
			$end_date = $year.'-'.$month.'-31 23:59:59';
			$transaction = $this->CRUD_model->getSalesReport($author_id, $start_date, $end_date);	
			$sum = 0;	
			foreach ($transaction as $row) {
				$sum +=  $row->amount - $row->author_commission_amount;
				$settle['settle'] = 1;
				$this->CRUD_model->update($row->id,'id',$settle,'transaction');
			}

			if(count($transaction) > 0)
			{
				$payout = array();
				$payout['amount'] = $sum;
				$payout['author_id'] = $author_id;
				$payout['payment_method'] = 1;
				$payout['year'] = date('Y');
				$payout['settlement_month'] = $month;
				
				$this->CRUD_model->insert($payout,'payout');
			}
		}

		$arrray = array('status'=>200,'message'=>"Settlement successfully");
		echo json_encode($arrray);exit;
	}

	public function payout()
	{
		$year = date('Y');
		$field = 'payout.*,author.name';
		$table1='payout';
		$table2='author';
		$where = 'year='.$year;
		$joinid = 'payout.author_id=author.id';
		$data['payout'] = $this->CRUD_model->get_join_allrecord($table1, $table2, $joinid, $field, $where );
		$this->load->view("admin/report/payout",$data);
	}
}
