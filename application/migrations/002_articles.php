<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Articles extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'article_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'article_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'article_content' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'article_author' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'article_image' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'article_date' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
            )
        ));
        $this->dbforge->add_key('article_id', TRUE);
        $this->dbforge->create_table('articles');
    }

    public function down() {
        $this->dbforge->drop_table('articles');
    }

}
