<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Add_Payments_Table extends CI_Migration { //file nevet írjuk általában a Class névként

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up() //fgv. azt írja le mi történjen ha lefut a migration
	{
		$this->dbforge->add_field(array( //dbforge-ba arrayt kell felvenni
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'members_id' => array(
				'type' => 'INT',
				//'constraint' => ,
			),
			'amount' => array(
				'type' => 'INT',
			),
			'payed_at' => array(
				'type' => 'DATE',
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (members_id) REFERENCES members(id)');
		$this->dbforge->create_table('payments');
	}

	public function down() //fgv. azt írja le mi történjen migrationt vissza akarjuk vonni
	{
		$this->dbforge->drop_table('payments');
	}
}

/* End of file Add_Rental_Table.php */


?>