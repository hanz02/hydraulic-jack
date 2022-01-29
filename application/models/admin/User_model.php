<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class User_model extends CI_Model {

   public function __construct() {
     parent::__construct();
     $this->load->database();
     $this->load->library('form_validation');
     $this->load->library('session');
   }

    public function get_user_data($data) {
    $this->db->select('*'); //COLUMNS SELECTED
    $this->db->from('client'); //TABLE NAME PROVIDED
    $this->db->where(array(
        'client_id' => $data,
    ));

    $query = $this->db->get();

    if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
        return $query->result();
        
    } else {
        return false;
    }
    }

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
