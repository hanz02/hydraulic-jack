<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artist_control extends CI_Controller {

 public function __construct()
 {
    parent::__construct();
	$this->load->helper('url');
   	$this->load->library('session');
   	$this->load->helper(array('url', 'form'));
 }

 public function index()
 {
    $this->load->view('artist/artist_page');
 }
}
?>