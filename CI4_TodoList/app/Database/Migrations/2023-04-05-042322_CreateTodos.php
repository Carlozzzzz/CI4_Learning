<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTodos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'priority' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'due_date' => [
                'type' => 'DATE',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('recid');
        $this->forge->createTable('tbl_todolist1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_todolist1');
    }
}
