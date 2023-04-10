<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Studentfile1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'studentid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'studentno' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'middlename' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'suffix' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'isactive' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
            ],
            
        ]);
        $this->forge->addKey('recid', true);
        $this->forge->createTable('tbl_studentfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_studentfile1');
    }
}
