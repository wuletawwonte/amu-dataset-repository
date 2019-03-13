<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('form_validation', 'upload');
		$this->load->model('main_model');
		$this->load->helper(array('form', 'url'));
	}


	public function index() {
		if($this->session->userdata('is_logged_in') == '1') {
      		if($this->session->userdata('username') == "admin") {
				redirect('Welcome/AdminHome');
			} else {
				redirect('Welcome/UserHome');
			}
		} else {
			$data["rcs"] = $this->main_model->get_rcs();
			$data["stat"] = $this->main_model->get_stats();
			$data["recentUploads"] = $this->main_model->get_recent();

			$this->load->view('SearchPage',$data);	
		}
	}


	public function AdminHome() {
		if($this->session->userdata('is_logged_in') == '1') {
			$data["users"] = $this->main_model->get_users();
			$data["rcs"] = $this->main_model->get_rcs();
			$data["controller"] = $this;

			$this->load->view('AdminHome', $data);
		} else {
			redirect('Welcome/index');
		}
	}

	public function UserHome() {
		if($this->session->userdata('is_logged_in') == '1') {
			$data["files"] = $this->main_model->get_files();
			$data["requests"] = $this->main_model->get_requests();

			$this->load->view('UserHome', $data);
		} else {
			redirect('Welcome/index');
		}		
	}

	public function user_validation() {

		$this->form_validation->set_rules('username', 'username', 'required|trim|callback_validate_user_credentials');
		$this->form_validation->set_rules('password', 'password', 'required|trim');

		if($this->form_validation->run()){
			$rc = $this->main_model->get_rc($this->input->post('username'));
			$data = array(
				'username' => $this->input->post('username'),
				'rc' => $rc[0]['research_center'],
				'is_logged_in' => '1',
				);

			$this->session->set_userdata($data);

			if($this->input->post('username') == "admin") {
				redirect('Welcome/AdminHome');
			} else {
				redirect('Welcome/UserHome');
			}

		} else {
			$this->session->sess_destroy();
			$data['error'] = "<br>Your username or password is not correct";
			$data["rcs"] = $this->main_model->get_rcs();
			$data["stat"] = $this->main_model->get_stats();
			$data["recentUploads"] = $this->main_model->get_recent();

			
			$this->load->view("SearchPage", $data);
		}
		
	}

	public function restricted() {
		$this->load->view('restricted');
	}

	public function validate_user_credentials() {

		if($this->main_model->user_can_log_in($this->input->post('username'), $this->input->post('password'))) {
			return true;
		} else {
			return false;
		}
 
	}

	public function create_user_account() {
		$this->main_model->create_user_account($this->input->post('username'), $this->input->post('password'), 
			$this->input->post('researchCenter'));
		redirect('welcome/index');
	}

	public function create_rc_account() {
		$this->main_model->create_rc_account($this->input->post('rcName'));
		$this->session->set_flashdata('in', 2);
		redirect('welcome/adminHome');
	}

	public function editAccount() {
		$this->main_model->edit_account($this->input->post('user_id'), $this->input->post('exampleUsername'), 
			$this->input->post('examplePassword'));

		redirect('welcome/index');
	}

	public function editRcAccount() {
		$this->main_model->editRcAccount($this->input->post('editableRc'), $this->input->post('researchCenterID'));
		redirect('welcome/adminHome');
	}

	public function deleteAccount() {
		$this->main_model->delete_account($this->input->get('eid'));

		redirect('welcome/index');
	}

	public function deleteRcAccount() {
		$this->main_model->delete_rc_account($this->input->get('eid'));

		redirect('welcome/adminHome');
	}

	public function upload() {
		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'txt|pdf|xls|xlsx|doc|docx|ppt|pptx';
		$config['max_size'] = "40000";
		$config['remove_spaces'] = "true";

		$this->load->library('upload', $config);

		if($this->main_model->check_title($this->input->post('fileTitle'))) {
			if(!$this->upload->do_upload('fileInput')){
				$data["error"] = $this->upload->display_errors();
				$data["files"] = $this->main_model->get_files();
				$data["requests"] = $this->main_model->get_requests();


				$this->load->view('UserHome', $data);
			} else {
				$upload_data = $this->upload->data();

				$this->main_model->upload($upload_data['file_name'], $this->input->post('fileTitle'), $this->input->post('fileDescription'), $this->input->post('fileAuthor'), $this->session->userdata('rc'), $this->input->post('year'), $this->session->userdata('username'), $this->input->post('Alevel'));

				$data['success_msg'] = '<div class="alert alert-success text-center">Your file <strong>'.$upload_data['file_name'].'</strong>. was successfully uploaded!</div>';
				$data["files"] = $this->main_model->get_files();
				$data["requests"] = $this->main_model->get_requests();

				$this->load->view('UserHome', $data);
			}
		} else {
				$data["error2"] = "Duplicate file title Error";
				$data["files"] = $this->main_model->get_files();
				$data["requests"] = $this->main_model->get_requests();

				$this->load->view('UserHome', $data);			
		}

	}


	public function editFileMetadata() {
		$this->main_model->editFileMetadata($this->input->post('file_id'), $this->input->post('fileTitle'), $this->input->post('fileDescription'), $this->input->post('fileAuthor'), $this->input->post('year'));

		redirect('welcome/UserHome');
	}


	public function searchFile() {
		$data['files'] = $this->main_model->getFiles($this->input->post('searchText'), $this->input->post('researchCenter'), $this->input->post('year')); 
		$data['searchT'] = $this->input->post('searchText');
		$data["rcs"] = $this->main_model->get_rcs();

		$this->load->view('SearchResult', $data);
	}

	public function requestDownload() {
		$this->main_model->requestDownload(
			$this->input->post('downloaderName'), 
			$this->input->post('reason'), 
			$this->input->post('file_name'), 
			$this->input->post('file_uploader') 			
		);

		$data['files'] = $this->main_model->getFiles($this->input->post('searchText'), $this->input->post('searchRC')); 
		$data['searchT'] = $this->input->post('searchText');

		$this->load->view('SearchResult', $data);
	}

	public function editAdminProfileView() {
		$this->load->view('EditAdminAccount');
	}

	public function editAdminAccount() {
		if($this->main_model->user_can_log_in($this->input->post('username'), $this->input->post('oldP'))) {
			if($this->input->post('newP') != $this->input->post('confirmP')) {
				$data['error_msg'] = "Passwords dont Match";
				$this->load->view('EditAdminAccount', $data);
			} else {
				$this->main_model->editAdminAccount($this->input->post('newP'));
				$data["success_msg"] = "Your Password Successfully Resetted ";
				$this->load->view('EditAdminAccount', $data);
			}
		}
		else {
			$data['error_msg'] = "Old Password not Correct";
			$this->load->view('EditAdminAccount', $data);
		}
	}

	public function editUserProfileView() {
		$this->load->view('EditUserAccount');
	}


	public function editUserAccount() {
		if($this->main_model->user_can_log_in($this->input->post('username'), $this->input->post('oldP'))) {
			if($this->input->post('newP') != $this->input->post('confirmP')) {
				$data['error_msg'] = "Passwords dont Match";
				$this->load->view('EditUserAccount', $data);
			} else {
				$this->main_model->editUserAccount($this->input->post('username'), $this->input->post('newP'));
				$data["success_msg"] = "Your Password Successfully Resetted ";
				$this->load->view('EditUserAccount', $data);
			}
		}
		else {
			$data['error_msg'] = "Old Password not Correct";
			$this->load->view('EditUserAccount', $data);
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('Welcome/index');
	}

	public function test() {
		echo "something here";
	}

	public function getRcName($rcId) {
		$data = $this->main_model->getRcName($rcId);
		echo $data;
	}

	public function dRestrictedFile() {
		if($this->main_model->check_dfile($this->input->post('file_id'), $this->input->post('dCode'))) {
			redirect(base_url() . 'uploads/' . $this->input->post('file_name'));
		} else {
			redirect('welcome/index');
		}
	}


}


?>
