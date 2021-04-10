<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tenant extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('tenant_model');
		$this->load->model('unit_model');
		$this->load->model('bir_model');
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}
	
	public function index() {
		if ($this->session->userdata('logged_in')) {		
			$data['page'] = 'tenant/index';
			$data['date_today'] = strtotime(date('Y-m-d', strtotime(date('Y-m-d'))));
			$data['tenants'] = $this->tenant_model->get_tenant_details();
			$this->load->view('main_content', $data);
		}
		else {
			redirect(base_url() . 'login');
		}
	}
	
	public function create($tenant_id = '') {
		if ($this->session->userdata('logged_in') && $this->session->userdata('role_id') == 1) {
			// form validation for a new tenant only
			if ($tenant_id == '') {
				$this->form_validation->set_rules('name', 'Business name', 'required');
			}
			
			$this->form_validation->set_rules('unit[]', 'Unit', 'required');
			$this->form_validation->set_rules('primary_name', 'Primary name', 'required');
			$this->form_validation->set_rules('primary_number', 'Primary contact number', 'required');
			$this->form_validation->set_rules('basic_rental', 'Basic rental', 'required');
			$this->form_validation->set_rules('rent_start', 'Rent period start', 'required');
			$this->form_validation->set_rules('duration', 'Duration', 'required');
			
			// getting the tenant name for making a new contract
			if ($tenant_id != '') {
				$tenant_name = $this->tenant_model->get_tenant_name($tenant_id);
				$create_new_tenant = 0;
				$data['tenant_name'] = $tenant_name;
			}
				
			if ($this->form_validation->run() == FALSE) {
				$data['tenant_id'] = $tenant_id;
				$data['page'] = 'tenant/create';
				$data['script'] = 'tenant/create.js';
				$data['units'] = $this->unit_model->get_units();
				$data['location_id'] = 1; // hardcoded for the meantime
				$data['bir'] = $this->bir_model->get_details();
				$this->load->view('main_content', $data);
			}
			else {
				// this code is only for creating a new tenant
				if ($tenant_id == '') {
					/* data needed for creating a tenant */
					$name = $this->input->post('name');
					$tin = $this->input->post('tin');
					$primary_name = $this->input->post('primary_name');
					$primary_number = $this->input->post('primary_number');
					$primary_email = $this->input->post('primary_email');
					$secondary_name = $this->input->post('secondary_name');
					$secondary_number = $this->input->post('secondary_number');
					$secondary_email = $this->input->post('secondary_email');
					$tertiary_name = $this->input->post('tertiary_name');
					$tertiary_number = $this->input->post('tertiary_number');
					$tertiary_email = $this->input->post('tertiary_email');
					$note = $this->input->post('tenant_notes');
					$location_id = $this->input->post('location_id');
					
					
					$data = array(
						'name' => $name,
						'tin' => $tin,
						'primary_name' => $primary_name,
						'primary_number' => $primary_number,
						'primary_email' => $primary_email,
						'secondary_name' => $secondary_name,
						'secondary_number' => $secondary_number,
						'secondary_email' => $secondary_email,
						'tertiary_name' => $tertiary_name,
						'tertiary_number' => $tertiary_number,
						'tertiary_email' => $tertiary_email,
						'note' => $note,
						'location_id' => $location_id
					);
					/* data needed for creating a tenant */
					
					$tenant_id = $this->tenant_model->create_tenant($data);
					$create_new_tenant = 1;
					$tenant_name = $this->tenant_model->get_tenant_name($tenant_id);
				}
				// this code is only for creating a new tenant
				
				/* data needed for creating a contract */
				$unit = $this->input->post('unit');
				$unit = (count($unit) <= 1 ) ? $unit[0] : implode(',', $unit);
				$duration = $this->input->post('duration');
				$escalation_start_year = $this->input->post('escalation_start_year');
				$basic_rental = $this->input->post('basic_rental');
				$hide_rental = $this->input->post('hide_rental');
				$rental_vat = $this->input->post('rental_vat');
				$rental_vat_amount = round($basic_rental * ($rental_vat / 100), 2);
				$rental_wht = $this->input->post('rental_wht');
				$rental_wht_amount = round($basic_rental * ($rental_wht / 100), 2);
				$net_rental = $this->input->post('net_rental');
				$basic_cusa = $this->input->post('basic_cusa');
				$cusa_vat = $this->input->post('cusa_vat');
				$cusa_vat_amount = round($basic_cusa * ($cusa_vat / 100), 2);
				$cusa_wht = $this->input->post('cusa_wht');
				$cusa_wht_amount = round($basic_cusa * ($cusa_wht / 100), 2);
				$net_cusa = $this->input->post('net_cusa');
				$rent_start = $this->input->post('rent_start');
				$rent_end = $this->input->post('rent_end');
				$escalation = $this->input->post('escalation');
				$rental_receipt_type = $this->input->post('rental_receipt_type');
				$cusa_receipt_type = $this->input->post('cusa_receipt_type');
				$note = $this->input->post('contract_notes');
				$monthly_report = $this->input->post('monthly_report');
				$rental_receipt = ($this->input->post('rental_receipt_type')) ? 1 : 0;
				$cusa_receipt = ($this->input->post('cusa_receipt_type')) ? 1 : 0;
				$water_bill = $this->input->post('water_bill');
				$rental_form_2307 = $this->input->post('rental_form_2307');
				$cusa_form_2307 = $this->input->post('cusa_form_2307');
				/* data needed for creating a contract */
				
				$data = array(
					'tenant_id' => $tenant_id,
					'unit' => $unit,
					'note' => $note,
					'monthly_report' => $monthly_report,
					'rental_receipt' => $rental_receipt,
					'cusa_receipt' => $cusa_receipt,
					'water_bill' => $water_bill,
					'rental_form_2307' => $rental_form_2307,
					'cusa_form_2307' => $cusa_form_2307
				);
				
				$contract_id = $this->tenant_model->create_contract($data);
					
				// if contract is only for a year
				if ($duration <= 1) {
					$data = array(
						'contract_id' => $contract_id,
						'basic_rental' => $basic_rental,
						'hide_rental' => $hide_rental,
						'rental_vat' => $rental_vat,
						'rental_wht' => $rental_wht,
						'basic_cusa' => $basic_cusa,
						'cusa_vat' => $cusa_vat,
						'cusa_wht' => $cusa_wht,
						'net_rental' => $net_rental,
						'net_cusa' => $net_cusa,
						'rent_start' => $rent_start,
						'rent_end' => $rent_end,
						'escalation' => $escalation
					);
					
					$contract_details_id = $this->tenant_model->create_contract_details($data);
					$start_month_year = date('Y-m', strtotime($rent_start));
					$end_month_year = date('Y-m', strtotime($rent_end));
					
					while (strtotime($start_month_year) <= strtotime($end_month_year)) {
						$data = array(
							'contract_details_id' => $contract_details_id,
							'year' => date('Y', strtotime($start_month_year)),
							'month' => date('F', strtotime($start_month_year)),
							'rental_receipt_type' => $rental_receipt_type,
							'cusa_receipt_type' => $cusa_receipt_type
						);
						
						$this->tenant_model->create_receipt($data);
						$start_month_year = date('Y-m', strtotime($start_month_year . "+1 month"));
					}
				}
				else { // if contract is for more than a year
					$data = array();
					
					for ($i = 1; $i <= $duration; $i++) {
						$adjusted_escalation = 0;
						
						if ($i >= $escalation_start_year) {
							$adjusted_escalation = $escalation;
							$basic_rental = round((double) $basic_rental + ($basic_rental * ($adjusted_escalation / 100)), 2);
							$hide_rental = round((double) $hide_rental + ($hide_rental * ($adjusted_escalation / 100)), 2);
							$rental_vat_amount = round($basic_rental * ($rental_vat / 100), 2);
							$rental_wht_amount = round($basic_rental * ($rental_wht / 100), 2);
							$net_rental = ($basic_rental + $rental_vat_amount) - $rental_wht_amount;
						}
						
						if ($i > 1) {
							$rent_start = date('Y-m-d', strtotime('+1 year', strtotime($rent_start)));
						}
						
						$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
						
						$data[] = array(
							'contract_id' => $contract_id,
							'basic_rental' => $basic_rental,
							'hide_rental' => $hide_rental,
							'rental_vat' => $rental_vat,
							'rental_wht' => $rental_wht,
							'basic_cusa' => $basic_cusa,
							'cusa_vat' => $cusa_vat,
							'cusa_wht' => $cusa_wht,
							'net_rental' => $net_rental,
							'net_cusa' => $net_cusa,
							'rent_start' => $rent_start,
							'rent_end' => $rent_end,
							'escalation' => $adjusted_escalation
						);
					}
					
					/* workaround to get first and last id from insert_batch method */
					$first_contract_details_id = $this->tenant_model->create_multiple_contract_details($data);
					$last_contract_details_id = ($first_contract_details_id + $duration) - 1;
					/* workaround to get first and last id from insert_batch method */
					
					$rent_start = $this->input->post('rent_start');
					$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
					$start_month_year = date('Y-m', strtotime($rent_start));
					$end_month_year = date('Y-m', strtotime($rent_end));
					$rental_form_2307 = ($rental_wht > 0) ? 1 : 0;
					$cusa_form_2307 = ($cusa_wht > 0) ? 1 : 0;
					$data = array();
					
					while ($first_contract_details_id <= $last_contract_details_id) {
						$start_month_year = date('Y-m', strtotime($rent_start));
						$end_month_year = date('Y-m', strtotime($rent_end));
					
						while (strtotime($start_month_year) <= strtotime($end_month_year)) {
							$data[] = array(
								'contract_details_id' => $first_contract_details_id,
								'year' => date('Y', strtotime($start_month_year)),
								'month' => date('F', strtotime($start_month_year)),
								'rental_receipt_type' => $rental_receipt_type,
								'cusa_receipt_type' => $cusa_receipt_type
							);
							
							$start_month_year = date('Y-m', strtotime($start_month_year . "+1 month"));
						}
						 
						$rent_start = date('Y-m-d', strtotime('+1 year', strtotime($rent_start)));
						$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
						$first_contract_details_id++;
					}
					$this->tenant_model->create_multiple_receipts($data);
				}
				// this code is only for creating a new tenant
				if ($create_new_tenant) {
					$this->session->set_flashdata('response',"<div class='alert alert-success'>
						Tenant " . $this->input->post('name') . " has been created!
						</div>");
					redirect('tenant/create');
				}
				else { // this code is only for making a new contract
					$this->session->set_flashdata('response',"<div class='alert alert-success'>
						Made a new contract for  " . $tenant_name . "!
						</div>");
					redirect('tenant');
				}
			}
		}
		elseif ($this->session->userdata('logged_in') && $this->session->userdata('role_id') != 1) {
			redirect(base_url() . 'tenant');
		}
		else {
				redirect(base_url() . 'login');
		}
	}
	
	public function extend($tenant_id) {
	// $test = $this->tenant_model->get_tenant_name($tenant_id);
		// echo '<pre>';
		// print_r($test);
		// echo '</pre>';
		// die;
		if ($this->form_validation->run() == FALSE) {
			$data['page'] = 'tenant/extend';
			$data['script'] = 'tenant/create.js';
			$data['units'] = $this->unit_model->get_units();
			$data['location_id'] = 1; // hardcoded for the meantime
			$data['bir'] = $this->bir_model->get_details();
			$data['tenant_name'] = $this->tenant_model->get_tenant_name($tenant_id);
			$this->load->view('main_content', $data);
		}
	}
	
	public function edit() {
		$test = $this->tenant_model->get_tenant_details();
		echo '<pre>';
		print_r($test);
		echo '</pre>';
		die;
		// $this->form_validation->set_rules('name', 'Business name', 'required');
		// $this->form_validation->set_rules('unit[]', 'Unit', 'required');
		// $this->form_validation->set_rules('primary_name', 'Primary name', 'required');
		// $this->form_validation->set_rules('primary_number', 'Primary contact number', 'required');
		// $this->form_validation->set_rules('basic_rental', 'Basic rental', 'required');
		// $this->form_validation->set_rules('rent_start', 'Rent period start', 'required');
		// $this->form_validation->set_rules('duration', 'Duration', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$data['page'] = 'tenant/edit';
			$data['script'] = 'tenant/create.js';
			$data['units'] = $this->unit_model->get_units();
			$data['location_id'] = 1; // hardcoded for the meantime
			$data['bir'] = $this->bir_model->get_details();
		
			$this->load->view('main_content', $data);
		}
		else {
			/* data needed for creating a tenant */
			$name = $this->input->post('name');
			$tin = $this->input->post('tin');
			$primary_name = $this->input->post('primary_name');
			$primary_number = $this->input->post('primary_number');
			$primary_email = $this->input->post('primary_email');
			$secondary_name = $this->input->post('secondary_name');
			$secondary_number = $this->input->post('secondary_number');
			$secondary_email = $this->input->post('secondary_email');
			$tertiary_name = $this->input->post('tertiary_name');
			$tertiary_number = $this->input->post('tertiary_number');
			$tertiary_email = $this->input->post('tertiary_email');
			$note = $this->input->post('tenant_notes');
			$location_id = $this->input->post('location_id');
			$unit = $this->input->post('unit');
			$unit = (count($unit) <= 1 ) ? $unit[0] : implode(',', $unit);
			/* data needed for creating a tenant */
			
			$data = array(
				'name' => $name,
				'tin' => $tin,
				'primary_name' => $primary_name,
				'primary_number' => $primary_number,
				'primary_email' => $primary_email,
				'secondary_name' => $secondary_name,
				'secondary_number' => $secondary_number,
				'secondary_email' => $secondary_email,
				'tertiary_name' => $tertiary_name,
				'tertiary_number' => $tertiary_number,
				'tertiary_email' => $tertiary_email,
				'note' => $note,
				'location_id' => $location_id,
				'unit' => $unit
			);
			
			$tenant_id = $this->tenant_model->create_tenant($data);
			
			/* data needed for creating a contract */
			$duration = $this->input->post('duration');
			$escalation_start_year = $this->input->post('escalation_start_year');
			$basic_rental = $this->input->post('basic_rental');
			$hide_rental = $this->input->post('hide_rental');
			$rental_vat = $this->input->post('rental_vat');
			$rental_vat_amount = round($basic_rental * ($rental_vat / 100), 2);
			$rental_wht = $this->input->post('rental_wht');
			$rental_wht_amount = round($basic_rental * ($rental_wht / 100), 2);
			$net_rental = $this->input->post('net_rental');
			$basic_cusa = $this->input->post('basic_cusa');
			$cusa_vat = $this->input->post('cusa_vat');
			$cusa_vat_amount = round($basic_cusa * ($cusa_vat / 100), 2);
			$cusa_wht = $this->input->post('cusa_wht');
			$cusa_wht_amount = round($basic_cusa * ($cusa_wht / 100), 2);
			$net_cusa = $this->input->post('net_cusa');
			$rent_start = $this->input->post('rent_start');
			$rent_end = $this->input->post('rent_end');
			$escalation = $this->input->post('escalation');
			$rental_receipt_type = $this->input->post('rental_receipt_type');
			$cusa_receipt_type = $this->input->post('cusa_receipt_type');
			$note = $this->input->post('contract_notes');
			$monthly_report = $this->input->post('monthly_report');
			$rental_receipt = ($this->input->post('rental_receipt_type')) ? 1 : 0;
			$cusa_receipt = ($this->input->post('cusa_receipt_type')) ? 1 : 0;
			$water_bill = $this->input->post('water_bill');
			$rental_form_2307 = $this->input->post('rental_form_2307');
			$cusa_form_2307 = $this->input->post('cusa_form_2307');
			/* data needed for creating a contract */
			
			$data = array(
				'tenant_id' => $tenant_id,
				'note' => $note,
				'monthly_report' => $monthly_report,
				'rental_receipt' => $rental_receipt,
				'cusa_receipt' => $cusa_receipt,
				'water_bill' => $water_bill,
				'rental_form_2307' => $rental_form_2307,
				'cusa_form_2307' => $cusa_form_2307
			);
			
			$contract_id = $this->tenant_model->create_contract($data);
				
			// if contract is only for a year
			if ($duration <= 1) {
				$data = array(
					'contract_id' => $contract_id,
					'basic_rental' => $basic_rental,
					'hide_rental' => $hide_rental,
					'rental_vat' => $rental_vat,
					'rental_wht' => $rental_wht,
					'basic_cusa' => $basic_cusa,
					'cusa_vat' => $cusa_vat,
					'cusa_wht' => $cusa_wht,
					'net_rental' => $net_rental,
					'net_cusa' => $net_cusa,
					'rent_start' => $rent_start,
					'rent_end' => $rent_end,
					'escalation' => $escalation
				);
				
				$contract_details_id = $this->tenant_model->create_contract_details($data);
				$start_month_year = date('Y-m', strtotime($rent_start));
				$end_month_year = date('Y-m', strtotime($rent_end));
				// $rental_form_2307 = ($rental_wht > 0) ? 1 : 0;
				// $cusa_form_2307 = ($cusa_wht > 0) ? 1 : 0;
				
				
				while (strtotime($start_month_year) <= strtotime($end_month_year)) {
					$data = array(
						'contract_details_id' => $contract_details_id,
						'year' => date('Y', strtotime($start_month_year)),
						'month' => date('F', strtotime($start_month_year)),
						'rental_receipt_type' => $rental_receipt_type,
						'cusa_receipt_type' => $cusa_receipt_type
						// 'rental_form_2307_received' => $rental_form_2307,
						// 'cusa_form_2307_received' => $cusa_form_2307
					);
					
					$this->tenant_model->create_receipt($data);
					$start_month_year = date('Y-m', strtotime($start_month_year . "+1 month"));
				}
			}
			else { // if contract is for more than a year
				$data = array();
				
				for ($i = 1; $i <= $duration; $i++) {
					$adjusted_escalation = 0;
					
					if ($i >= $escalation_start_year) {
						$adjusted_escalation = $escalation;
						$basic_rental = round((double) $basic_rental + ($basic_rental * ($adjusted_escalation / 100)), 2);
						$hide_rental = round((double) $hide_rental + ($hide_rental * ($adjusted_escalation / 100)), 2);
						$rental_vat_amount = round($basic_rental * ($rental_vat / 100), 2);
						$rental_wht_amount = round($basic_rental * ($rental_wht / 100), 2);
						$net_rental = ($basic_rental + $rental_vat_amount) - $rental_wht_amount;
					}
					
					if ($i > 1) {
						$rent_start = date('Y-m-d', strtotime('+1 year', strtotime($rent_start)));
					}
					
					$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
					
					$data[] = array(
						'contract_id' => $contract_id,
						'basic_rental' => $basic_rental,
						'hide_rental' => $hide_rental,
						'rental_vat' => $rental_vat,
						'rental_wht' => $rental_wht,
						'basic_cusa' => $basic_cusa,
						'cusa_vat' => $cusa_vat,
						'cusa_wht' => $cusa_wht,
						'net_rental' => $net_rental,
						'net_cusa' => $net_cusa,
						'rent_start' => $rent_start,
						'rent_end' => $rent_end,
						'escalation' => $adjusted_escalation
					);
				}
				
				/* workaround to get first and last id from insert_batch method */
				$first_contract_details_id = $this->tenant_model->create_multiple_contract_details($data);
				$last_contract_details_id = ($first_contract_details_id + $duration) - 1;
				/* workaround to get first and last id from insert_batch method */
				
				$rent_start = $this->input->post('rent_start');
				$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
				$start_month_year = date('Y-m', strtotime($rent_start));
				$end_month_year = date('Y-m', strtotime($rent_end));
				$rental_form_2307 = ($rental_wht > 0) ? 1 : 0;
				$cusa_form_2307 = ($cusa_wht > 0) ? 1 : 0;
				$data = array();
				
				while ($first_contract_details_id <= $last_contract_details_id) {
					$start_month_year = date('Y-m', strtotime($rent_start));
					$end_month_year = date('Y-m', strtotime($rent_end));
				
					while (strtotime($start_month_year) <= strtotime($end_month_year)) {
						$data[] = array(
							'contract_details_id' => $first_contract_details_id,
							'year' => date('Y', strtotime($start_month_year)),
							'month' => date('F', strtotime($start_month_year)),
							'rental_receipt_type' => $rental_receipt_type,
							'cusa_receipt_type' => $cusa_receipt_type
							// 'rental_form_2307_received' => $rental_form_2307,
							// 'cusa_form_2307_received' => $cusa_form_2307
						);
						
						$start_month_year = date('Y-m', strtotime($start_month_year . "+1 month"));
					}
					 
					$rent_start = date('Y-m-d', strtotime('+1 year', strtotime($rent_start)));
					$rent_end = date('Y-m-d', strtotime('+1 year - 1 day', strtotime($rent_start)));
					$first_contract_details_id++;
				}
				$this->tenant_model->create_multiple_receipts($data);
			}
			
			$this->session->set_flashdata('response',"<div class='alert alert-success'>
				Tenant " . $this->input->post('name') . " has been created!
				</div>");
				
			redirect('tenant/create');
		}
	}
}
