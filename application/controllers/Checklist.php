<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('checklist_model');
		// $this->load->model('unit_model');
		// $this->load->model('bir_model');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function collection() {
		if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1) {		
			$data['page'] = 'checklist/collection';
			$data['script'] = 'checklist/collection.js';
			$data['collection'] = $this->checklist_model->get_details_for_collection();
			$this->load->view('main_content', $data);
		}
		elseif ($this->session->userdata('logged_in') && $this->session->userdata('role_id') != 1) {
			redirect(base_url() . 'tenant');
		}
		else {
				redirect(base_url() . 'login');
		}
		// pr($data['collection']);
		// rental receipt
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set rental_receipt_given = 1 where rental_receipt = 1 and year < 2019
		
		// cusa receipt
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set cusa_receipt_given = 1 where cusa_receipt = 1 and year < 2019
		
		// water payment receipt
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set water_payment_received = 1 where water_bill = 1 and year < 2019
		
		// rental form 2307 receipt
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set rental_form_2307_received = 1 where rental_form_2307 = 1 and year < 2019
		
		// cusa form 2307 receipt
		// UPDATE misc join contract_details on contract_details.id = misc.contract_details_id join contract on contract.id = contract_details.contract_id join tenant on tenant.id = contract.tenant_id set cusa_form_2307_received = 1 where cusa_form_2307 = 1 and year < 2019
		
		
		// echo '<pre>';
		// print_r($data['collection']); die;
		// print_r($a); die;
	}
	
	public function test() {
		// SELECT misc.year, misc.month, tenant.name from misc join contract_details on misc.contract_details_id = contract_details.id join contract on contract_details.contract_id = contract.id join tenant on contract.tenant_id = tenant.id where tenant.id = 3 and misc.id < (select misc.id from misc join contract_details on misc.contract_details_id = contract_details.id join contract on contract_details.contract_id = contract.id join tenant on contract.tenant_id = tenant.id where tenant.id = 3 and month = 'January' and year = '2019')
		
		// SELECT * FROM `tenant` join contract on tenant.id = contract.tenant_id join contract_details on contract.id = contract_details.contract_id join misc on contract_details.id = misc.contract_details_id where tenant.id = 3 and misc.month < 'January' and misc.year = '2019'
		
		$data['details'] = $this->checklist_model->get_details_for_collection();
		// $data['details'] = $this->checklist_model->test();
		pr($data['details']);
	}
	
	public function submit() {
		$data = $this->input->post();
		// pr($data);
		$this->checklist_model->update_collection_records($data);
		$this->session->set_flashdata('response',"<div class='alert alert-success'>Checklist updated!</div>");
				
			redirect('checklist/collection');
	}
}