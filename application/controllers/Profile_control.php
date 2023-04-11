<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile_control extends CI_Controller {
  public function __construct()
  {
 	 parent::__construct();
     $this->load->helper(array('url', 'form'));
     $this->load->library(array('form_validation', 'session'));
     $this->load->database();
     $this->load->model('user_model');
  }

  public function index()
  {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN
      $client_data = $this->user_model->get_user_data();
      $data['profile_data'] =  $client_data;

  //* access user type token is to identify user type and set up data-user-type attr in profile html page (related to purchase history paymeny page viewing)
      $data['access_user_type'] =  "client";
      $this->load->view('user/user_profile_page', $data);
      
    } else {
      redirect('login');
    }
  }

  public function loadBgUser() {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN
      $result = $this->user_model->getBgImg();
      
      if($result != false) {
        $bg_array = array(
          "bg_img" => $result[0]->bg_img,
          "bg_state" => $result[0]->bg_img_state,
        );

        echo json_encode($bg_array);
      } else {
        return false;
      }
    } else {
      redirect('login');
    }
  }

  public function changeProfileImg()
  {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN
      $config['upload_path'] = 'assets/img/profile_img';
      $config['allowed_types'] = 'gif|png|jpg';
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);

      //* provide name attr of the 'file' type input
      if($this->upload->do_upload('profile-img-upload')) 
      { 
        $data = array('upload_data' => $this->upload->data());

        $image = $data['upload_data']['file_name'];
        $result = $this->user_model->updateProfileImg($image);

        if($result != false) {
          $this->session->set_userdata('login_profile_img',  $result);
          $this->session->set_userdata('profile_img_state', 1);
          echo $result;
          
        } else {
          echo false;

        }

      } else {
        echo "INVALID FILE UPLOAD";
      }
    } else {
      redirect('login');
    }
  }

  public function changeBgImg() 
  {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1")
    { //~ IF USER LOGGED IN
      $config['upload_path'] = 'assets/img/bg_img';
      $config['allowed_types'] = 'png|jpg';
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);

      //* NAME OF THE FILE INPUT TAG-00 
      if($this->upload->do_upload('bg-img-upload'))
      { 
        $data = array('upload_data' => $this->upload->data());

        $image = $data['upload_data']['file_name'];
        $result = $this->user_model->updateBgImg($image);

        if($result != false) {
          echo $result;
          
        } else {
          echo false;

        }

      } else {
        echo "INVALID FILE UPLOAD";
      }
    } else {
      redirect('login');
    }
  }
}

?>
