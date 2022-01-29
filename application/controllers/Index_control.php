<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_control extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

 public function __construct()
 {
	parent::__construct();
	$this->load->helper('url');
   	$this->load->library('session');
   	$this->load->helper(array('url', 'form'));

 }

	public function index()
	{
		$this->load->view('home/home_page');
	}

	public function admin() {
		if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
		{
			$this->load->view('admin/home/home_page');
		} else {
			$this->load->view('admin/user/login_page');
		}
	}
}
