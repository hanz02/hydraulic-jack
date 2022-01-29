<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_control extends CI_Controller {

 public function __construct()
 {
	 parent::__construct();
	 $this->load->helper('url', 'form');
   $this->load->library('session');

   $this->load->model('admin/products_model', 'admin_products_model');


 }

public function index()
{
	if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
	{
		$display_products_result = $this->admin_products_model->display_products();

		if($display_products_result != false) {
			$data['all_products'] = $display_products_result;
			$this->load->view('admin/products/products_page', $data);
			
		} else {
			echo "Something is wrong displaying the products";
		}

	} else {
		redirect('hj-admin/login');
	}
}

  public function updateProductStatus() {
    $status_data = $this->input->post();
    $update_result = $this->admin_products_model->update_status($status_data);

	echo $update_result;
  }

  public function removeProducts() {
	$data = $this->input->post();
 	$update_result = $this->admin_products_model->delete_product($data["p_id"]);	

	echo $update_result;

  }


	public function view_product_spec() 
	{
		if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
		{
			$data = $this->input->get();
			$product_spec = $this->admin_products_model->view_product_details($data);	
			
			if($product_spec != false)
			{
				$data['ratings'] = $this->admin_products_model->get_product_rating($data);	
				$data['products_details'] = $product_spec;
				$this->load->view('admin/products/products_spec_page', $data);

			} else
			{
				echo "Error fetching product details, please try again";
			}

		} else
		{
			redirect('hj-admin/login');
		}
	}

	public function update_product_spec() {
		$data = $this->input->post();
		$product_spec = $this->admin_products_model->update_spec($data);	

		echo $product_spec;

	}

	public function uploadProduct(){
		$config['upload_path'] = 'assets/img/ready_artworks';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['encrypt_name'] = TRUE;
	
		$this->load->library('upload', $config);
	
		//* provide name attr of the 'file' type input
		if($this->upload->do_upload('productImgUpload')) {
			$uploadData = array(
				'upload_data' => $this->upload->data(),
				'input_data' => $this->input->post()
			);

			$upload_result = $this->admin_products_model->insertNewProduct($uploadData);
			
			if($upload_result)
			{
				echo true;
			} else
			{
				echo false;
			}

		} else {
			echo false;
		}
	}
}
