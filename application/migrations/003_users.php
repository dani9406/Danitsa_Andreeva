<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '35',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'email_verification_code' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'is_active' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }

}
