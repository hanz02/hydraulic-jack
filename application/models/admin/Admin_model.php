<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Admin_model extends CI_Model {

   public function __construct() {
     parent::__construct();
     $this->load->database();
     $this->load->library('form_validation');
     $this->load->library('session');
   }

    public function validate_login($login_data) {
      $this->db->select('*'); //COLUMNS SELECTED
      $this->db->from('tbl_artist'); //TABLE NAME PROVIDED
      $this->db->where(array(
        'email' => $login_data['email']
      ));

      $query = $this->db->get();

      if($query -> num_rows() == 1) { //* IF ONLY ONE EMAIL EXISTS

       foreach ($query->result() as $row) {
         $db_pw = $row->password;

         if(password_verify($login_data['password'], $db_pw)) { //IS PASSWORD VERIFY TRUE

           return array(
             "login_validate" => true,
             "profile_img" => $row->profile_img,
             "admin_id" => $row->artist_id,
             "profile_img_status" => $row->profile_img_state,
             "username" => $row->user_name
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

//  public function get_user_data() {
//   $this->db->select('*'); //COLUMNS SELECTED
//   $this->db->from('client'); //TABLE NAME PROVIDED
//   $this->db->where(array(
//     'client_id' => $this->session->userdata('login_client_id'),
//   ));

//   $query = $this->db->get();

//   if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
//     return $query->result();
    
//   } else {
//     return false;
//   }
//  }

//   public function updateProfileImg($image)
//   {

//     $this->db->trans_start();
//     $this->db->where(array(
//       'client_id' => $this->session->userdata('login_client_id'),
//     ));
//     $this->db->update('client', array(
//       'profile_img' => $image,
//       'profile_img_state' => 1,
//     ));
//     $this->db->trans_complete();

//     if($this->db->trans_status() === true) //* IF INSERT PAYMENT RECORD SUCCESSFUL
//     { 

//       return $image;

//     } else {
//       return false;
//     }
//   }

//   public function updateBgImg($image) {

//     $this->db->trans_start();
//     $this->db->where(array(
//       'client_id' => $this->session->userdata('login_client_id'),
//     ));
//     $this->db->update('client', array(
//       'bg_img' => $image,
//       'bg_img_state' => 1,
//     ));
//     $this->db->trans_complete();

//     if($this->db->trans_status() === true) //* IF INSERT PAYMENT RECORD SUCCESSFUL
//     { 
//       return $image;

//     } else {
//       return false;
//     }
    
//   }

//   public function getBgImg() {
//     $this->db->select('bg_img, bg_img_state'); //COLUMNS SELECTED
//     $this->db->from('client'); //TABLE NAME PROVIDED
//     $this->db->where(array( 
//       'client_id' => $this->session->userdata('login_client_id'),
//     ));
  
//     $query = $this->db->get();
  
//     if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
//       return $query->result();
      
//     } else {
//       return false;
//     }
//   }
}

?>
