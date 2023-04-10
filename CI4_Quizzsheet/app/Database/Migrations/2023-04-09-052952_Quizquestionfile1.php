<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizquestionfile1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'quizquestionid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quizid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'question' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'questionrow' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'points' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'created_at' => [
                'type' => 'datetime',
            ],
            'updated_at' => [
                'type' => 'datetime',
            ],
        ]);
        $this->forge->addKey('recid', true);
        $this->forge->createTable('tbl_quizquestionfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_quizquestionfile1');
    }
}
