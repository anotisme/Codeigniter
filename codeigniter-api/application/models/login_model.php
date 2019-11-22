<?php

class Login_model extends CI_Model {
	
	public function can_login($email, $password) {
		$this->db->where('email', $email);
		$query = $this->db->get('register');
		if($query->num_rows()) {
			foreach($query->result() as $result) {
				// print_r($result); die();
				if($result->is_email_verified == 'yes' ){
					$store_password = $this->encryption->decrypt($result->password);
					if($password = $store_password) {
						$this->session->set_userdata('id', $result->id);
					} else {
						return 'Wrong password';
					}
				} 
			}
		} else {
			return '<div class="alert alert-danger">Invalid email!</div>';
		}
	}

}
