<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_control extends CI_Controller {

  public function __construct()
  {
 	 parent::__construct();
     $this->load->helper(array('url', 'form'));
     $this->load->library(array('form_validation', 'session'));
     $this->load->database();
     $this->load->model('user_model');

  }

  /* View Login */
  public function index()
  {

    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {
      redirect('home');
    } else {
      $this->load->view('login/login_page');
    }
  }

  /*When user clicked login*/
  public function login_submit()
  {
    $login_data = $this->input->post();
    $validate_result = $this->user_model->validate_login($login_data);

    if($validate_result["login_validate"] == false) { //if login fail
      redirect('login');

    } else { //if login successful
      $this->session->set_userdata('login', "1");
      $this->session->set_userdata('login_profile_img',  $validate_result["profile_img"]);
      $this->session->set_userdata('login_client_id',  $validate_result["client_id"]);
      $this->session->set_userdata('profile_img_state',  $validate_result["profile_img_status"]);
      $this->session->set_userdata('username',  $validate_result["username"]);

      redirect('home');
    }
  }

  /* View Sign up */
  public function view_signup()
  {
    $this->load->view('login/signup_page');
  }

  /*When user clicked sign up*/
  public function signup_submit()
  {
    $login_data = $this->input->post();
    $validate_result = $this->user_model->validate_signup($login_data);

    if($validate_result == true) {  //if signup successful
      $this-> index();

    } else { //if signup fail
        $this->session->set_flashdata('error_email', "Your email provided has already been registered");
        redirect('signup');
        
    }
  }

  /* Logout user account */
  public function logout()
  {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {
      $this->session->sess_destroy();
      redirect('home');
    } else {
      redirect('home');
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
