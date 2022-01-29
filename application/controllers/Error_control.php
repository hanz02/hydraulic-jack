<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_control extends CI_Controller {

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
      $this->load->view('errors/base_error');
    } else {
      redirect('login');

    }
  }
}