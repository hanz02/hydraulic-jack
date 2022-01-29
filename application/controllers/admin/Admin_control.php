<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_control extends CI_Controller {

  public function __construct()
  {
 	 parent::__construct();
     $this->load->helper(array('url', 'form'));
     $this->load->library(array('form_validation', 'session'));
     $this->load->database();
     $this->load->model('admin/admin_model');

  }

  /* View Login */
  public function index()
  {
    $this->load->view('admin/user/login_page');
  }

  /** When user clicked login*/
  public function login_submit()
  {
    $login_data = $this->input->post();
    $validate_result = $this->admin_model->validate_login($login_data);

    if($validate_result["login_validate"] == false) { //* if login fail
      redirect('hj-admin/login');

    } else { //* if login successful
      $this->session->set_userdata('login_admin', "1");
      $this->session->set_userdata('login_profile_img_admin',  $validate_result["profile_img"]);
      $this->session->set_userdata('login_id_admin',  $validate_result["admin_id"]);
      $this->session->set_userdata('profile_img_state_admin',  $validate_result["profile_img_status"]);
      $this->session->set_userdata('username_admin',  $validate_result["username"]);

      redirect('hj-admin');
    }
  }

  /* Logout user account */
  public function logout()
  {
    if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1") {
      $this->session->sess_destroy();
      redirect('hj-admin');
    } else {
      redirect('hj-admin');
    }
  }

  public function validate_email()
  {
    $post_data = $this->input->post();
    $validate_result = $this->user_model->verify_email($post_data);
    
    echo $validate_result;
  }

  
}
?>
