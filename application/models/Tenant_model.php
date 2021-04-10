<?php
class Tenant_model extends CI_Model {
	public function create_tenant($data = array()) {
		$this->db->insert('tenant', $data);
		return $this->db->insert_id();
	}
	
	public function create_contract($data = array()) {
		$this->db->insert('contract', $data);
		return $this->db->insert_id();
	}
	
	public function create_contract_details($data = array()) {
		$this->db->insert('contract_details', $data);
		return $this->db->insert_id();
	}
	
	public function create_multiple_contract_details($data = array()) {
		$this->db->insert_batch('contract_details', $data);
		return $this->db->insert_id();
	}
	
	public function create_receipt($data = array()) {
		return $this->db->insert('misc', $data);
	}
	
	public function create_multiple_receipts($data = array()) {
		return $this->db->insert_batch('misc', $data);
	}
	
	public function create_multiple_receipt($data = array()) {
		$this->db->insert_batch('misc', $data);
	}
	
	public function get_tenant_details() {
		$this->db->select(array('id', 'name', 'tin'));
		$query = $this->db->get('tenant');
		$tenant_data = $query->result();
		
		foreach ($query->result() as $num => $tenant) {
			$tenant_id = $tenant->id;
			$this->db->select(array('basic_rental', 'rent_start', 'rent_end', 'rental_vat', 'rental_wht', 'net_rental', 'basic_cusa', 'cusa_vat', 'cusa_wht', 'net_cusa', 'escalation', 'hide_rental'));
			// $this->db->select();
			$this->db->from('contract');
			$this->db->where('tenant_id', $tenant_id);
			$this->db->join('contract_details', 'contract.id = contract_details.contract_id');
			$query = $this->db->get();
			$tenant_contract_details = $query->result();
			$tenant_data[$num]->contract_details = $tenant_contract_details;
		}
		
		return $tenant_data;
	}
	
	public function get_tenant_name($tenant_id = '') {
		$this->db->select('name');
		$query = $this->db->get_where('tenant', array('id' => $tenant_id));
		$tenant_data = $query->row();
		return $tenant_data->name;
	}
}