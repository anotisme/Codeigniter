<?php

class User_model extends CI_Model {
	
	public function can_login($username, $password) {
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
