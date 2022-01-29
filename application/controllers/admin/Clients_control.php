<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_control extends CI_Controller {

  public function __construct()
  {
 	 parent::__construct();
     $this->load->helper(array('url', 'form'));
     $this->load->library(array('form_validation', 'session'));
     $this->load->database();
     $this->load->model('admin/clients_model', 'admin_clients_model');
  }

  /* View Login */
  public function index()
  {
    if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
	{   
		$result = $this->admin_clients_model->get_users();

        if($result != false)
        {
            $data['clients_data'] = $result; 
            $this->load->view('admin/clients/clients_page', $data);
        }
        else
        {
            echo 'no users fetched';
        }

    } else {
		redirect('hj-admin/login');
    }
  }

  public function view_client_spec()
  {
    if($this->session->has_userdata('login_admin') == true || $this->session->userdata('login_admin') == "1")
    {   

      $data['client_spec'] = $this->session->client_spec; 
      $this->load->view('admin/clients/clients_spec_page', $data);
      
    } else {
      unset($_SESSION['client_spec']);
      redirect('hj-admin/login');
    }
  }
  public function view_client_spec_post()
  {
    $data = $this->input->post();
    $result = $this->admin_clients_model->get_client_spec($data);

        if($result != false)
        {
          $_SESSION['client_spec'] = $result;
          redirect('admin/clients_control/view_client_spec', 'location', 303);
        }
        else
        {
            echo 'no users fetched';
            unset($_SESSION['client_spec']);
        }
  }
}
?>
