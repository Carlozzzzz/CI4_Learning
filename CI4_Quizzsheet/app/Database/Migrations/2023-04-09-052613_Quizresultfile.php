<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizresultfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'quizresultid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quizid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'studentid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'score' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'start_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'end_time' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'is_passed' => [
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
        $this->forge->createTable('tbl_quizresultfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_quizresultfile1');
    }
}
