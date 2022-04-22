<?php
defined('BASEPSATH') OR exit('No direct script access allowed');
class Migration_Seed_Payments_Table extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
		$this->faker = Faker\Factory::create(); //random generálásra használható
	}

	public function up()
	{

		for ($i=0; $i < 15; $i++) { 	
			$rent = [
                "members_id" => $this->faker->numberBetween(1, 50),
				//"name" => implode(", ", $this->faker->randomElements($vnevek)+ $this->faker->randomElements($knevek)),
				"amount" => $this->faker->numberBetween(10,10000),
                //"email" => implode(", ", $this->faker->unique()->randomElements($vnevek) + $this->faker->randomElements($knevek)+"@"+$this->faker->randomElements($mailek)),
				"payed_at" => $this->faker->date(),
			];
			$this->db->insert('rental', $rent);
		}
	}

	public function down()
	{
		$this->db->truncate('rental');
	}
}

/* End of file Seed_Rental_Table.php */


?>