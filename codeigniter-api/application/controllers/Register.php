<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('encryption');
		$this->load->library('form_validation');
		$this->load->model('register_model');
	}
	
	public function index()
	{
		$this->load->view('register');
	}

	public function validation()
	{
		$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|is_unique[register.email]');
		$this->form_validation->set_rules('user_password', 'Password', 'required|trim');
		if($this->form_validation->run()) {
			$verification_key = md5(rand());
			$encrypted_password = $this->encryption->encrypt($this->input->post('user_password'));
			$data = array(
				'name' 	=> $this->input->post('user_name'),
				'email' 	=> $this->input->post('user_email'),
				'password' 	=> $encrypted_password,
				'verification_key' => $verification_key
			);
			$id = $this->register_model->insert($data);
			if($id > 0) {
				$subject = "Please verify email for login";
				$message = "
					<p>Hi ".$this->input->post('user_name')."</p>
					<p>This is email verification mail from XYZ Register system. For continue to login, please click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
					<p>Thanks,</p>
				";
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.mailtrap.io',
					'smtp_port' => 2525,
					'smtp_user' => 'pnv17web.not@gmail.com',
					'smtp_pass' => 'anhhonem1',
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('no-reply@gmail.com');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);
				// var_dump($this->email->send()); die();
				if($this->email->send()) {
					$this->session->set_flashdata('message', 'Check in your email for email verification mail.');
					$this->index();
				} else {
					// show_error($this->email->print_debugger());
					$this->session->set_flashdata('error_message', 'Fail on sending email');
					$this->index();
				}
			}
		} else {
			$this->index();
		}
	}	

	public function verify()
	{
		if($this->uri->segment(3)) {
			$verification_key = $this->uri->segment(3);
			if($this->register_model->verify_email($verification_key)) {
				$data['message'] = '<h1 align="center"> Your email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
 			} else {
				 $data['message'] = '<h1 align="center">Invalid link</h1>';
			}
			$this->load->view('email_verification', $data);
		}
	}
}
