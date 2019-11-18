<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->model('product_model');
		$product['fetch_product'] = $this->product_model->fetch_product();
		$this->load->view('products/index', $product);
	}
	public function form_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Name", 'required|alpha');
		$this->form_validation->set_rules('category', "Category", 'required|alpha');
		$this->form_validation->set_rules('price', "Price", 'required');
		if($this->form_validation->run()) {
			$this->load->model('product_model');
			$product = array(
				'name' => $this->input->post('name'),
				'category' => $this->input->post('category'),
				'price' => $this->input->post('price')
			);
			if($this->input->post('update')) {
				$this->product_model->update_product($product, $this->input->post('hidden_id'));
				redirect(base_url() . 'product/updated');
			}
			if($this->input->post('add')) {
				$this->product_model->add($product);
				redirect(base_url() . 'product/added');
			}
		} else {
			$this->index();
		}
	}
	public function added()
	{
		$this->index();
	}
	public function delete_product()
	{
		$id = $this->uri->segment(3);
		$this->load->model('product_model');
		$this->product_model->delete_product($id);
		redirect(base_url() . 'product/deleted');
	}
	public function deleted()
	{
		$this->index();
	}
	public function update_product()
	{
		$product_id = $this->uri->segment(3);
		$this->load->model('product_model');
		$product['product_data'] = $this->product_model->fetch_single_product($product_id);
		$product['fetch_product'] = $this->product_model->fetch_product();
		$this->load->view('products/index', $product);
	}
	public function updated()
	{
		$this->index();
	}
	
}
