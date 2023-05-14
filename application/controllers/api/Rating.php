<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('API_CRUD_model');
	}

	// follow 
	public function follow()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('artist_id', 'artist_id', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$where = 'user_id="' . $_REQUEST['user_id'] . '" AND artist_id = "' . $_REQUEST['artist_id'] . '"';
		$ratings_result = $this->API_CRUD_model->getById($where, 'follow');

		if (isset($ratings_result->id)) {
			$where = 'id="' . $ratings_result->id . '"';
			$added_id = $this->API_CRUD_model->delete($where, 'follow');
			$response = array('status' => 200, 'message' => 'Unfollow successfully');
		} else {
			$data['user_id'] = $_REQUEST['user_id'];
			$data['artist_id'] = $_REQUEST['artist_id'];

			$added_id = $this->API_CRUD_model->insert($data, 'follow');
			$data['id'] = $added_id;



			$response = array('status' => 200, 'message' => 'Follow Successfully');
		}

		echo json_encode($response);
		exit;
	}

	public function following_list()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$where  = 'follow.user_id="' . $_REQUEST['user_id'] . '"';
		$table1 = 'follow';
		$table2 = 'artist';
		$joinid = 'follow.artist_id= artist.id';
		$field  = 'artist.*';

		$result = $this->API_CRUD_model->get_join_allrecord($table1, $table2, $joinid, $field, $where);

		if (count($result) > 0) {
			foreach ($result as $key => $value) {
				$value->image = base_url() . 'assets/images/artist/' . $value->image;
				unset($value->password);
				$data[] = $value;
			}


			$response = array('status' => 200, 'message' => 'Get follow list successfully', 'result' => $data);
		} else {
			$response = array('status' => 400, 'message' => "There are no follow found");
		}
		echo json_encode($response);
		exit;
	}

	public function follow_list()
	{
		$this->form_validation->set_rules('artist_id', 'artist_id', 'required');
		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$where  = 'follow.artist_id="' . $_REQUEST['artist_id'] . '"';
		$table1 = 'follow';
		$table2 = 'user';
		$joinid = 'follow.user_id= user.id';
		$field  = 'user.*';

		$result = $this->API_CRUD_model->get_join_allrecord($table1, $table2, $joinid, $field, $where);

		if (count($result) > 0) {
			foreach ($result as $key => $value) {
				$value->image = base_url() . 'assets/images/user/' . $value->image;
				unset($value->password);
				$data[] = $value;
			}
			$response = array('status' => 200, 'message' => 'Get follow list successfully', 'result' => $data);
		} else {
			$response = array('status' => 400, 'message' => 'Record not found');
		}
		echo json_encode($response);
		exit;
	}


	public function addAlbum()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('video_id', 'video_id', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$user_id = $_REQUEST['user_id'];
		$video_id = $_REQUEST['video_id'];

		$where = 'user_id=' . $user_id . ' and video_id="' . $video_id . '"';
		$add_point = 1;
		$resul = $this->API_CRUD_model->getById($where, 'album');

		if (isset($resul->id)) {

			$user_id = $this->API_CRUD_model->delete($where, 'album');
			$response = array('status' => 200, 'message' => 'Remove Video successfully');
		} else {
			$data = array(
				'user_id' => $user_id,
				'video_id' => $video_id
			);
			$user_id = $this->API_CRUD_model->insert($data, 'album');
			$response = array('status' => 200, 'message' => 'add Video Successfully');
		}

		echo json_encode($response);
		exit;
	}

	public function add_ratings()
	{
		$this->form_validation->set_rules('video_id', 'video_id', 'required');
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('rating', 'rating', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$where = 'user_id=' . $_REQUEST['user_id'] . ' and video_id="' . $_REQUEST['video_id'] . '"';
		$result = $this->API_CRUD_model->getById($where, 'ratings');
		if (isset($result->id)) {
			$response = array('status' => 200, 'message' => 'You have already added a rating to this video.');
			echo json_encode($response);
			exit;
		}

		$data = array(
			'video_id' => $_REQUEST['video_id'],
			'rating' => $_REQUEST['rating'],
			'user_id' => $_REQUEST['user_id']
		);

		$this->API_CRUD_model->insert($data, 'ratings');

		$response = array('status' => 200, 'message' => 'Add rating sucessfuly');
		echo json_encode($response);
	}

	public function likeDislike()
	{
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('video_id', 'video_id', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$user_id = $_REQUEST['user_id'];
		$video_id = $_REQUEST['video_id'];

		$where = 'user_id=' . $user_id . ' and video_id="' . $video_id . '"';
		$add_point = 1;
		$resul = $this->API_CRUD_model->getById($where, 'like');

		if (isset($resul->id)) {

			$user_id = $this->API_CRUD_model->delete($where, 'like');
			$this->API_CRUD_model->subtractCountById($video_id, 'v_like', $add_point, 'video');
			$response = array('status' => 200, 'message' => 'Dislike successfully');
		} else {
			$data = array(
				'user_id' => $user_id,
				'video_id' => $video_id
			);
			$user_id = $this->API_CRUD_model->insert($data, 'like');


			$this->API_CRUD_model->updateByIdWithcount($video_id, 'v_like', $add_point, 'video');

			$response = array('status' => 200, 'message' => 'Like Successfully');
		}

		echo json_encode($response);
		exit;
	}

	public function add_comment()
	{
		$this->form_validation->set_rules('video_id', 'video_id', 'required');
		$this->form_validation->set_rules('user_id', 'user_id', 'required');
		$this->form_validation->set_rules('comment', 'comment', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}

		$data = array(
			'video_id' => $_REQUEST['video_id'],
			'comment' => $_REQUEST['comment'],
			'user_id' => $_REQUEST['user_id']
		);

		$comment_id = $this->API_CRUD_model->insert($data, 'comment');

		$response = array('status' => 200, 'message' => 'Add comment sucessfuly');
		echo json_encode($response);
	}

	public function view_comment()
	{
		$this->form_validation->set_rules('video_id', 'video_id', 'required');

		if ($this->form_validation->run() == false) {
			$errors = $this->form_validation->error_array();
			sort($errors);
			$array = array('status' => 400, 'message' => $errors[0]);
			echo json_encode($array);
			exit;
		}


		$video_id = $_REQUEST['video_id'];
		$where = 'video_id="' . $video_id . '"';
		$field = 'user.fullname,user.image,comment.*';
		$table1 = 'comment';
		$table2 = 'user';
		$joinid1 = 'user.id = comment.user_id';
		$result = $this->API_CRUD_model->get_join_allrecord($table1, $table2, $joinid1, $field, $where, 'id', 'desc');
		$row = [];
		foreach ($result as $ra) {
			$ra->image = base_url() . 'assets/images/user/' . $ra->image;
			$row[] = $ra;
		}

		if (sizeof($row) > 0) {
			$response = array('status' => 200, 'message' => 'Success', 'result' => $row);
		} else {
			$response = array('status' => 400, 'message' => 'Sorry, we could not find any matches.<br>Please try again.', 'result' => array());
		}
		echo json_encode($response);
	}

	public function get_notification()
	{
		try {
			$this->form_validation->set_rules('user_id', 'user_id', 'required');
			if ($this->form_validation->run() == false) {
				$errors = $this->form_validation->error_array();
				sort($errors);
				$array = array('status' => 400, 'message' => 'Please enter required fields.');
				echo json_encode($array);
				exit;
			} else {

				$userId = trim($_REQUEST['user_id']);
				$whereUserId = 'user_id="' . $userId . '"';
				$getReadNotificationId = $this->API_CRUD_model->get($whereUserId, 'user_notification_tracking', 'id', 'desc');


				$notificationArr = array();
				foreach ($getReadNotificationId as $row) {

					array_push($notificationArr, $row->notification_id);
				}

				$wherecond = "";
				if (count($notificationArr) > 0) {
					$notificationArr = implode(',', $notificationArr);
					$wherecond = " id  NOT IN(" . $notificationArr . ")";
				}


				$getAllNotifications = $this->API_CRUD_model->get($wherecond, 'notification', 'id', 'desc');

				if (count($getAllNotifications) > 0) {
					$rows = [];
					foreach ($getAllNotifications as $key => $value) {

						if ($value->big_picture != '') {
							$value->big_picture = base_url() . 'assets/images/notification/' . $value->big_picture;
						}
						$rows[] = $value;
					}

					$response = array('status' => 200, 'result' => $rows, 'message' => 'Get Record successfully');
				} else {
					$response = array('status' => 400, 'message' => 'Record not found.');
				}

				echo json_encode($response);
			}
		} catch (Exception $e) {
			$res = array('status' => 400, 'message' =>  'ERROR');
			return true;
		}
	}

	public function read_notification()
	{
		try {

			$this->form_validation->set_rules('user_id', 'user_id', 'required');
			$this->form_validation->set_rules('notification_id', 'notification_id', 'required');
			if ($this->form_validation->run() == false) {
				$errors = $this->form_validation->error_array();
				sort($errors);
				$array = array('status' => 400, 'message' => 'Please enter required fields.');
				echo json_encode($array);
				exit;
			} else {

				// echo "<pre>";print_r($_REQUEST);die;
				$userId = trim($_REQUEST['user_id']);
				$notification_id = trim($_REQUEST['notification_id']);
				$readArr = array();
				$readArr['user_id'] = $userId;
				$readArr['notification_id'] = $notification_id;
				$readArr['created_at'] = date('Y-m-d h:i:s');
				$this->API_CRUD_model->insert($readArr, 'user_notification_tracking');
				$response = array('status' => 200, 'message' =>  'Notification read successfully.');
				echo json_encode($response);
			}
		} catch (Exception $e) {
			$res = array('status' => 400, 'message' => 'ERROR');
			return true;
		}
	}
}
