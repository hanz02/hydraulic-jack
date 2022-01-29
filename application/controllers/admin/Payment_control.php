<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_control extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url', 'form');
    $this->load->library('session');

    $this->load->model('admin/payment_model', 'admin_payment_model');
    $this->load->model('admin/user_model', 'admin_user_model');

  }

  public function index() {
    if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
    { //~ IF admin LOGGED IN

    $db_result = $this->admin_payment_model->get_user_payment();

    if($db_result != false) 
    {
        $data['payment_data'] = $db_result;
        $this->load->view('admin/payments/payments_page', $data);
        
    } else
    {

    }

    } else { //~ IF admin NOT LOGGED IN
      redirect('hj-admin');
    }
  }

  public function view_payment_spec() 
  {
    //* 'CLIENT_ID' AND 'PAYMENT_ID' TO GET THE RECEIPT
    $data = $this->input->get();
    $db_pay_product = $this->admin_payment_model->get_payment_art($data['payment_id']);
    $db_payment = $this->admin_payment_model->get_payment_record($data['payment_id']);
    $db_user = $this->admin_user_model->get_user_data($data['client_id']);

    // print_r($db_payment);
    // print_r($db_pay_product);
    // print_r($db_user);

    if($db_pay_product != false && $db_payment != false && $db_user != false) 
    {
      $data['payment_data'] = $db_payment;
      $data['payment_art_data'] = $db_pay_product;
      $data['user_data'] = $db_user;

      $this->load->view('admin/payments/payment_spec_page', $data);

    } else 
    {
      echo 'SORRY, SOME INTERNAL SERVER PROBLEM OCCURED. PLEASE HANG ON, WE WILL FIX IT SOON';
    }
    
  }

  public function filterLatest() {
    $data = $this->input->get();
    $result = false;

    if($data['option'] == "filter_latest_payment")
    {
      $result = $this->admin_payment_model->filterLatestPayment($data);
    } else if($data['option'] == "filter_oldest_payment")
    {
      $result = $this->admin_payment_model->filterOldestPayment($data);
    } else {
      return false;
    }

    if($result != false) {
      $output = '';
      foreach($result as $product)
      {
        $output .= 
          '<form action="payment_control/view_payment_spec" method="GET" "class"="view_pay_spec_form" >

          <div class="payment_contain m-y4">
              <div class="flex">

                  <div class="product_id f-w-heavy f-left">
          ' .
                      $product->payment_ID_prefix . " " . $product->payment_id
            .'
                      <input type="hidden" name="payment_id" value="'. $product->payment_id .'">
                  </div>

                  <div class="product_info m-y2">
                        <div class="product_img">
                            <img src="'.base_url(). $product->product_img .'" alt="">
                            <input type="hidden" value="'. $product->product_id .'" name="product_id" class="product_id">
                        </div>

                        <div>
                            <a href="#" class="product_name f-w-heavy">'. $product->product_name .'</a>
                        </div>
                  </div>

                  <div class="grid payment_info">

                      <div class="pay_amount f-middle m-x2 table_cell">
                          <div class="table_head">
                              AMOUNT
                          </div>
                          <div class="table_body m-y1 f-sm-1">
                              RM'. $product->total .'
                          </div>
                      </div>

                      <div class="pay_quant table_cell">
                          <div class="table_head">
                              QTY
                          </div>
                          <div class="table_body">
                            '. $product->quantity .'
                          </div>
                      </div>

                      <div class="pay_date table_cell">
                          <div class="table_head">
                              DATE OF 
                              PAYMENT
                          </div>
                          <div class="table_body">
                          '. $product->payment_date .'
                          </div>
                      </div>

                      <div class="pay_type table_cell">
                          <div class="table_head">
                              TRANSACTION <br />
                              TYPE
                          </div>
                          <div class="table_body">
                          '. $product->transaction_type .'
                          </div>
                      </div>
                      
                      <div class="payer_name table_cell">
                          <div class="table_head">
                              PAYER:
                          </div>
                          <div class="table_body">
                              ID: '. $product->client_ID_prefix ." ". $product->client_id .'
                              <input type="hidden" name="client_id" value="'. $product->client_id .'">

                              <br />
                              '. $product->username .'
                          </div>
                      </div>
                  </div>
              </div>

              <div class="view_details_btn">
                  <button type="submit" class="f-w-heavy">VIEW DETAILS</button>
              </div>
          </div>

          </form>
        ';
      }
      echo $output;
    } else 
    {
      return false;
    }
  }

}