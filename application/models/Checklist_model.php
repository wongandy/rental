<?php
class Checklist_model extends CI_Model {
	public function get_details_for_collection() {
		$this->db->select(array('name', 'id'));
		$this->db->from('tenant');
		$this->db->where("location_id = 1");
		$query = $this->db->get();
		// return $query->result();
		$data = array();
		
		foreach ($query->result() as $key => $tenant) {
			$tenant_id = $tenant->id;
			
			/* query for rental receipt */
			$query = $this->db->query("SELECT misc.id, contract_details.net_rental, misc.rental_receipt_type, misc.month, misc.year from tenant
									   JOIN contract on contract.tenant_id = tenant.id
									   JOIN contract_details on contract_details.contract_id = contract.id
									   JOIN misc on contract_details.id = misc.contract_details_id
									   WHERE tenant.id = '" . $tenant_id . "'
									   AND misc.rental_receipt_given = 0
									   AND contract.rental_receipt = 1
									   AND misc.id <= (SELECT misc.id from misc
													   JOIN contract_details on misc.contract_details_id = contract_details.id 
													   JOIN contract on contract_details.contract_id = contract.id 
													   JOIN tenant on contract.tenant_id = tenant.id 
													   WHERE tenant.id = '" . $tenant_id . "'
													   AND misc.month = '" . date('F' ). "'
													   AND misc.year = '" . date('Y') . "')");
			/* query for rental receipt */
			
			$data[$key][$tenant->name]['rental_receipt'] = $query->result_array();
			
			/* query for cusa receipt */
			$query = $this->db->query("SELECT misc.id, contract_details.net_cusa, misc.cusa_receipt_type, misc.month, misc.year from tenant
									   JOIN contract on contract.tenant_id = tenant.id
									   JOIN contract_details on contract_details.contract_id = contract.id
									   JOIN misc on contract_details.id = misc.contract_details_id
									   WHERE tenant.id = '" . $tenant_id . "'
									   AND misc.cusa_receipt_given = 0
									   AND contract.cusa_receipt = 1
									   AND misc.id <= (SELECT misc.id from misc
													   JOIN contract_details on misc.contract_details_id = contract_details.id 
													   JOIN contract on contract_details.contract_id = contract.id 
													   JOIN tenant on contract.tenant_id = tenant.id 
													   WHERE tenant.id = '" . $tenant_id . "'
													   AND misc.month = '" . date('F' ). "'
													   AND misc.year = '" . date('Y') . "')");
			/* query for cusa receipt */
			
			$data[$key][$tenant->name]['cusa_receipt'] = $query->result_array();
			
			
			/* query for water payment */
			$query = $this->db->query("SELECT misc.id, misc.water_payment, misc.month, misc.year from tenant
									   JOIN contract on contract.tenant_id = tenant.id
									   JOIN contract_details on contract_details.contract_id = contract.id
									   JOIN misc on contract_details.id = misc.contract_details_id
									   WHERE tenant.id = '" . $tenant_id . "'
									   AND water_payment_received = 0
									   AND contract.water_bill = 1
									   AND misc.id <= (SELECT misc.id from misc
													   JOIN contract_details on misc.contract_details_id = contract_details.id 
													   JOIN contract on contract_details.contract_id = contract.id 
													   JOIN tenant on contract.tenant_id = tenant.id 
													   WHERE tenant.id = '" . $tenant_id . "'
													   AND misc.month = '" . date('F' ). "'
													   AND misc.year = '" . date('Y') . "')");
			/* query for water payment */
			
			$data[$key][$tenant->name]['water_payment'] = $query->result_array();
			
			/* query for rental form 2307 */
			$query = $this->db->query("SELECT misc.id, contract_details.basic_rental, contract_details.rental_wht, misc.month, misc.year from tenant
									   JOIN contract on contract.tenant_id = tenant.id
									   JOIN contract_details on contract_details.contract_id = contract.id
									   JOIN misc on contract_details.id = misc.contract_details_id
									   WHERE tenant.id = '" . $tenant_id . "'
									   AND rental_form_2307_received = 0
									   AND contract.rental_form_2307 = 1
									   AND misc.id <= (SELECT misc.id from misc
													   JOIN contract_details on misc.contract_details_id = contract_details.id 
													   JOIN contract on contract_details.contract_id = contract.id 
													   JOIN tenant on contract.tenant_id = tenant.id 
													   WHERE tenant.id = '" . $tenant_id . "'
													   AND misc.month = '" . date('F' ). "'
													   AND misc.year = '" . date('Y') . "')");
			/* query for rental form 2307 */
			
			$data[$key][$tenant->name]['rental_form_2307'] = $query->result_array();
			
			/* query for cusa form 2307 */
			$query = $this->db->query("SELECT misc.id, contract_details.basic_cusa, contract_details.cusa_wht, misc.month, misc.year from tenant
									   JOIN contract on contract.tenant_id = tenant.id
									   JOIN contract_details on contract_details.contract_id = contract.id
									   JOIN misc on contract_details.id = misc.contract_details_id
									   WHERE tenant.id = '" . $tenant_id . "'
									   AND cusa_form_2307_received = 0
									   AND contract.cusa_form_2307 = 1
									   AND misc.id <= (SELECT misc.id from misc
													   JOIN contract_details on misc.contract_details_id = contract_details.id 
													   JOIN contract on contract_details.contract_id = contract.id 
													   JOIN tenant on contract.tenant_id = tenant.id 
													   WHERE tenant.id = '" . $tenant_id . "'
													   AND misc.month = '" . date('F' ). "'
													   AND misc.year = '" . date('Y') . "')");
			/* query for cusa form 2307 */
			
			$data[$key][$tenant->name]['cusa_form_2307'] = $query->result_array();
		}

		return $data;
	}
	
	public function test() {
		$query = $this->db->query("select misc.month, misc.year, tenant.name from tenant join contract on contract.tenant_id = tenant.id join contract_details on contract_details.contract_id = contract.id join misc on contract_details.id = misc.contract_details_id where misc.id < (select misc.id from misc join contract_details on misc.contract_details_id = contract_details.id join contract on contract_details.contract_id = contract.id join tenant on contract.tenant_id = tenant.id where tenant.id = 3 and month = 'January' and year = '2019' and rental_receipt = 'or') and tenant.id in (select tenant.id from tenant where tenant.location_id = 1)");
		// $query = $this->db->query("select * from tenant");
		// $query = $this->db->get();
		return $query->result();
	}
	
	public function update_collection_records($data = array()) {
		// pr('halu');
		// use misc.id, 
		// pr($data);
		foreach ($data as $column_name => $value) {
			$id = implode (", ", $value);
			$query = $this->db->query("UPDATE misc SET " . $column_name . " = 1 WHERE id IN (" . $id . ")");
		}
	}
	
	// update misc set rental_form_2307_received = 1 where m1.id in ( select misc.id from tenant as t1 join contract on contract.tenant_id = t1.id join contract_details on contract_details.contract_id = contract.id join misc on contract_details.id = misc.contract_details_id where t1.id = '1' AND rental_form_2307_received = 0 AND misc.id <= (select m2.id from misc as m2 join contract_details on m2.contract_details_id = contract_details.id join contract on contract_details.contract_id = contract.id join tenant on contract.tenant_id = tenant.id where tenant.id = '1' and m2.month = 'January' and m2.year = '2019'))
}