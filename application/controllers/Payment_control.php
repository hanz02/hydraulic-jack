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

public function getPayHistory() {
  if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
  {
    $data = $this->input->get();

    //* check if we need to load payment from specific row
    $offset = !empty($data) ? $data["offset"] : 0;

    if(is_null($offset)) {
      return false;
    }
      
    //* fetch first 5 payment records starting form row 0
    /** 
      * @param mixed $payment_id
      * @param mixed $user_id
      * @param mixed $count
      * @param int $offset
    */
    $db_result_payment = $this->payment_model->get_payment_record(null, $this->session->userdata('login_client_id'), 6, $offset);
    if($db_result_payment == false)
    {
      echo json_encode(new stdClass);
      return;
    } else 
    {
      $counter = 0;
      foreach($db_result_payment as $payment)
      {
        $art_data = $this->payment_model->get_payment_art($payment->payment_id, 3, 0, "ASC");
        $db_result_payment[$counter]->art_data = $art_data;
        $counter++;
      }

      // get amount of fetched payment and attach it at the last payment
      // $db_result_payment[count($db_result_payment) - 1] -> fetched_amount_payment = count($db_result_payment);

      echo json_encode($db_result_payment);
      return;
    }
    

  } else { //~ IF USER NOT LOGGED IN
    redirect('login');
  }
}

public function get_payment_history_receipt() {
  if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
  {
    $data = $this->input->get();
    $db_result_payment = $this->payment_model->get_payment_record($data["payment_id"]);
    $db_result_payment_art = $this->payment_model->get_payment_art($data["payment_id"]);
    $user_data = $this->user_model->get_user_data();

    if($db_result_payment != false && $db_result_payment_art != false && $user_data != false) 
    {
      $data['payment_data'] = $db_result_payment;
      $data['payment_art_data'] = $db_result_payment_art;
      $data['user_data'] = $user_data;
      $data['access_user_type'] = "client" ;


      $output = $this->load->view('payment/payment_history_page', $data, true);
      echo json_encode($output);
    } else 
    {
      echo 'SORRY, SOME INTERNAL SERVER PROBLEM OCCURED. PLEASE HANG ON, WE WILL FIX IT SOON';
    }
  } else { //~ IF USER NOT LOGGED IN
    redirect('login');
  }
}
}