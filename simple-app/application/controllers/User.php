<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index() 
	{
		// $this->load->enter();
		$sess_id = $this->session->userdata('username');
		if(!empty($sess_id)) {
			redirect(base_url().'user/enter');
		} else {
			$this->session->set_userdata(array('msg'=>'')); 
			//load the login page
			$this->load->view('users/login');        
		}    
	}

	public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()) {
			$this->load->model('user_model');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($this->user_model->can_login($username, $password)) {
				$session_data = array(
					'username' => $username
				);
				$this->session->set_userdata($session_data);
				redirect(base_url() . 'user/enter');
			} else {
				$this->session->set_flashdata('error', 'Invalid Username and Password');
				redirect(base_url() . 'user/login');
			}
		} else {
			$this->index();
		}
	}

	public function enter() {
		if($this->session->userdata('username') != '') {
			// echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';
			// echo '<a href="'.base_url().'user/logout">Logout</a>';
			$username['username'] = $this->session->userdata('username');
			// redirect(base_url(). 'users/login', $username);
			return $this->load->view('users/logged_in', $username);

		} else {
			redirect(base_url(). 'user/login');
		}
	}

	public function logout() {
		$this->session->unset_userdata('username');
		redirect(base_url(). 'user/login');
	}
}
