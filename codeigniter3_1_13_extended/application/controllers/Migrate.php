<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->input->is_cli_request() or exit('Migrations can only be run from CLI');
		$this->load->library('migration');
	}
	
	public function index()
	{
		if ($this->migration->version(1) === FALSE) {
			show_error($this->migration->error_string());
		}
	}

	public function seed()
	{
		if ($this->migration->latest() === FALSE) {
			show_error($this->migration->error_string());
		}
	}

}

/* End of file Migrate.php */
