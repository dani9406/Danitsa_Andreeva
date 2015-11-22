<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Email_Send extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'receiver_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'receiver_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
			),
			'receiver_email' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',
			),
                        'receiver_phone' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => '10',
                            ),
                        'receiver_content' => array(
                                        'type' => 'VARCHAR',
                                        'constraint' => '200',
                                )                                    
                   
		));
                 $this->dbforge->add_key('receiver_id', TRUE);
		$this->dbforge->create_table('email_send');                
                
                
	}

	public function down()
	{
		$this->dbforge->drop_table('email_send');                
	}
}