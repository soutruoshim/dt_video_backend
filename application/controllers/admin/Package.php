<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Package extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library("session");
		$this->load->helper('url');
	}

	/*====================== Package =============================*/

	public function index()
	{
		$data['packages'] = $this->CRUD_model->get('', 'package');

		$this->load->view("admin/package/list", $data);
	}

	public function add()
	{
		$this->load->view("admin/package/add");
	}

	public function save()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('time', 'time', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array  = array('status' => 400, 'message' => $errors);
			echo json_encode($array);
			exit;
		} else {

			$data = $_POST;

			if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
				$data['image'] = $this->CRUD_model->imageupload($_FILES['image'], 'image', FCPATH . 'assets/images/package');
			} else {
				$res = array('status' => '400', 'message' => array('Please select package image'));
				echo json_encode($res);
				exit;
			}


			$id = $this->CRUD_model->insert($data, 'package');

			if ($id) {
				$res = array('status' => '200', 'message' => 'New package create.', 'id' => $id);
				echo json_encode($res);
				exit;
			} else {
				$res = array('status' => '400', 'message' => 'Package not save ');
				echo json_encode($res);
				exit;
			}
		}
	}

	public function edit()
	{
		$id = $_GET['id'];
		$where = 'id="' . $id . '"';
		$data['package'] = $this->CRUD_model->getById($where, 'package');
		$this->load->view("admin/package/edit", $data);
	}

	public function update()
	{

		$this->form_validation->set_rules('name', 'package name', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('type', 'type', 'required');
		$this->form_validation->set_rules('time', 'time', 'required');
		if ($this->form_validation->run() == FALSE) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array  = array('status' => 400, 'message' => $errors);
			echo json_encode($array);
			exit;
		} else {

			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$price = isset($_POST['price']) ? $_POST['price'] : 0;
			$type = isset($_POST['type']) ? $_POST['type'] : '';
			$time = isset($_POST['time']) ? $_POST['time'] : 0;
			$product_package = isset($_POST['product_package']) ? $_POST['product_package'] : '';

			if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {

				$image = $this->CRUD_model->imageupload($_FILES['image'], 'image', FCPATH . 'assets/images/package');
			} else {
				$image = $_POST['packageimage'];
			}
			$id = $_POST['id'];


			$data = array(
				'name' => $name,
				'price' => $price,
				'type' => $type,
				'time' => $time,
				'image ' => $image,
				'product_package ' => $product_package,
			);

			$id = $this->CRUD_model->update($id, 'id', $data, 'package');

			if ($id) {
				$res = array('status' => '200', 'message' => 'Update package success', 'id' => $id);
				echo json_encode($res);
				exit;
			} else {
				$res = array('status' => '400', 'message' => 'fail');
				echo json_encode($res);
				exit;
			}
		}
	}
	/*======================End Package=============================*/

	public function fetch_data()
	{
		$table = "package";
		$select_column = array("id", "name", 'time', 'type', "price", "image", "product_package", "created_at");
		$order_column = array(null, "name", "price", 'time', 'type', "image", "product_package", "created_at");
		$search = array("name", "price", 'time', 'type', "image", "created_at");

		$fetch_data = $this->CRUD_model->make_datatables($table, $select_column, $order_column, $search);

		$data = array();
		foreach ($fetch_data as $key => $row) {
			$base_url = base_url();
			$sub_array = array();
			$sub_array[] = $row->name;
			$sub_array[] = $row->time;
			$sub_array[] = $row->type;
			$sub_array[] = $row->price;
			$sub_array[] = '<img src="' . base_url() . 'assets/images/package/' . $row->image . '"  width="50" height="35" />';
			$sub_array[] = $row->product_package;
			$sub_array[] = ' <a href="' . base_url() . 'admin/package/edit?id=' . $row->id . '"><img src="' . $base_url . '/assets/imgs/edit.png" /></a> <a href="javaScript:void(0)" onclick="delete_record(' . $row->id . ',\'package\')"><img src="' . $base_url . 'assets/imgs/trash.png" /></a>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"             => intval($_POST["draw"]),
			"recordsTotal"     => $this->CRUD_model->get_all_data($table),
			"recordsFiltered"  => $this->CRUD_model->get_filtered_data($table, $select_column, $order_column, $search = null),
			"data"             => $data
		);
		echo json_encode($output);
	}
}