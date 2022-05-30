<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

 public function __construct()
 {
	 parent::__construct();
	 $this->load->helper('url', 'form');
   $this->load->library('session');

   $this->load->model('products_model');

 }

 public function index()
 {
 
	 $display_products_result = $this->products_model->display_products();
 
	 $data['all_products'] = $display_products_result;
	 $this->load->view('products/products_page', $data);
 }

  public function display_product_details()
  {
    $product_data = $this->input->get();

	$visibility = $this->products_model->checkProductVisbible($product_data);

	if($visibility == true)
	{
		$results = $this->products_model->view_product_details($product_data);
		$result_rating = $this->products_model->get_product_rating($product_data);

		if($results != false) {
			$data['products_info'] = $results;
			$data['products_rating'] = $result_rating;

			$this->load->view('products/product_details_page', $data);

		} else {
			echo "Something is wrong displaying the products";
		}
	}
	 else
	 {
		 redirect('Error_control');
	 }
  }

  public function submitRating() {
    $rating_data = $this->input->post();
    $rating_result = $this->products_model->insert_rating($rating_data);

    if($rating_result != false) {
      $this->session->set_flashdata('rating_message', $rating_result);
      echo $this->session->flashdata('rating_message');
    }
  }

  public function removeRating() {
    $rating_data = $this->input->post();
    $rating_result = $this->products_model->remove_rating($rating_data);

    if($rating_result != false) {
      $this->session->set_flashdata('rating_message', "Rating has been removed");
      echo $this->session->flashdata('rating_message');
    }
  }

  public function filterProduct()
  {
	$data = $this->input->get();
    $result = false;

    if($data['option'] == "filter_highest_price")
    {
      $result = $this->products_model->filterHighestPrice($data);
    } else if($data['option'] == "filter_lowest_price")
    {
      $result = $this->products_model->filterLowestPrice($data);
	} else if($data['option'] == "filter_latest")
    {
      $result = $this->products_model->filterLatest($data);
	} else if($data['option'] == "filter_oldest")
	{
	$result = $this->products_model->filterOldest($data);
    } else {
      return false;
    }

	if($result != false) {
		$output = '';
		foreach($result as $product)
		{
			if($product->stock_amount > 0)
			{
				$product_name = '<button class="name-link f-sm">'.$product->product_name .'</button>';
			} else {
				$product_name = '<p class="product-name f-sm">'.$product->product_name .'</p>';
			}

			if($product->stock_amount > 0) {
				$shop_btn = '<button class="shop-now-btn m-y1">Shop Now</button>';
			} else {
				$shop_btn = '<div class="out-stock-msg ls-1 m-y1">
					<p class="f-w-heavy m-y-ex f-sm-ex">OUT OF STOCK</p>
					</div>';
			}
			
			$output .= 
			'
				<div class="product-individual">
					<form action="products_control/display_product_details" method="GET" class="product-lists-form flex">
						<input type="hidden" name="product_id" value="'. $product->product_id .'"/>
						<div class="product-img-card">
							<img class="product-img" src="'. $product->product_img .'" alt="product_img">
						</div>
						<div class="product-info">
							<div class="product-name-link">
							'.
								$product_name
							.'
							</div>
							<div class="artist-name"><h4><span class="f-w-heavy">Artist: </span>'. $product->user_name .'</h4></div>
							<div class="product-price"><h4 class="f-w-heavy">RM '. $product->price .'</h4></div>
							'.
								$shop_btn
							.'
						</div>
					</form>
				</div>
			';
		}
		echo $output;
	  } else 
	  {
		return false;
	  }
  }
}
