<?php
class Unit_model extends CI_Model {
	public function get_units() {
		$query = $this->db->select('id, name')->get('unit');
		return $query->result();
	}
}