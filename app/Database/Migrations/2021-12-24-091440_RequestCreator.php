<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RequestCreator extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'request_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'company_id'       => [
                'type'       => 'INT',
                'unsigned' => TRUE
            ],
            'user_id'       => [
                'type'       => 'INT',
                'unsigned' => TRUE,
                'null'     => true,
            ],
            'status'       => [
                'type'       => 'ENUM',
                'constraint' => array('Pending','Approved', 'Reject'),
                'default'    => "Pending"
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('company_id', 'company', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'user', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('request_creator');
    }

    public function down()
    {
        $this->forge->dropTable('request_creator');
    }
}
