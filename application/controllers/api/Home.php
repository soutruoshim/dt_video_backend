<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('API_CRUD_model');
		$this->load->library('email');
	}

	public function categorylist()
	{
		$result = $this->API_CRUD_model->get('', 'category');

		$rk = array();
		foreach ($result as $row) {
			$row->image = base_url() . 'assets/images/category/' . $row->image;
			$rk[] = $row;
		}

		if (sizeof($rk) > 0) {
			$response = array('status' => 200, 'message' => 'Success', 'result' => $rk);
		} else {
			$response = array('status' => 400, 'message' => 'Sorry, we could not find any matches.<br>Please try again.', 'result' => $rk);
		}
		echo json_encode($response);
	}

	public function artistlist()
	{
		$result = $this->API_CRUD_model->get('', 'artist');

		$rk = array();
		foreach ($result as $row) {
			$row->image = base_url() . 'assets/images/artist/' . $row->image;
			$rk[] = $row;
		}

		if (sizeof($rk) > 0) {
			$response = array('status' => 200, 'message' => 'Record get successfully', 'result' => $rk);
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
	}

	public function artist_profile()
	{
		$this->form_validation->set_rules('id', 'id', 'required');
		if ($this->form_validation->run() == false) {
			$array = array('status' => 400, 'message' => "Please enter required field");
			echo json_encode($array);
			exit;
		}

		$where = 'id=' . $_REQUEST['id'];

		$result = $this->API_CRUD_model->getById($where, 'artist');
		if (isset($result->id)) {
			$result->image = base_url() . 'assets/images/artist/' . $result->image;

			$data = $this->API_CRUD_model->getvideoCount($_REQUEST['id']);
			$result->is_follow = 0;
			$result->total_followers = 0;
			if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {
				$whereArtist = 'artist_id= ' . $_REQUEST['id'] . ' AND user_id=' . $_REQUEST['user_id'];
				$follow = $this->API_CRUD_model->getById($whereArtist, 'follow');
				if (isset($follow->id)) {
					$result->is_follow = 1;
				}
			}
			$whereFollow = 'artist_id= ' . $_REQUEST['id'];
			$follow = $this->API_CRUD_model->get($whereFollow, 'follow');
			$result->total_followers = count($follow);

			$result->total_video = "0";
			$result->total_view = "0";
			$result->total_like = "0";
			if (isset($data)) {
				$result->total_video =  isset($data->total_video) ? $data->total_video : "0";
				$result->total_view = isset($data->total_view) ? $data->total_view : "0";
				$result->total_like = isset($data->total_like) ? $data->total_like : "0";
			}
			$response = array('status' => 200, 'message' => 'artist profile successfully', 'result' => $result);
			echo json_encode($response);
		} else {
			$response = array('status' => 400, 'message' => 'artist profile successfully', 'result' => array());
			echo json_encode($response);
		}
	}

	public function getImagePathVideo($result)
	{
		$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
		$rk = [];
		foreach ($result as $row) {

			$avg = $this->API_CRUD_model->avg_rating($row->id);
			if ($avg->average > 0) {
				$row->avg_rating = number_format($avg->average, 2);
			} else {
				$row->avg_rating = "0";
			}

			$row->is_like = 0;
			if ($user_id) {
				$where_like = 'video_id=' . $row->id . ' AND user_id=' . $user_id;
				$like = $this->API_CRUD_model->getById($where_like, 'like');

				if (isset($like->id)) {
					$row->is_like = 1;
				}
			}
			$row->is_bookmark = 0;
			if ($user_id) {
				$where_favorite = 'video_id=' . $row->id . ' AND user_id=' . $user_id;
				$favorite = $this->API_CRUD_model->getById($where_favorite, 'favorite');

				if (isset($favorite->id)) {
					$row->is_bookmark = 1;
				}


				$row->is_follow = 0;
				$row->total_followers = 0;

				$whereArtist = 'artist_id= ' . $row->artist_id . ' AND user_id=' . $user_id;
				$follow = $this->API_CRUD_model->getById($whereArtist, 'follow');
				if (isset($follow->id)) {
					$row->is_follow = 1;
				}

				$whereFollow = 'artist_id= ' . $row->artist_id;
				$follow = $this->API_CRUD_model->get($whereFollow, 'follow');
				$row->total_followers = count($follow);
			}

			if (isset($row->artist_image) && $row->artist_image != "") {
				$row->artist_image = base_url() . 'assets/images/artist/' . $row->artist_image;
			}

			if (isset($row->package_image) && $row->package_image != "") {
				$row->package_image = base_url() . 'assets/images/package/' . $row->package_image;
			}

			if (isset($row->category_image) && $row->category_image != "") {
				$row->category_image = base_url() . 'assets/images/category/' . $row->category_image;
			}

			if (isset($row->image) && $row->image != '') {

				$row->image = base_url() . 'assets/images/video/' . $row->image;
			}

			if (isset($row->url) && $row->url != '') {
				if ($row->video_type == 'video') {
					$row->url = base_url() . 'assets/images/video/' . $row->url;
				}
			}

			$rk[] = $row;
		}

		return $rk;
	}

	public function videolist()
	{

		$where = 'status=1';
		$result = $this->API_CRUD_model->get($where, 'video');

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			$response = array('status' => 200, 'message' => 'Record get successfully', 'result' => $results);
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
	}

	public function latestvideos()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$where = 'video.status=1';
		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where, 'video.created_at', 'DESC');

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function video_list()
	{
		$where = '';
		$table = 'video';
		$data['page_no'] = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
		$data['page_limit'] = isset($_REQUEST['page_limit']) ? $_REQUEST['page_limit'] : 10;
		// Join data
		$joinArray[] = ['join' => 'artist.id=video.artist_id', 'table' => 'artist'];
		$joinArray[] = ['join' => 'category.id=video.category_id', 'table' => 'category'];

		if ($where) {
			$where = array($where);
		}
		$data['field'] = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$data['table'] = $table;
		$data['joins'] = $joinArray;
		$data['where'] = $where;
		$result = $this->API_CRUD_model->get_join_pagination($data);

		if (count($result['result']) > 0) {

			$results = $this->getImagePathVideo($result['result']);
			$response = array('status' => 200, 'message' => 'Record get successfully', 'result' => $result['result'], 'total_record' => $result['total_record']);
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
	}

	public function mostviewvideos()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$where = 'video.status=1';
		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where, 'video.v_view', 'DESC');

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function featurevideos()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';

		$is_feature = isset($_REQUEST['is_feature']) ? $_REQUEST['is_feature'] : 0;
		$where = 'video.is_feature=' . $is_feature;

		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where);

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function video_by_category()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$category_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : '';

		$where = '';
		if ($category_id) {
			$where = 'video.category_id=' . $category_id;
		}

		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where);

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function video_by_artist()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$artist_id = isset($_REQUEST['artist_id']) ? $_REQUEST['artist_id'] : '';

		$where = '';
		if ($artist_id) {
			$where = 'video.artist_id=' . $artist_id;
		}

		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where);

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function video_by_id()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
		$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';

		$where = '';
		if ($id) {
			$where = 'video.id=' . $id;
		}

		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where);

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$results[0]->is_subscription = 0;
				if ($user_id) {
					$where = 'user_id=' . $user_id;
					$transaction = $this->API_CRUD_model->get($where, 'transaction');
					if (count($transaction) > 0) {
						$results[0]->is_subscription = 1;
					}
				}

				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function related_item()
	{

		$field = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
		$table1 = 'video';
		$table2 = 'category';
		$table3 = 'artist';
		$joinid1 = 'category.id = video.category_id';
		$joinid2 = 'artist.id = video.artist_id';
		$category_id = isset($_REQUEST['category_id']) ? $_REQUEST['category_id'] : '';

		$where = '';
		if ($category_id) {
			$where = 'video.category_id=' . $category_id;
		}

		$result = $this->API_CRUD_model->get_two_join_allrecord($table1, $table2, $table3, $joinid1, $joinid2, $field, $where);

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function add_view()
	{
		if ($_REQUEST['id']) {

			$id = $_REQUEST['id'];
			$add_point = 1;
			$result = $this->API_CRUD_model->updateByIdWithcount($id, 'v_view', $add_point, 'video');

			if ($result) {
				$response = array('status' => 200, 'message' => 'Success', 'result' => array());
			} else {
				$response = array('status' => 400, 'message' => 'View not update', 'result' => array());
			}
			echo json_encode($response);
			exit;
		} else {
			$response = array('status' => 400, 'message' => 'Please enter id', 'result' => array());
			echo json_encode($response);
		}
	}

	public function add_favorite()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('video_id', 'artist_id', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$user_id = $_REQUEST['user_id'];
		$video_id = $_REQUEST['video_id'];

		$where_dele = 'user_id=' . $user_id . ' and video_id="' . $video_id . '"';

		$resultr_con = $this->API_CRUD_model->getById($where_dele, 'favorite');

		if (isset($resultr_con->id)) {

			$user_id = $this->API_CRUD_model->delete($where_dele, 'favorite');
			$response = array('status' => 200, 'message' => 'favorite Remove', 'user_id' => (string)$user_id);
		} else {
			$data = array(
				'user_id' => $user_id,
				'video_id' => $video_id
			);
			$user_id = $this->API_CRUD_model->insert($data, 'favorite');
			$response = array('status' => 200, 'message' => 'favorite Added Success', 'user_id' => (string)$user_id);
		}

		echo json_encode($response);
		exit;
	}

	public function checkfavorite()
	{
		if (isset($_REQUEST['user_id']) && $_REQUEST['video_id']) {
			$user_id = $_REQUEST['user_id'];
			$video_id = $_REQUEST['video_id'];

			$where_dele = 'user_id=' . $user_id . ' and video_id="' . $video_id . '"';

			$resultr_con = $this->API_CRUD_model->getById($where_dele, 'favorite');

			if (isset($resultr_con->id)) {

				$response = array('status' => 200, 'message' => 'Video is favorite', 'result' => "");
			} else {
				$response = array('status' => 400, 'message' => 'Video is not favorite', 'result' => "");
			}
		} else {
			$response = array('status' => 400, 'message' => $this->lang->line('required_field'));
		}
		echo json_encode($response);
		exit;
	}

	public function favorite_list()
	{

		if (isset($_REQUEST['user_id'])) {
			$user_id = $_REQUEST['user_id'];

			$result = $this->API_CRUD_model->get_favorite_list_video($user_id);

			$results = array();
			if (count($result)) {
				$results = $this->getImagePathVideo($result);
			}

			if (count($results) > 0) {
				$response = array('status' => 200, 'message' => "Record get successfully", 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => "Record not found", 'result' => array());
			}
			echo json_encode($response);
			exit;
		} else {
			$response = array('status' => 400, 'message' => "Please enter required field", 'result' => array());
			echo json_encode($response);
			exit;
		}
	}

	public function general_setting()
	{

		$user_id = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';
		$auth_token = isset($_REQUEST['auth_token']) ? $_REQUEST['auth_token'] : '';

		if ($user_id) {
			$where = 'auth_token="' . $auth_token . '" AND id=' . $user_id;
			$result = $this->API_CRUD_model->get($where, 'user');

			if (empty($result)) {
				$response = array('status' => 400, 'message' => 'Sorry, we could not find matches auth token.');
				echo json_encode($response);
				exit;
			}
		}

		$result = $this->API_CRUD_model->get('', 'general_setting');

		foreach ($result as $key => $set) {

			if ($set->key == 'app_logo') {
				$result[$key]->value = base_url() . 'assets/images/app/' . $result[$key]->value;
			}
			$setn[$set->key] = $set->value;
		}

		$where = 'status=1';
		$currency = $this->API_CRUD_model->getById($where, 'currency');
		if (isset($currency->id)) {
			$data[0]['id'] = "101";
			$data[1]['id'] = "101";
			$data[2]['id'] = "103";
			$data[3]['id'] = "104";
			$data[4]['id'] = "105";
			$data[5]['id'] = "106";

			$data[0]['key'] = 'currency_name';
			$data[1]['key'] = 'currency_symbol';
			$data[2]['key'] = 'currency_code';
			$data[3]['key'] = 'tram-and-conditions';
			$data[4]['key'] = 'privacy-policy';
			$data[5]['key'] = 'about-us';

			$data[0]['value'] = $currency->name;
			$data[1]['value'] = $currency->symbol;
			$data[2]['value'] = $currency->code;
			$data[3]['value'] = base_url() . 'page/tram-and-conditions';
			$data[4]['value'] = base_url() . 'page/privacy-policy';
			$data[5]['value'] = base_url() . 'page/about-us';

			$result = (array)$result;

			$rows = array_merge($result, $data);
		} else {
			$data[0]['id'] = "104";
			$data[1]['id'] = "105";
			$data[2]['id'] = "106";

			$data[0]['key'] = 'tram-and-conditions';
			$data[1]['key'] = 'privacy-policy';
			$data[2]['key'] = 'about-us';

			$data[0]['value'] = base_url() . 'page/tram-and-conditions';
			$data[1]['value'] = base_url() . 'page/privacy-policy';
			$data[2]['value'] = base_url() . 'page/about-us';

			$result = (array)$result;

			$rows = array_merge($result, $data);
			$rows = (array)$result;
		}

		if (sizeof($result) > 0) {

			$response = array('status' => 200, 'message' => 'Success', 'result' => $rows);
		} else {

			$response = array('status' => 400, 'message' => 'Sorry, we could not find any matches.<br>Please try again.', 'result' => $result);
		}
		echo json_encode($response);
	}

	public function add_transaction()
	{
		$user_id = isset($_REQUEST['user_id']) ?  $_REQUEST['user_id'] : '';
		$video_id = isset($_REQUEST['video_id']) ? $_REQUEST['video_id'] : '';
		$package_id = isset($_REQUEST['package_id']) ? $_REQUEST['package_id'] : '';
		$currency_code = isset($_REQUEST['currency_code']) ? $_REQUEST['currency_code'] : "";
		$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : '';
		$state = isset($_REQUEST['state']) ? $_REQUEST['state'] : '';
		$amount =  isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';

		$payment_id = isset($_REQUEST['payment_id']) ? $_REQUEST['payment_id'] : '';

		$data = array(
			'user_id' => $user_id,
			'video_id' => $video_id,
			'package_id' => $package_id,
			'currency_code' => $currency_code,
			'description' => $description,
			'payment_id' => $payment_id,
			'state' => $state,
			'amount' => $amount
		);

		$wherePackageId = 'id=' . $_POST['package_id'];
		$package = $this->API_CRUD_model->getById($wherePackageId, 'package');

		if ($package->type == 'month') {
			$package_expiry_date = date('Y-m-d', strtotime('+' . $package->time . ' month'));
		} else {
			$package_expiry_date = date('Y-m-d', strtotime('+' . $package->time . ' year'));
		}

		if ($package_expiry_date) {
			$package_expiry_data['package_expiry_date'] = $package_expiry_date;
			$this->API_CRUD_model->update($_POST['user_id'], 'id', $package_expiry_data, 'user');
		}

		$id = $this->API_CRUD_model->insert($data, 'transaction');
		$result['id'] = $id;

		$response = array('status' => 200, 'message' => 'Transaction successfully', 'result' => $result);
		echo json_encode($response);
		exit;
	}

	public function get_package_transaction()
	{
		if (isset($_REQUEST['user_id']) && $_REQUEST['user_id'] != '') {

			$where = 'user_id=' . $_REQUEST['user_id'];
			$result = $this->API_CRUD_model->get($where, 'transaction');
			if (count($result) > 0) {
				foreach ($result as $row) {
					$where_package = 'id=' . $row->package_id;
					$package = $this->API_CRUD_model->getById($where_package, 'package');
					$row->package_name = '';
					if (isset($package->id)) {
						$row->package_name = $package->name;
					}
				}

				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $result);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
			echo json_encode($response);
		} else {
			$response = array('status' => 400, 'message' => 'Please enter required field', 'result' => array());
			echo json_encode($response);
			exit;
		}
	}

	public function get_packages()
	{

		$result = $this->API_CRUD_model->get('', 'package');

		if (count($result) > 0) {
			$results = $this->getImagePathVideo($result);
			if (sizeof($results) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
		}
		echo json_encode($response);
	}

	public function videosearch()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == false) {
			$array = array('status' => 400, 'message' => "Please enter required field");
			echo json_encode($array);
			exit;
		} else {
			$where = 'video.name LIKE "%' . $_REQUEST['name'] . '%" ';

			$table = 'video';
			$data['page_no'] = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
			// Join data
			$joinArray = [];

			if ($where) {
				$where = array($where);
			}
			$data['field'] = 'video.*';
			$data['table'] = $table;
			$data['joins'] = $joinArray;
			$data['where'] = $where;
			$result = $this->API_CRUD_model->get_join($data);

			if (count($result) > 0) {
				$result_data = $this->getImagePathVideo($result);
				if (sizeof($result_data) > 0) {
					$response = array('status' => 200, 'message' => 'Record get success', 'result' => $result_data);
				} else {
					$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
				}
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
			echo json_encode($response);
			exit;
		}
	}

	public function getAlbum()
	{
		$table = 'album';
		$result = $this->API_CRUD_model->get('', $table);

		if (count($result) > 0) {
			foreach ($result as $row) {
				$row->image = base_url() . 'assets/images/album/' . $row->image;
			}
			if (sizeof($result) > 0) {
				$response = array('status' => 200, 'message' => 'Record get success', 'result' => $result);
			} else {
				$response = array('status' => 400, 'message' => 'Record not found');
			}
		} else {
			$response = array('status' => 400, 'message' => 'Record not found');
		}
		echo json_encode($response);
		exit;
	}

	public function getAlbumDetail()
	{
		$this->form_validation->set_rules('album_id', 'album_id', 'required');
		if ($this->form_validation->run() == false) {
			$array = array('status' => 400, 'message' => "Please enter required field");
			echo json_encode($array);
			exit;
		} else {
			$where = 'id=' . $_POST['album_id'];
			$table = 'album';
			$album = $this->API_CRUD_model->getById($where, $table);

			if (isset($album->id)) {

				$where = 'video.id IN (' . $album->video_ids . ')';

				$table = 'video';
				$data['page_no'] = isset($_REQUEST['page_no']) ? $_REQUEST['page_no'] : 1;
				// Join data
				$joinArray[] = ['join' => 'artist.id=video.artist_id', 'table' => 'artist'];
				$joinArray[] = ['join' => 'category.id=video.category_id', 'table' => 'category'];


				if ($where) {
					$where = array($where);
				}
				$data['field'] = 'video.*,category.name as category_name,category.image as category_image, artist.name as artist_name,artist.image as artist_image';
				$data['table'] = $table;
				$data['joins'] = $joinArray;
				$data['where'] = $where;
				$result = $this->API_CRUD_model->get_join($data);

				if (count($result) > 0) {
					$results = $this->getImagePathVideo($result);
					if (sizeof($results) > 0) {
						$response = array('status' => 200, 'message' => 'Record get success', 'result' => $results);
					} else {
						$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
					}
				} else {
					$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
				}
				echo json_encode($response);
				exit;
			}
		}
	}
}