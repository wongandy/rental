<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('login_model');
		// $this->load->model('tenant_model');
		// $this->load->model('bir_model');
		// $this->load->helper(array('form'));
		// $this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index() {
	// pr($this->session->all_userdata());
		$this->load->view('login');
	}
	
	public function auth() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		if ($this->login_model->auth($username, $password)) {
			redirect(base_url() . 'tenant');
		}
		else {
			$this->session->set_flashdata('response',"Invalid username/password combination!");
			redirect(base_url() . 'login');
		}
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url() . 'login');
	}
}
