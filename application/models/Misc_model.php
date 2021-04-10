<?php
class Misc_model extends CI_Model {
	public function get_official_receipts() {
		$this->db->select(array('misc.id', 'year', 'month', 'rental_receipt_type', 
								'name', 'tin', 'basic_rental', 'rental_vat', 
								'rental_wht', 'net_rental', 'cusa_receipt_type', 
								'basic_cusa', 'cusa_vat', 'cusa_wht', 'net_cusa'));
								
		$this->db->from('misc');
		$this->db->where("year = '" . date('Y') . "' AND month = '" . date('F') . "' AND (rental_receipt_type = 'or' OR cusa_receipt_type = 'or') AND monthly_report = '1'");
		$this->db->join('contract_details', 'misc.contract_details_id = contract_details.id');
		$this->db->join('contract', 'contract_details.contract_id = contract.id');
		$this->db->join('tenant', 'contract.tenant_id = tenant.id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_monthly_rental_report() {
		$year = date('Y', strtotime(date('Y-m')." -1 month"));
		$month = date('F', strtotime(date('Y-m')." -1 month"));
		
		$this->db->select(array('misc.id', 'year', 'month', 'rental_receipt_type', 
								'name', 'tin', 'basic_rental', 'rental_vat', 
								'rental_wht', 'net_rental', 'cusa_receipt_type', 
								'basic_cusa', 'cusa_vat', 'cusa_wht', 'net_cusa'));
								
		$this->db->from('misc');
		$this->db->where("year = '" . $year . "' AND month = '" . $month . "' AND (rental_receipt_type = 'or' OR cusa_receipt_type = 'or') AND monthly_report = '1'");
		$this->db->join('contract_details', 'misc.contract_details_id = contract_details.id');
		$this->db->join('contract', 'contract_details.contract_id = contract.id');
		$this->db->join('tenant', 'contract.tenant_id = tenant.id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function get_acknowledgement_receipts() {
		$this->db->select(array('misc.id', 'year', 'month', 
								'name', 'cusa_receipt_type', 'net_cusa'));
								
		$this->db->from('misc');
		$this->db->where("year = '" . date('Y') . "' AND month = '" . date('F') . "' AND (rental_receipt_type = 'ar' OR cusa_receipt_type = 'ar')");
		$this->db->join('contract_details', 'misc.contract_details_id = contract_details.id');
		$this->db->join('contract', 'contract_details.contract_id = contract.id');
		$this->db->join('tenant', 'contract.tenant_id = tenant.id');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function update_receipt($data = array()) {
		$this->db->where('id', $data['id']);
		$this->db->update('misc', $data);
	}
	
	public function get_tenants_with_water_bill() {
		$this->db->select(array('tenant.id as tenant_id', 'name', 'contract_details_id', 'misc.id', 'month', 'year', 'water_reading', 'difference_water_reading', 'water_payment'));
		$this->db->from('contract');
		$this->db->where("water_bill = '1' AND year = '" . date('Y') . "'AND month = '" . date('F') . "'");
		$this->db->join('tenant', 'contract.tenant_id = tenant.id');
		$this->db->join('contract_details', 'contract_details.contract_id = contract.id');
		$this->db->join('misc', 'misc.contract_details_id = contract_details.id');
		$query = $this->db->get();
		$misc_data = $query->result();
		
		foreach ($misc_data as $key => $data) {
			$this->db->select('water_reading');
			$this->db->from('misc');
			$previous_month = date('F', strtotime('-1 month', strtotime($data->year . '-' . $data->month)));
			$previous_year = date('Y', strtotime('-1 month', strtotime($data->year . '-' . $data->month)));
			$this->db->join('contract_details', 'misc.contract_details_id = contract_details.id');
			$this->db->join('contract', 'contract_details.contract_id = contract.id');
			$this->db->join('tenant', 'contract.tenant_id = tenant.id');
			$this->db->where("tenant.id = '" . $data->tenant_id . "' AND year = '" . $previous_year. "' AND month = '" . $previous_month . "'");
			$query = $this->db->get();
			$misc_data[$key]->previous_month = $previous_month;
			$misc_data[$key]->previous_year = $previous_year;
			$misc_data[$key]->previous_water_reading = $query->row()->water_reading;
		}
		
		return $misc_data;
	}
	
	public function get_tenant_with_water_bill($tenant_id) {
		$this->db->select(array('location.name AS owner_name', 'tenant.name', 'address', 'location', 'contract_details_id', 'misc.id', 'month', 'year', 'water_reading', 'difference_water_reading', 'water_payment'));
		$this->db->from('contract');
		$this->db->where("water_bill = '1' AND year = '" . date('Y') . "'AND month = '" . date('F') . "' AND tenant.id = '" . $tenant_id . "'");
		$this->db->join('tenant', 'contract.tenant_id = tenant.id');
		$this->db->join('contract_details', 'contract_details.contract_id = contract.id');
		$this->db->join('misc', 'misc.contract_details_id = contract_details.id');
		$this->db->join('location', 'location.id = tenant.location_id');
		$query = $this->db->get();
		$data = $query->row();
		$this->db->select('water_reading');
		$this->db->from('misc');
		$previous_month = date('F', strtotime('-1 month', strtotime($data->year . '-' . $data->month)));
		$previous_year = date('Y', strtotime('-1 month', strtotime($data->year . '-' . $data->month)));
		$this->db->where("contract_details_id = '" . $data->contract_details_id . "' AND year = '" . $previous_year. "' AND month = '" . $previous_month . "'");
		$query = $this->db->get();
		$data->previous_month = $previous_month;
		$data->previous_year = $previous_year;
		// $data->previous_water_reading = $query->row()->water_reading;
		// echo '<pre>';
		// print_r($data);
		// die;
		return $data;
	}
	
	public function update_water_calculation($data = array()) {
		$this->db->update_batch('misc', $data, 'id');
	}
	
	public function delete_water_calculation() {
		$data = array(
			'water_reading' => 0,
			'difference_water_reading' => 0,
			'water_payment' => 0
		);
		
		$this->db->set($data);
		$this->db->where("year = '" . date('Y') . "' AND month = '" . date('F') . "'");
		$this->db->update('misc');
	}
	
	public function calculate_expenses_amount($amount = '') {
		$this->db->select(array('unit', 'item', 'price', 'qty_limit'));
		$this->db->from('expenses');
		$query = $this->db->get();
		$expenses_list = $query->result();
		$expenses_amount = 0;
		$return_expenses_list = array();
		shuffle($expenses_list);
		
		for ($i = 0; $i < count($expenses_list); $i++) {
			$randomize_qty = rand(1, $expenses_list[$i]->qty_limit);
			$expenses_amount += $randomize_qty * $expenses_list[$i]->price;
			$return_expenses_list[$i] = $randomize_qty . ' ' . $expenses_list[$i]->unit . ' ' . $expenses_list[$i]->item;
			
			if ($expenses_amount >= $amount) {
				break;
			}
		}
		
		$html = "<div class='table-responsive'>
					<h3 class='text-center'>Aztique Grand Maintenance Expenses for " . date('F Y', strtotime(date('Y-m').' -1 month')) . "</h3><br><br><br>
						<table class='table table-borderless'>
							
							
							<tbody>";
							
		foreach ($return_expenses_list as $key => $value) {
			if ($key % 2 == 0) {
				$html .= "<tr><td colspan='6'>" . $value . "</td>";
			}
			else {
				$html .= "<td colspan='6'>" . $value . "</td></tr>";
			}
		}
		$html .="</tbody>
					</table>";
		$html .= "<div class='text-center'>Total expenses: <b>" . number_format($amount, 2) . "</div></div></div>";
				
		
					// $html .="</div><div class='col-xs-12'>
						// <a href='" . base_url() ."misc/print_monthly_maintenance_expenses/" . $amount ."' target='_blank' class='btn btn-default'><i class='fa fa-print'></i> Print Maintenance Expenses</a>
					// </div>";
					
		return $html;
	}
}