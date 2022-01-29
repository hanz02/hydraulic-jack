<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Products_model extends CI_Model {

    public function __construct() {
      parent::__construct();
      $this->load->database();
      $this->load->library('form_validation');
    }

    public function display_products() {
      $this->db->select('product_img,product_name,art_product.product_id,art_product.price,art_product.stock_amount,art_product.product_id, art_product.ID_prefix,art_product.product_status, art_product.date_added');
      $this->db->from('art_product');
      $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
      $this->db->join('artist', 'art_product.artist_id = artist.artist_id');
      $this->db->where(array(
        'artist.artist_id' => $this->session->userdata('login_id_admin'),
        'art_product.product_status != ' => "deleted"
      ));
      $this->db->order_by('date_added','DESC');
      $query = $this->db->get();

      if($query -> num_rows() > 0) {
        return $result = $query->result();

      } else if($query -> num_rows() == 0)  {
        return "empty";
        
      } else {
        return false;
      }
    }

    public function update_status($status_data) 
    {
      $query_array = array(
        "product_status"=>$status_data['status']
      );


      $this->db->trans_start();
      $this->db->where(array(
        'product_id' => $status_data['product_id']
      ));
      $this->db->update('art_product', $query_array); //~ SPECIFY TABLE NAME and $data
      $this->db->trans_complete();
      
      return $this->db->trans_status();
    }

  public function view_product_details($product_data) {

    $this->db->select('*');
    $this->db->from('art_product');
    $this->db->join('art_product_img', 'art_product_img.product_id = art_product.product_id');
    $this->db->where(array(
      'art_product.product_id' => $product_data['product_id']

    ));

    $query = $this->db->get();

    if($query -> num_rows() == 1) {
      return $result = $query->result();

    } else {
      return false;
    }

  }

  public function get_product_rating($product_data) {

    $ratings = array(
      'one' => $this->db
      ->where('product_id', $product_data['product_id'])
      ->where('rating', 1)
      ->count_all_results('art_product_rating'),

      'two' => $this->db
      ->where('product_id', $product_data['product_id'])
      ->where('rating', 2)
      ->count_all_results('art_product_rating'),

      'three' => $this->db
      ->where('product_id', $product_data['product_id'])
      ->where('rating', 3)
      ->count_all_results('art_product_rating'),

      
      'four' => $this->db
      ->where('product_id', $product_data['product_id'])
      ->where('rating', 4)
      ->count_all_results('art_product_rating'),

      'five' => $this->db
      ->where('product_id', $product_data['product_id'])
      ->where('rating', 5)
      ->count_all_results('art_product_rating'),

    );

    return $ratings;

  }

  public function update_spec($data) 
  {
    $this->db->trans_start();
    $this->db->where(array(
      'product_id' => $data['product_id'],
    ));
    $this->db->update('art_product', array(
      'product_name' => $data['product_name'],
      'product_descript' => $data['product_descript'],
      'stock_amount' => $data['stock_amount'],
      'price' => $data['price'],

    )); //SPECIFY TABLE NAME and $data
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      return false;
    } else {
      return true;
    }
  }

  public function delete_product($data) {

    $this->db->trans_start();
    $this->db->where(array(
      'product_id' => $data,
    ));
    $this->db->update('art_product', array(
      'product_status' => "deleted",

    )); //SPECIFY TABLE NAME and $data
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      return false;
    } else {
      return true;
    }
  }

  public function insertNewProduct($data) {
    $upload_data = array(
      "product_name" => $data['input_data']['product_name'],
      "product_descript" => $data['input_data']['product_descript'],
      "stock_amount" => $data['input_data']['stock_amount'],
      "product_status" => $data['input_data']['status_selected'],
      "price" => $data['input_data']['product_price'],
      "ID_prefix" => 'ILLUS',
      "amount_sold" => 0,
      "artist_id" => $this->session->userdata('login_id_admin'),
      "date_added" => date('y-m-d'),
      "total_revenue" => 0
    );

    $this->db->trans_start();
    $this->db->insert("art_product", $upload_data);

    $insert_product_id = $this->db->insert_id();
    $this->db->insert("art_product_img", array(
                "product_img" => 'assets/img/ready_artworks/' . $data['upload_data']['file_name'],
                "product_id" => $insert_product_id,
              ));
    $this->db->trans_complete(); 

    return $this->db->trans_status();

  }
 
}
?>
