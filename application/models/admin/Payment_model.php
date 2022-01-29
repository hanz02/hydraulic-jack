<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Payment_model extends CI_Model
 {

   public function __construct()
   {
     parent::__construct();
     $this->load->database();
     $this->load->library('form_validation');
   }

   public function get_user_payment() 
   {
       $this->db->select('payment.payment_date, 
                            payment.payment_id, 
                            payment.ID_prefix AS payment_ID_prefix, 
                            payment.transaction_type, 
                            
                            art_product.product_name, 
                            art_product_img.product_img, 
                            art_product.product_id, 
                            
                            payment_art.quantity, 
                            payment_art.total, 
                            
                            client.username, 
                            client.client_id, 
                            client.ID_prefix AS client_ID_prefix');
       
       $this->db->from('payment_art');
       $this->db->join('payment', 'payment.payment_id = payment_art.payment_id');

       $this->db->join('art_product', 'art_product.product_id = payment_art.product_id');
       $this->db->join('art_product_img', 'art_product.product_id = art_product_img.product_id');

       $this->db->join('client', 'client.client_id = payment.client_id');

       $query = $this->db->get();

       if($query -> num_rows() > 0) { //IF ONLY ONE EMAIL EXISTS
         return $query->result();
         
       } else {
         return false;
       }

   }

   public function get_payment_record($payment_id) {
    $this->db->select('*');
    $this->db->from('payment');
    $this ->db-> where('payment_id', $payment_id);

    $query = $this->db->get();
    
    if($query -> num_rows() == 1) { //IF ONLY ONE EMAIL EXISTS
      return $query->result();
      
    } else {
      return false;
    }
  }

   public function get_payment_art($payment_id) {
    $this->db->select('*');
    $this->db->from('art_product');
    $this->db->join('payment_art', 'payment_art.product_id = art_product.product_id');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this ->db->where('payment_art.payment_id', $payment_id);

    $query = $this->db->get();

    if($query -> num_rows() > 0) { //IF ONLY ONE EMAIL EXISTS
      return $query->result();
      
    } else {
      return false;
    }
   }

   public function filterLatestPayment($data)
   {
    $this->db->select('payment.payment_date, 
    payment.payment_id, 
    payment.ID_prefix AS payment_ID_prefix, 
    payment.transaction_type, 
    
    art_product.product_name, 
    art_product_img.product_img, 
    art_product.product_id, 
    
    payment_art.quantity, 
    payment_art.total, 
    
    client.username, 
    client.client_id, 
    client.ID_prefix AS client_ID_prefix');

    $this->db->from('payment_art');
    $this->db->join('payment', 'payment.payment_id = payment_art.payment_id');

    $this->db->join('art_product', 'art_product.product_id = payment_art.product_id');
    $this->db->join('art_product_img', 'art_product.product_id = art_product_img.product_id');

    $this->db->join('client', 'client.client_id = payment.client_id');
    $this->db->order_by('payment.payment_date','DESC');

    $query = $this->db->get();

    if($query -> num_rows() > 0) { //IF ONLY ONE EMAIL EXISTS
    return $query->result();

    } else {
    return false;
    }
   }

   public function filterOldestPayment($data)
   {
    $this->db->select('payment.payment_date, 
    payment.payment_id, 
    payment.ID_prefix AS payment_ID_prefix, 
    payment.transaction_type, 
    
    art_product.product_name, 
    art_product_img.product_img, 
    art_product.product_id, 
    
    payment_art.quantity, 
    payment_art.total, 
    
    client.username, 
    client.client_id, 
    client.ID_prefix AS client_ID_prefix');

    $this->db->from('payment_art');
    $this->db->join('payment', 'payment.payment_id = payment_art.payment_id');

    $this->db->join('art_product', 'art_product.product_id = payment_art.product_id');
    $this->db->join('art_product_img', 'art_product.product_id = art_product_img.product_id');

    $this->db->join('client', 'client.client_id = payment.client_id');
    $this->db->order_by('payment.payment_date','ASC');

    $query = $this->db->get();

    if($query -> num_rows() > 0) { //IF ONLY ONE EMAIL EXISTS
    return $query->result();

    } else {
    return false;
    }
   }
}
?>