<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('API_CRUD_model');
		$this->load->library('email');
	}

	public function Login()
	{

		if (isset($_REQUEST['email'])) {
			$email = $_REQUEST['email'];
			$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
			$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '1';

			$auth_token = uniqid() . random_string('alnum', 18);
			if ($type == '2') {
				$where = 'email="' . $email . '"';
				$user_data = $this->API_CRUD_model->getById($where, 'user');

				if ($user_data) {
					$user_data->image = base_url() . 'assets/images/user/' . $user_data->image;
					$user_data->background_image = base_url() . 'assets/images/user/' . $user_data->background_image;

					if ($user_data->id) {
						$this->update_auth_token($auth_token, $user_data->id);
						$response = array('status' => 200, 'message' => 'Successfully login', 'result' => array($user_data));
					} else {
						$r = array();
						$response = array('status' => 400, 'message' => 'Username and pasword is wrong', 'result' => array());
					}
				} else {
					// Facebook User Register 
					$email = $_REQUEST['email'];
					$fullname = isset($_REQUEST['fullname']) ? $_REQUEST['fullname'] : '';
					$mobile = isset($_REQUEST['mobile'])  ? $_REQUEST['mobile'] : '';

					$image = '';
					if (isset($_FILES['image']['name'])) {
						$image = $this->API_CRUD_model->imageupload($_FILES['image'], 'image', FCPATH . 'assets/images/user');
					}

					$data = array(
						'fullname' => $fullname,
						'email' => $_REQUEST['email'],
						'type' => $type,
						'mobile' => $mobile,
						'image' => $image,
						'background_image' => 'default_background_image.png',
					);


					$user_id = $this->API_CRUD_model->insert($data, 'user');
					unset($data['password']);
					$data['id'] = $user_id;

					$this->registrationMailsend($data);

					$this->update_auth_token($auth_token, $user_id);
					$data['image'] = base_url() . 'assets/images/user/' . $data['image'];
					$data['background_image'] = base_url() . 'assets/images/user/default_background_image.png';
					$response = array('status' => 200, 'message' => 'Add user sucessfuly', 'result' => array($data));
					echo json_encode($response);
					exit;
				}
			} else {
				$where = 'password="' . md5($password) . '" and email="' . $email . '"';
				$user_data = $this->API_CRUD_model->getById($where, 'user');

				if (isset($user_data->id)) {
					$this->update_auth_token($auth_token, $user_data->id);
					$user_data->image = base_url() . 'assets/images/user/' . $user_data->image;
					$user_data->background_image = base_url() . 'assets/images/user/' . $user_data->background_image;
					$response = array('status' => 200, 'message' => 'Successfully login', 'result' => array($user_data));
				} else {
					$r = array();
					$response = array('status' => 400, 'message' => 'Username and pasword is wrong', 'result' => array());
				}
			}
		} else {
			$response = array('status' => 400, 'message' => 'Please enter email and password', 'result' => array());
		}
		echo json_encode($response);
		exit;
	}

	public function update_auth_token($auth_token, $user_id)
	{
		$data['auth_token'] = $auth_token . '_' . $user_id;
		$result = $this->API_CRUD_model->update($user_id, 'id', $data, 'user');
		return true;
	}

	public function registration()
	{
		if (isset($_REQUEST['fullname']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['mobile']) && $_REQUEST['mobile'] != '') {
			$fullname = $_REQUEST['fullname'];
			$email = $_REQUEST['email'];
			$password = $_REQUEST['password'];
			$mobile = $_REQUEST['mobile'];

			$where = 'email="' . $email . '"';
			$emailresult = $this->API_CRUD_model->getById($where, 'user');


			$where_mobile = 'mobile="' . $mobile . '"';
			$mobileresult = $this->API_CRUD_model->getById($where_mobile, 'user');


			if (isset($emailresult->id)) {
				$response = array('status' => 400, 'message' => 'Email address already exists.', 'User_id' => '');
				echo json_encode($response);
				exit;
			}

			if (isset($mobileresult->id)) {
				$response = array('status' => 400, 'message' => 'Mobile Number already exists.', 'User_id' => '');
				echo json_encode($response);
				exit;
			}

			$data = array(
				'fullname' => $fullname,
				'email' => $email,
				'password' => md5($password),
				'mobile' => $mobile,
				'background_image' => 'default_background_image.png',
			);

			$user_id = $this->API_CRUD_model->insert($data, 'user');
			$data['id'] = $user_id;

			$this->registrationMailsend($data);
			$response = array('status' => 200, 'message' => 'User registration sucessfuly', 'id' => (string)$user_id);
			echo json_encode($response);
			exit;
		} else {
			$response = array('status' => 400, 'message' => 'Please enter all field', 'id' => "");
			echo json_encode($response);
			exit;
		}
	}

	public function profile()
	{
		if (isset($_REQUEST['user_id'])) {
			$user_id = $_REQUEST['user_id'];
			$where = 'id="' . $user_id . '" ';
			$result = $this->API_CRUD_model->getById($where, 'user');
			if (isset($result->id)) {

				$result->is_buy = 0;
				if (isset($result->package_expiry_date) && strtotime($result->package_expiry_date) > strtotime(date('Y-m-d'))) {
					$result->is_buy = 1;
				}

				if ($result->image) {
					$result->image = base_url() . 'assets/images/user/' . $result->image;

					unset($result->password);
				}
				if ($result->background_image) {
					$background_image = $result->background_image;
				} else {
					$background_image = 'default_background_image.png';
				}
				$result->background_image = base_url() . 'assets/images/user/' . $background_image;

				$response = array('status' => 200, 'message' => 'Record get success fully', 'result' => array($result));
			} else {
				$response = array('status' => 400, 'message' => 'Record not found', 'result' => array());
			}
			echo json_encode($response);
			exit;
		} else {
			$response = array('status' => 400, 'message' => 'Please enter required field', 'result' => array());
			echo json_encode($response);
			exit;
		}
	}

	public function update_profile()
	{
		if (isset($_REQUEST['user_id']) && isset($_REQUEST['fullname']) && isset($_REQUEST['email']) && isset($_REQUEST['mobile'])) {

			$data = [];
			$user_id = $_REQUEST['user_id'];
			$fullname = $_REQUEST['fullname'];
			$email = $_REQUEST['email'];
			$mobile = $_REQUEST['mobile'];
			$password = isset($_REQUEST['password'])  ? $_REQUEST['password'] : '';


			$data = array(
				'fullname' => $fullname,
				'email' => $email,
				'mobile' => $mobile
			);

			$image = '';
			if (isset($_FILES['image']['name'])) {
				$image = $this->API_CRUD_model->imageupload($_FILES['image'], 'image', FCPATH . 'assets/images/user');
			}

			$background_image = '';
			if (isset($_FILES['background_image']['name'])) {
				$background_image = $this->API_CRUD_model->imageupload($_FILES['background_image'], 'background_image', FCPATH . 'assets/images/user');
			}

			if ($background_image) {
				$data['background_image'] = $background_image;
			}


			if ($image) {
				$data['image'] = $image;
			}

			if ($password) {
				$data['password'] = md5($password);
			}

			$where = 'id="' . $user_id . '" ';
			$result = $this->API_CRUD_model->update($_REQUEST['user_id'], 'id', $data, 'user');

			if ($result) {
				$response = array('status' => 200, 'message' => 'User profile update sucessfuly', 'id' => (string)$user_id);
				echo json_encode($response);
			} else {
				$response = array('status' => 400, 'message' => 'User profile fail');
				echo json_encode($response);
			}
		} else {
			$response = array('status' => 400, 'message' => 'Please enter required field');
			echo json_encode($response);
		}
	}

	public function registrationMailsend($data)
	{
		$settinglist = $this->API_CRUD_model->get('', 'general_setting');
		foreach ($settinglist as $set) {
			$setn[$set->key] = $set->value;
		}

		$where_user = 'id=' . $data['id'];
		$mail['user'] = $this->API_CRUD_model->getById($where_user, 'user');

		$mail['setn'] = $setn;
		$body = $this->load->view("admin/email/register", $mail, true);

		$subject = "Thank you for registration";
		// $this->send_mail($body, 'patelsanjay.it@gmail.com', $subject);
		$this->send_mail($body, $mail['user']->email, $subject);

		return true;
	}

	public function send_mail($message, $email, $subject)
	{

		$smtpWhere = 'id="1"';
		$smtp_detail = $this->API_CRUD_model->getById($smtpWhere, 'smtp_setting');
		$emailconfig = get_smtp_setting();

		$this->load->library('email', $emailconfig);
		// $this->email->initialize($emailconfig);
		$this->email->from($smtp_detail->from_email, $smtp_detail->from_name);
		$this->email->to($email);
		$this->email->set_mailtype('html');
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
	}

	public function forgotpassword()
	{

		if (isset($_REQUEST['email'])) {
			$settinglist = $this->API_CRUD_model->get('', 'general_setting');
			foreach ($settinglist as $set) {
				$setn[$set->key] = $set->value;
			}

			$where = 'email ="' . $_REQUEST['email'] . '"';
			$share_user = $this->API_CRUD_model->getById($where, 'user');

			if (isset($share_user->id)) {

				if ($share_user->type == 1) {
					$mail['user'] = $share_user;
					$mail['setn'] = $setn;
					$book_invoice = $this->load->view("admin/email/forgotpassword", $mail, true);

					$subject = "Forgot Password";
					$this->send_mail($book_invoice, $share_user->email, $subject);

					$response = array('status' => 200, 'message' => 'Your password has been sent to your email address.');
					echo json_encode($response);
					exit;
				} else {
					$response = array('status' => 200, 'message' => 'You have registered with social so please use the social login.');
					echo json_encode($response);
					exit;
				}
			} else {
				$response = array('status' => 400, 'message' => 'Please enter valid email');
				echo json_encode($response);
				exit;
			}
		} else {
			$response = array('status' => 400, 'message' => 'Please enter email');
			echo json_encode($response);
			exit;
		}
	}
}