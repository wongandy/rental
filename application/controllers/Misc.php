<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misc extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('misc_model');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index() {
		if ($this->session->userdata('logged_in')) {	
			$data['page'] = 'misc/index';
			$data['script'] = 'misc/index.js';
			$data['official_receipts'] = $this->misc_model->get_official_receipts();
			$data['acknowledgement_receipts'] = $this->misc_model->get_acknowledgement_receipts();
			$data['tenants_with_water_bill'] = $this->misc_model->get_tenants_with_water_bill();
			$data['tenants'] = $this->misc_model->get_monthly_rental_report();
			$this->load->view('main_content', $data);
		}
		else {
			redirect(base_url() . 'login');
		}
	}
	
	public function print_water_bill() {
		$data['page'] = 'misc/print_water_bill';
		$data['script'] = 'misc/print.js';
		$data['tenants_with_water_bill'] = $this->misc_model->get_tenants_with_water_bill();
		$this->load->view('main_content', $data);
	}
	
	public function print_water_bill_soa($tenant_id) {
		$data['page'] = 'misc/print_water_bill_soa';
		$data['script'] = 'misc/print.js';
		$data['tenant'] = $this->misc_model->get_tenant_with_water_bill($tenant_id);
		$this->load->view('main_content', $data);
	}
	
	public function print_monthly_rental_report() {
		$data['page'] = 'misc/print_monthly_rental_report';
		$data['script'] = 'misc/print.js';
		$data['tenants'] = $this->misc_model->get_monthly_rental_report();
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set rental_receipt_given = 1 where contract.id = 1 and month = 'May' and year = '2017'
		$this->load->view('main_content', $data);
	}
	
	public function create_water_calculation() {
		$data = $this->input->post();
		$this->misc_model->update_water_calculation($data);
		$this->session->set_flashdata('response',"<div class='alert alert-success'>
				Water calculation for " . date('F Y') . " has been created!
				</div>");
			
		redirect('misc/');
	}
	
	public function delete_water_calculation() {
		$this->misc_model->delete_water_calculation();
		$this->session->set_flashdata('response',"<div class='alert alert-danger'>
				Water calculation for " . date('F Y') . " has been deleted!
				</div>");
			
		redirect('misc/');
	}
	
	public function expenses() {
		$data['page'] = 'misc/expenses';
		$data['script'] = 'misc/print.js';
		$this->load->view('main_content', $data);
	}
	
	public function calculate_expenses_amount($amount = '') {
		echo $this->misc_model->calculate_expenses_amount($amount);
		echo "<div class='col-xs-12'><a href='" . base_url() ."misc/print_monthly_maintenance_expenses/" . $amount ."' target='_blank' class='btn btn-default'><i class='fa fa-print'></i> Print Maintenance Expenses</a></div>";
	}
	
	public function print_monthly_maintenance_expenses($amount = '') {
		$data['page'] = 'misc/print_monthly_maintenance_expenses';
		$data['script'] = 'misc/print.js';
		$data['expenses_table'] = $this->misc_model->calculate_expenses_amount($amount);
		$this->load->view('main_content', $data);
	}
}