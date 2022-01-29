<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class User_model extends CI_Model {

   public function __construct() {
     parent::__construct();
     $this->load->database();
     $this->load->library('form_validation');
     $this->load->library('session');
   }

    public function validate_login($login_data) {
      $this->db->select('password'); //COLUMNS SELECTED
      $this->db->from('tbl_client'); //TABLE NAME PROVIDED
      $this->db->where(array(
        'email' => $login_data['email']
      ));

      $query = $this->db->get();

      if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS

       foreach ($query->result() as $row) {
         $db_pw = $row->password;

         if(password_verify($login_data['password'], $db_pw)) { //IS PASSWORD VERIFY TRUE

           $this->db->select('*'); //COLUMNS SELECTED
           $this->db->from('tbl_client'); //TABLE NAME PROVIDED
           $this->db->where(array(
             'email' => $login_data['email']
           ));

           $result = $this->db->get()->row();

           return array(
             "login_validate" => true,
             "profile_img" => $result->profile_img,
             "client_id" => $result->client_id,
             "profile_img_status" => $result->profile_img_state,
             "username" => $result->username
           );

         } else { //IF VERIFY PASSWORD WRONG
           $this->session->set_flashdata('error_login_pw', 'Invalid password, please try again');
           return array(
             "login_validate" => false
           );
         }
       }

     } else { //IF MORE THAN ONE EMAIL EXISTS
       $this->session->set_flashdata('error_login_email', 'Invalid email, please try again');
       return array(
         "login_validate" => false
       );
     }
    }

   public function validate_signup($signup_data) {

     $config_rules = array(
       array(

         "field" => "email",
         "label" => "Email",
         "rules" => "is_unique[tbl_client.email]",
         "errors" => array(
             'is_unique' => 'The %s is already taken.'
         )
       ),

       array(
         "field" => "password",
         "label" => "Password"
       )
     );

     $this->form_validation->set_rules($config_rules);

     if($this->form_validation->run() == false) {
         return false;

     } else {
       $query_array = array(
         "first_name" => $signup_data['f-name'],
         "last_name" => $signup_data['l-name'],
         "email" => $signup_data['email'],
         "gender" => $signup_data['gender_selected'],
         "dob" => $signup_data['birthday'],
         "username" => $signup_data['u-name'],
         "password" => password_hash($signup_data['password'], PASSWORD_DEFAULT),
         "profile_img" => '/assets/img/default_account.png',
         "profile_img_state" => 0,
         "bg_img" => '/assets/img/default_bg.jpg',
         "bg_img_state" => 0,
         "ID_prefix" => "CNT"
       );

       return $this->db->insert("tbl_client", $query_array);
   }
 }

 public function verify_email($post_data) {

  $this->db->select('email'); //COLUMNS SELECTED
  $this->db->from('client'); //TABLE NAME PROVIDED
  $this->db->where(array(
    'email' => $post_data['email'],
    'client_id' => $this->session->userdata('login_client_id'),
  ));

  $query = $this->db->get();

  if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
    return true;
  } else {
    return false;
  }
 }

 public function get_user_data() {
  $this->db->select('*'); //COLUMNS SELECTED
  $this->db->from('client'); //TABLE NAME PROVIDED
  $this->db->where(array(
    'client_id' => $this->session->userdata('login_client_id'),
  ));

  $query = $this->db->get();

  if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
    return $query->result();
    
  } else {
    return false;
  }
 }

  public function updateProfileImg($image)
  {

    $old_prof = $this->session->userdata('login_profile_img');

    $this->db->trans_start();
    $this->db->where(array(
      'client_id' => $this->session->userdata('login_client_id'),
    ));
    $this->db->update('client', array(
      'profile_img' => $image,
      'profile_img_state' => 1,
    ));
    $this->db->trans_complete();

    if($this->db->trans_status() === true) //* IF INSERT PAYMENT RECORD SUCCESSFUL
    {
      $this->deleteProfileImg($old_prof);
      return $image;

    } else {
      return false;
    }
  }

  public function updateBgImg($image) {
    $old_bg = $this->getBgImg();

    if($old_bg!= false){
      $this->db->trans_start();
      $this->db->where(array(
        'client_id' => $this->session->userdata('login_client_id'),
      ));
      $this->db->update('client', array(
        'bg_img' => $image,
        'bg_img_state' => 1,
      ));
      $this->db->trans_complete();
  
      if($this->db->trans_status() === true) //* IF INSERT PAYMENT RECORD SUCCESSFUL
      { 
        $this->deleteBgImg($old_bg);
        return $image;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  public function getBgImg() {
    $this->db->select('bg_img, bg_img_state'); //COLUMNS SELECTED
    $this->db->from('client'); //TABLE NAME PROVIDED
    $this->db->where(array( 
      'client_id' => $this->session->userdata('login_client_id'),
    ));
  
    $query = $this->db->get();
  
    if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
      return $query->result();
      
    } else {
      return false;
    }
  }

  public function deleteProfileImg($old_prof) {
    if($this->session->userdata('profile_img_state') == 1) { //* REMOVE THE OLD PROFILE IMAGE IN SERVER
      $to_delete_path = FCPATH . '/assets/img/profile_img/'. $old_prof;
      unlink($to_delete_path);
    }
  }

  public function deleteBgImg($old_bg) {
    if($old_bg == false) {
      return false;
    }else if($old_bg[0]->bg_img_state == 1) {
      $to_delete_path = FCPATH . '/assets/img/bg_img/'. $old_bg[0]->bg_img;
      unlink($to_delete_path);
    }
  }
}

?>
