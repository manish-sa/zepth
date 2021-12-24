<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApproverUpload extends Migration
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
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'file_name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('request_id', 'request_creator', 'id', 'NO ACTION', 'CASCADE');
        $this->forge->createTable('approver_upload');
    }

    public function down()
    {
        $this->forge->dropTable('approver_upload');
    }
}
