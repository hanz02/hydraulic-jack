<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Cart_model extends CI_Model
 {

   public function __construct()
   {
     parent::__construct();
     $this->load->database();
     $this->load->library('form_validation');
   }

   public function insert_to_cart($post_data)
   {
     $query_array = array(
       "client_id" => $this->session->userdata('login_client_id'),
       "product_id" => $post_data['product_id'],
       "ID_prefix" => "CRT",
       "quantity" => $post_data['quantity']
     );

     $this->db->select('client_id, product_id, quantity');
     $this->db->from('cart');
     $this->db->where(array(
       'client_id' => $this->session->userdata('login_client_id'),
       'product_id' => $post_data['product_id']
     ));
     $query = $this->db->get();

     if($query -> num_rows() == 0)
     { //~ ITEM NOT EXISTS IN CART
       $this->db->insert("cart", $query_array);

       return "product_add_successful";

     } else if($query -> num_rows() == 1) { //~ ITEM ALREADY IN CART

        // UPDATE QUANTITY FOR EXISTING ITEM IN CART
       $db_quantity = $query->row()->quantity;
       $db_quantity += $post_data['quantity'];
       $query_array['quantity'] = $db_quantity;

       if($query_array['quantity'] > $post_data['stock_amount'])
       { //~ IF QUANTITY UPDATED IS MORE THAN STOCK AMOUNT
        return "quantity_more_than_stock_amount";

      } else if($query_array['quantity'] <= $post_data['stock_amount']) {

          $this->db->trans_start();
          $this->db->where(array(
            'client_id' => $this->session->userdata('login_client_id'),
            'product_id' => $post_data['product_id']
          ));
          $this->db->update('cart', $query_array); //SPECIFY TABLE NAME and $data
          $this->db->trans_complete();

          if ($this->db->trans_status() === FALSE) //~ IF UPDATE FAILED
          {
            return false;
          } else { //~ IF UPDATE SUCCESSFUL
            return "product_update_successful";
          }

        }

     } else { //~ MORE THAN 1 SAME ITEM IN CART (GRAVE EXCEPTION)
       return false;
     }
   }

    // FETCH PRODUCTS IN CART
   public function display_cart_products()
   {
     $this->db->select('*');
     $this->db->from('cart');
     $this->db->join('art_product', 'art_product.product_id = cart.product_id');
     $this->db->join('art_product_img', 'art_product_img.product_id = cart.product_id');
     $this->db->where(array(
       'client_id' => $this->session->userdata('login_client_id'),
     ));
     $this->db->order_by('cart_id', 'DESC');
     $query = $this->db->get();

     if($query -> num_rows() > 0) { // IF PRODUCTS IN CART, WE RETURN IT!
       return $result = $query->result();

     } else if($query -> num_rows() == 0) { // IF PRODUCTS NOT CART, WE SAY EMPTY CART
       return "empty_cart";

     } else { //IF ANY ERROR
       return false;
     }
   }

   public function remove_from_cart($post_data) {
     return $this->db->delete('cart', array(
       'product_id' => $post_data['product_id'],
       'client_id' => $this->session->userdata('login_client_id')
     ));
   }

   public function increment_cart_item($post_data)
   {
     $query_array = array(
      "quantity" => $post_data['quantity'] + 1,
     );

     $this->db->select('*');
     $this->db->from('cart');
     $this->db->where(array(
       'client_id' => $this->session->userdata('login_client_id'),
       'cart_id' => $post_data['cart_id']
     ));
     $query = $this->db->get();

    if($query -> num_rows() == 1) { //~ IF CART EXISTS

      $this->db->trans_start();
      $this->db->where(array(
        'client_id' => $this->session->userdata('login_client_id'),
        "cart_id" => $post_data['cart_id'],
        'product_id' => $post_data['product_id']
      ));
      $this->db->update('cart', $query_array); //~ SPECIFY TABLE NAME and $data
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      { //! IF QUANTITY UPDATE FAIL
        return false;

      } else {  //~ IF QUANTITY UPDATE SUCCESS
        return $query_array['quantity'];

      }

    } else {  //! IF CART DOES NOT EXISTS
      return false;
    }
   }

   public function decrement_cart_item($post_data) {
     $query_array = array(
      "cart_id" => $post_data['cart_id'],
      "quantity" => $post_data['quantity'] - 1,
      "product_id" => $post_data['product_id']
     );

     $this->db->select('*');
     $this->db->from('cart');
     $this->db->where(array(
       'client_id' => $this->session->userdata('login_client_id'),
       'cart_id' => $post_data['cart_id']
     ));
     $query = $this->db->get();

     if($query -> num_rows() == 1) { //~ IF CART EXISTS

       $this->db->trans_start();
       $this->db->where(array(
         'client_id' => $this->session->userdata('login_client_id'),
         "cart_id" => $post_data['cart_id'],
         'product_id' => $post_data['product_id']
       ));
       $this->db->update('cart', $query_array); //~ SPECIFY TABLE NAME and $data
       $this->db->trans_complete();

       if ($this->db->trans_status() === FALSE)
       { //! IF QUANTITY UPDATE FAIL
         return false;

       } else {  //~ IF QUANTITY UPDATE SUCCESS
         return $query_array['quantity'];

       }

     } else { //! IF CART DOES NOT EXISTS
       return false;
     }
   }

   public function check_cart_stock_amount() {
     $this->db->select('*');
     $this->db->from('cart');
     $this->db->join('art_product', 'art_product.product_id = cart.product_id');
     $this->db->where(array(
       'client_id' => $this->session->userdata('login_client_id'),
       'art_product.stock_amount' => 0
     ));
     $query = $this->db->get();

     if($query -> num_rows() > 0) { // IF PRODUCTS IN CART ARE OUT OF STOCKS
       return true;

     } else if($query -> num_rows() <= 0) { // IF PRODUCTS IN CARTS ARE FINE
       return false;
     }
   }
}
?>
