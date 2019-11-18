<?php

class Product_model extends CI_Model {
	public function products() {
		$this->load->view('products/index');
	}

	public function add($product) {
		$this->db->insert('products', $product);
	}

	public function fetch_product() {
		$this->db->select('*');
		$this->db->from('products');
		$query = $this->db->get();
		return $query;
	}

	public function delete_product($id) {
		$this->db->where('id', $id);
		$this->db->delete('products');
	}

	public function fetch_single_product($id) {
		$this->db->where('id', $id);
		$this->db->from('products');
		$query = $this->db->get();
		return $query;
	}

	public function update_product($product, $id) {
		$this->db->where('id', $id);
		$this->db->update('products', $product);
	}
}
