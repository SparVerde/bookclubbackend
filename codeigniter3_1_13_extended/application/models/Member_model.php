<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Member_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function all()
	{
		$this->db->select('id, name, gender, birth_date, banned');
		return $this->db->get('members')->result_array();
	}

	public function insert($data)
	{
		$this->db->insert('members', $data);
		return $this->db->insert_id();
	}

	public function find($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('members')->row_array();
	}
}

/* End of file Member_model.php */