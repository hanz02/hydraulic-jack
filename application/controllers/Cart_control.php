<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_control extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url', 'form');
    $this->load->library('session');

    $this->load->model('cart_model');
  }

  public function index()
  {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN

      $db_result = $this->cart_model->display_cart_products();

      if($db_result != false)
      { //IF NO ERROR FETCHING CART
          $data['cart_products'] = $db_result;
          $this->load->view('cart/cart_page', $data);
      } else {
        return false;
      }

    } else { //~ IF USER NOT LOGGED IN
      redirect('login');
    }
  }

  public function add_to_cart() {
    $post_data = $this->input->post();
    $db_result = $this->cart_model->insert_to_cart($post_data);

    if($db_result == "product_add_successful")
    {
      echo "add_successful";

    } else if($db_result == "product_update_successful")
    {
      echo "update_successful";

    } else if($db_result == "quantity_more_than_stock_amount") {
      echo "more_than_stock_amount";

    } else {
      echo "error";
    }
  }

  public function remove_cart_product() {
    $post_data = $this->input->post();
    $db_result = $this->cart_model->remove_from_cart($post_data);

    if($db_result == true) {
      echo true;
    } else {
      echo false;
    }
  }

  public function increment_cart_product() {
    $post_data = $this->input->post();
    $db_result = $this->cart_model->increment_cart_item($post_data);

    if($db_result != false) {
      echo $db_result;

    } else {
      echo false;

    }

  }

  public function decrement_cart_product() {
    $post_data = $this->input->post();
    $db_result = $this->cart_model->decrement_cart_item($post_data);

    if($db_result != false) {
      echo $db_result;

    } else {
      echo false;

    }
  }

  public function check_cart_stock() {
    $db_result = $this->cart_model->check_cart_stock_amount();

    if($db_result == true) {
      
      echo true;
    
    } else {

      echo false;
    }
  }

  public function checkout_cart() {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN

      $db_result = $this->cart_model->display_cart_products();

      if($db_result != false)
      { //IF NO ERROR FETCHING CART
          $data['cart_products'] = $db_result;
          $this->load->view('cart/checkout_page', $data);
      } else {
        return false;
      }

    } else { //~ IF USER NOT LOGGED IN
      redirect('login');
    }
  }

}
?>
