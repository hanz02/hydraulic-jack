<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function get_users() {
        $this->db
        ->select('client_id, username, ID_prefix, email, gender, profile_img, profile_img_state') //COLUMNS SELECTED
        ->from('client');

        $query = $this->db->get();

        if($query -> num_rows() > 0) { //IF ONLY ONE EMAIL EXISTS
            return $query->result();
            
        } elseif ($query -> num_rows() == 0) {
            return "empty_clients";
        } else 
        {
          return false;

        }
    }

    public function get_client_spec($data)
    {
        $this->db->select('*'); //COLUMNS SELECTED
        $this->db->from('client'); //TABLE NAME PROVIDED
        $this->db->where(array(
          'client_id' => $data['client_id'],
        ));
      
        $query = $this->db->get();

        if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
          return $query->result();
          
        } else {
          return false;
        }
    }
}

?>
