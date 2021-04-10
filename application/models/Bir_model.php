<?php
class Bir_model extends CI_Model {
	public function get_details() {
		$query = $this->db->get('bir');
		return $query->row();
	}
}