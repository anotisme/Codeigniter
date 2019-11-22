<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_area extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('id')) {
			redirect('login');
		} 
	}

	public function index()
	{
		$this->load->view('private_area');
	}

	public function logout() 
	{
		$data = $this->session->all_userdata();
		foreach($data as $row => $rows_value) {
			$this->session->unset_userdata($row);
		} 
		$this->load->view('login');
	}
}
