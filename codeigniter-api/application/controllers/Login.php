<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('login_model');
	}

	public function index()
	{
		$sess['sess'] = $this->session->userdata('id');
		if(isset($sess)) {
			$this->load->view('private_area', $sess);
		} else {
			$this->load->view('login', $sess);
		}
		
	}

	public function validation()
	{
		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		if($this->form_validation->run()) {
			$result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
			// var_dump($result); die();
			if($result == '') {
				return $this->load->view('private_area');
			} else {
				$this->session->set_flashdata('message', $result);
				$this->load->view('login');
			}
		} else {
			$this->load->view('login');
		}
	}
}
