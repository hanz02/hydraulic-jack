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

   public function calc_payment_total() 
   {
        $this->db->select('art_product.price,quantity');
        $this->db->from('art_product');
        $this->db->join('cart', 'cart.product_id = art_product.product_id');
        $this->db->where(array(
        'cart.client_id' => $this->session->userdata('login_client_id'),
        ));

        $query = $this->db->get();

        if($query -> num_rows() > 0) 
        { 
            $quantity = 0;
            $subtotal = 0;
            $total = 0;

            foreach ($query->result() as $row) {
                $quantity += $row->quantity;
                $subtotal += $row->quantity * $row->price; 
            }

            if($quantity > 0 && $subtotal > 0)
            {
                $total = $subtotal;
                $total_calculcation = array(
                    "quantity" => $quantity,
                    "subtotal" => $subtotal,
                    "total" => $total
                );

                return $total_calculcation;
            }
   
        } else { 
          return false;
        }
   }

   public function store_payment_detail($post_data)
   {
    $payment_date = date("Y-m-d");
    $query_array = array(
      "payment_date" => $payment_date,
      "payment_amount" => $post_data['total-amount'],
      "transaction_type" => $post_data['transact-type'],
      "ID_prefix" => "PYMT",
      "client_id" => $this->session->userdata('login_client_id')
    );

      $this->db->trans_start();
      $this->db->insert('payment', $query_array);
      $payment_id = $this->db->insert_id();
      $this->db->trans_complete();

      if($this->db->trans_status() === true) //* IF INSERT PAYMENT RECORD SUCCESSFUL
      { 
        //* GET PRODUCTS FROM CART PURCHASED
        $this->db->select('cart.product_id,quantity,art_product.price');
        $this->db->from('cart');
        $this->db->join('art_product', 'cart.product_id = art_product.product_id');
        $this->db->where(array(
          'client_id' => $this->session->userdata('login_client_id')
        ));

        $query = $this->db->get();

        if($query -> num_rows() > 0) { 

          //* INSERT RECORDS TO 'PAYMENT FOR PRODUCTS' TABLE FROM CART
          //~ update product stock amount when user make payment for it
          foreach ($query->result() as $row) { 
            $total = $row->price * $row->quantity;

            $query_array = array(
              'payment_id' => $payment_id,
              'product_id' => $row->product_id,
              'quantity' => $row->quantity,
              'total' => $total
            );

            $this->db->trans_start();

            //~ insert to payment art table from cart
            $this->db->insert('payment_art', $query_array);

            //~ update product stock amount when user make payment for it
            $this->db->set('stock_amount', 'stock_amount-'.$row->quantity, FALSE);
            $this->db->where(array(
              'product_id' => $row->product_id
            ));
            $this->db->update('art_product'); //SPECIFY TABLE NAME and $data

            //~ update product amount sold when user make payment for it
            $this->db->set('amount_sold', 'amount_sold+'.$row->quantity, FALSE);
            $this->db->set('total_revenue', 'total_revenue+'.$total, FALSE);
            $this->db->where(array(
              'product_id' => $row->product_id
            ));
            $this->db->update('art_product'); //SPECIFY TABLE NAME and $data

            $this->db->trans_complete();
            
            if ($this->db->trans_status() === TRUE) //* IF INSERT SUCCESS
            {
              continue;

            } else {
              return false;
            }
          }

          $this->db->trans_start(); //* REMOVE PURCHASED ITEMS FROM CART
          $this ->db-> where('client_id', $this->session->userdata('login_client_id'));
          $this ->db-> delete('cart');
          $this->db->trans_complete();

          if ($this->db->trans_status() === TRUE) //* IF REMOVE SUCCESS
          { 
              //* RETURN PAYMENT RECORD
              return $payment_id;

  
          } else {
            return false;
          }
        } else {
          return false;
        }

        if($this->db->trans_status() === true) {
          $this->dv->select('*');
          $this->db->from('payment');
          $this->db->where(array(
            'payment_id' => $payment_id,
            'client_id' => $this->session->userdata('login_client_id')
          ));

          return $payment_id;
        } else {
          return false;
        }


      } else {
        false;
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
}
?>