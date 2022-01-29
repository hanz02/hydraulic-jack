<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_control extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url', 'form');
    $this->load->library('session');

    $this->load->model('payment_model');
    $this->load->model('user_model');

  }

  public function index() {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN

      $calc_result = $this->payment_model->calc_payment_total();

      if($calc_result != false)
      { //~ IF NO ERROR calc_payment_total
          $data['calc_result'] = $calc_result;
          $this->load->view('payment/payment_page', $data);

      } else {
        redirect('login');
      }

    } else { //~ IF USER NOT LOGGED IN
      redirect('login');
    }
  }

  public function to_make_payment()
  {
    redirect('payment_control', 'location', 303);
  }



  // public function display_receipt() {
  //   $user_data = $this->user_model->get_user_data();
    
  //   if($user_data != false) {
  //     $data['user_data'] = $user_data;
  //     $this->load->view('payment/receipt_page', $data);
  //   } else {
  //     echo 'database error fetching user data';
  //   }
  // }

//   public function record_payment() {
//     if($this->session->result_payment != false && $this->session->result_payment_art != false && $this->session->user_data != false) 
//     {
//       $data['payment_data'] = $this->session->result_payment;
//       $data['payment_art_data'] = $this->session->result_payment_art;
//       $data['user_data'] = $this->session->user_data;

//       $this->load->view('payment/receipt_page', $data);

//     } else {
//       echo "error record payment controller";
//       unset($_SESSION['payment_complete']);
//     }
// }

// public function to_record_payment()
// {
//   if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
//   { //~ IF USER LOGGED IN
    
//     $post_data = $this->input->post();

//     $payment_id = $this->payment_model->store_payment_detail($post_data);
    
//     $db_result_payment = $this->payment_model->get_payment_record($payment_id);
//     $db_result_payment_art = $this->payment_model->get_payment_art($payment_id);
//     $user_data = $this->user_model->get_user_data();

//     $_SESSION['result_payment'] =  $db_result_payment;
//     $_SESSION['result_payment_art'] = $db_result_payment_art;
//     $_SESSION['user_data'] = $user_data;

//     redirect('payment_control/record_payment', 'location', 303);

//   } else { //~ IF USER NOT LOGGED IN
//     redirect('login');
//   }
// }


public function record_payment() {
  if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
  { //~ IF USER LOGGED IN
    if($this->session->flashdata("complete_payment") != '') 
    {
      $data['payment_data'] = $this->session->flashdata("complete_payment")[0];
      $data['payment_art_data'] = $this->session->flashdata("complete_payment")[1];
      $data['user_data'] = $this->session->flashdata("complete_payment")[2];
      $this->load->view('payment/receipt_page', $data);

    } else {
      redirect('home');
    }
  } else { //~ IF USER NOT LOGGED IN
    redirect('login');
  }
}

public function to_record_payment()
{
  if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
  { //~ IF USER LOGGED IN
    
    $post_data = $this->input->post();

    $payment_id = $this->payment_model->store_payment_detail($post_data);
    
    $db_result_payment = $this->payment_model->get_payment_record($payment_id);
    $db_result_payment_art = $this->payment_model->get_payment_art($payment_id);
    $user_data = $this->user_model->get_user_data();

    $data_array = array($db_result_payment, $db_result_payment_art, $user_data);

    $this->session->set_flashdata("complete_payment", $data_array);

    redirect('payment_control/record_payment', 'location', 303);

  } else { //~ IF USER NOT LOGGED IN
    redirect('login');
  }
}
}