<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'quizid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'subjectid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'teacherid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quiz' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'timelimit' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'questioncount' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'passingscore' => [
                'type' => 'int',
                'constraint' => 50
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
        $this->forge->createTable('tbl_quizfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_quizfile1');
    }
}
