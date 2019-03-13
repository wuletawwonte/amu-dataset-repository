<?php

class Main_model extends CI_Model {	


	public function __construct() {
		parent::__construct();

	}


	public function user_can_log_in($username, $password) {

		$data = array(
			'username' => $username ,
			'password' => $password
			);
		
		$this->db->where($data);
		$query = $this->db->get('users');

		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}

	public function create_user_account($username, $password, $rc) {
		$data = array(
			'username' => $username,
			'password' => $password,
			'research_center' => $rc
			);
		$this->db->insert('users', $data);
	}

	public function get_users() {
		$this->db->where('view', 0);
		$res = $this->db->get('users');

		return $res->result_array();
	}

	public function get_rcs() {
		$res = $this->db->get('rc');

		return $res->result_array();
	}

	public function edit_account($uid, $un, $pw) {
		$data = array(
			'username' => $un,
			'password' => $pw 
			);

		$this->db->where('user_id', $uid);
		$this->db->update('users', $data);

	}

	public function delete_account($uid) {
		$this->db->where('user_id', $uid);
		$this->db->delete('users');
	}

	public function delete_rc_account($rc_id) {
		$this->db->where('rc_id', $rc_id);
		$this->db->delete('rc');
		$this->db->where('research_center', $rc_id);
		$this->db->delete('users');
	}

	public function upload ($fname, $title, $description, $author, $rc, $year, $uploader, $Alevel) {
		$data = array(
			'file_name' => $fname,
			'file_title' => $title,
			'file_description' => $description,
			'file_author' => $author,
			'search_target' => $title . $description . $author,
			'file_rc' => $rc,
			'year' => $year,
			'file_uploader' => $uploader,
			'access_level' => $Alevel,
			'downloadCode' => substr(uniqid(), 8) 
			);
		$this->db->insert('files', $data);
	}

	public function get_rc($un) {
		$this->db->where('username', $un);
		$rc = $this->db->get('users', 'rc');
		return $rc->result_array();
	}

	public function get_files() {
		$this->db->where('file_uploader', $this->session->userdata('username'));
		$res = $this->db->get('files');

		return $res->result_array();
	}

	public function get_recent() {
		$this->db->order_by('file_id', 'Desc');
		$this->db->limit(4);
		$res = $this->db->get('files');

		return $res->result_array();
	}

	public function get_requests() {
		$this->db->where('uploader', $this->session->userdata('username'));
		$res = $this->db->get('requests');

		return $res->result_array();
	}


	public function editFileMetadata($file_id, $file_title, $file_description, $file_author, $year) {

		$data = array(
			'file_Title' => $file_title ,
			'file_description' => $file_description,
			'file_author' => $file_author,
			'year' => $year
			);

		$this->db->where('file_id', $file_id);
		$this->db->update('files', $data);
	}

	public function getFiles($searchText, $searchRc, $year) {
		$res = $this->db
			->select('*')
			->from('files')
			->where('match(search_target) against ("'. $searchText .'" IN BOOLEAN MODE)')
			->get();

		return $res->result_array();
	}

	public function check_title($title) {
		$this->db->where('file_Title', $title);
		$res = $this->db->get('files');

		$result = $res->result_array();

		if(count($result) > 0) {
			return false;
		} else {
			return true;
		}
	}

	public function requestDownload($name, $reason, $file_name, $file_uploader) {
		$data = array(
			'requester' => $name,
			'reason' => $reason, 
			'uploader' => $file_uploader,
			'file_name' => $file_name 
			);

		$this->db->insert('requests', $data);
	}

	public function editAdminAccount($passwd) {
		$data = array(
			'password' => $passwd
			);
		$this->db->where('username', 'admin');
		$this->db->update('users', $data);
	}

	public function editUserAccount($username, $password) {
		$data = array(
			'password' => $password
			);
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}

	public function editRcAccount($name, $rcId) {
		$data = array('rc_name' => $name);
		$this->db->where('rc_id', $rcId);
		$this->db->update('rc', $data);
	}

	public function create_rc_account($name) {
		$data = array('rc_name' => $name );
		$this->db->insert('rc', $data);
	}

	public function getRcName($rcId) {
		$data = $this->db->get_where('rc', array('rc_id' => $rcId));
		$data = $data->result_array();
		return $data[0]['rc_name'];
	}

	public function check_dfile($file_id, $dCode) {
		$data = array(
			'file_id' => $file_id,
			'downloadCode' => $dCode 
			);
		$this->db->where($data);
		$res = $this->db->get('files');

		$result = $res->result_array();

		if(count($result) > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function get_stats() {
		$res = $this->db->get('files');
		$this->db->where('access_level', 1);
		$res2 = $this->db->get('files');
		$this->db->where('access_level', 0);
		$res3 = $this->db->get('files');
		$data = array(
			'total' => count($res->result_array()), 
			'restricted' => count($res2->result_array()),
			'public' => count($res3->result_array())
			);
		return $data;
	}

}

?>