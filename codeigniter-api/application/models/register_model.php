<?php

class Register_model extends CI_Model {
	
	public function insert($data) {
		$this->db->insert('register', $data);
		return $this->db->insert_id();
	}

	public function verify_email($key)
	{
		$this->db->where('verification_key', $key);
		$this->db->where('is_email_verified','no');
		$query = $this->db->get('codeigniter_toturial');
		if($query->num_rows() > 0) {
			$data = array(
				'is_emailed_verified' => 'yes'
			);
			$this->db->where('veryfication_key', $key);
			$this->db->update('codeigniter_toturial', $data);
		} else {
			return false;
		}
	}
}