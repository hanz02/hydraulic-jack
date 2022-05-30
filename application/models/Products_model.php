<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_model extends CI_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
      $this->load->library('form_validation');
    }

    public function display_products() {
      $this->db->select('product_img,product_name,user_name,art_product.product_id,art_product.price,art_product.stock_amount');
      $this->db->from('art_product');
      $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
      $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
      $this->db->where(array(
        'art_product.product_status' => "show",
        'art_product.product_status != ' => "deleted" 
      ));
      $query = $this->db->get();

      if($query -> num_rows() > 0) {
        return $result = $query->result();

      } else {
        return false;

      }
    }

  public function view_product_details($product_data) {
    $this->db->select('art.*, art_img.product_img, artist.user_name');
    $this->db->from('art_product art');
    $this->db->join('art_product_img art_img', 'art_img.product_id = art.product_id');
    $this->db->join('artist', 'art.artist_id = artist.artist_id');
    $this->db->where(array(
      'art.product_id' => $product_data['product_id'],
    ));

    $query = $this->db->get();

    if($query -> num_rows() == 1) {
      return $result = $query->result();

    } else {
      return false;
    }

  }

  public function get_product_rating($product_data) {
    if($this->session->has_userdata('login') == true || $this->session->userdata('login') == "1") {

      $this->db->select('rating');
      $this->db->from('art_product_rating');
      $this->db->where(array(
        'client_id' => $this->session->userdata('login_client_id'),
        'product_id' => $product_data['product_id']
      ));
      $query = $this->db->get();

      if($query -> num_rows() == 1) { //IF USER HAS RATED
        $db_rating = $query->row()->rating;
        return $db_rating;
      }
    }
  }

  public function insert_rating($rating_data) {

    $query_array = array(
      "client_id" => $rating_data['user_id'],
      "product_id" => $rating_data['product_id'],
      "rating" => $rating_data['currentRate']
    );

    $this->db->select('client_id, product_id');
    $this->db->from('art_product_rating');
    $this->db->where(array(
      'client_id' => $this->session->userdata('login_client_id'),
      'product_id' => $rating_data['product_id']
    ));
    $query = $this->db->get();

    if($query -> num_rows() == 1) { //USERS HAS ALREADY RATED THE PRODUCT

      $this->db->trans_start();
      $this->db->where(array(
        'client_id' => $this->session->userdata('login_client_id'),
        'product_id' => $rating_data['product_id']
      ));
      $this->db->update('art_product_rating', $query_array); //SPECIFY TABLE NAME and $data
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
        return false;
      } else {

        return "Rating has been updated, Thank You OwO";
      }

    } else if($query -> num_rows() == 0) { //USERS HAS NOT RATED THE PRODUCT

      $this->db->insert("art_product_rating", $query_array);
      return "Thank You for rating OwO";

    } else {

      return false;
    }
  }

  public function remove_rating($rating_data) {

    return $this->db->delete('art_product_rating', array(
      'product_id' => $rating_data['product_id'],
      'client_id' => $rating_data['user_id']
    ));

  }

  public function filterHighestPrice()
  {
    $this->db->select('product_img,product_name,user_name,art_product.product_id,art_product.price,art_product.stock_amount');
    $this->db->from('art_product');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
    $this->db->where(array(
      'art_product.product_status' => "show",
      'art_product.product_status != ' => "deleted" 
    ));
    $this->db->order_by('art_product.price','DESC');
    $query = $this->db->get();

    if($query -> num_rows() > 0) {
      return $result = $query->result();

    } else {
      return false;

    }
  }

  public function filterLowestPrice()
  {
    $this->db->select('product_img,product_name,user_name,art_product.product_id,art_product.price,art_product.stock_amount');
    $this->db->from('art_product');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
    $this->db->where(array(
      'art_product.product_status' => "show",
      'art_product.product_status != ' => "deleted" 
    ));
    $this->db->order_by('art_product.price','ASC');

    $query = $this->db->get();

    if($query -> num_rows() > 0) {
      return $result = $query->result();

    } else {
      return false;

    }
  }

  public function filterLatest()
  {
    $this->db->select('product_img,product_name,user_name,art_product.product_id,art_product.price,art_product.stock_amount');
    $this->db->from('art_product');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
    $this->db->where(array(
      'art_product.product_status' => "show",
      'art_product.product_status != ' => "deleted" 
    ));
    $this->db->order_by('art_product.date_added','DESC');

    $query = $this->db->get();

    if($query -> num_rows() > 0) {
      return $result = $query->result();

    } else {
      return false;

    }
  }

  public function filterOldest()
  {
    $this->db->select('product_img,product_name,user_name,art_product.product_id,art_product.price,art_product.stock_amount');
    $this->db->from('art_product');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
    $this->db->where(array(
      'art_product.product_status' => "show",
      'art_product.product_status != ' => "deleted" 
    ));
    $this->db->order_by('art_product.date_added','ASC');

    $query = $this->db->get();

    if($query -> num_rows() > 0) {
      return $result = $query->result();

    } else {
      return false;
    }
  }

  public function checkProductVisbible($data) {
    $this->db->select('product_status')
            ->from('art_product')
            ->where(array(
            'product_id' => $data['product_id'],
            ));
    
    $result = $this->db->get()->result();
    
    if($result[0]->product_status == "deleted" || $result[0]->product_status == "hidden") {
      return false;
    } else {
      return true;
    }
  }
}
?>
