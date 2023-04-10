<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizanswerfile1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'quizanswerid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'questionid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'answer' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'iscorrect' => [
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
        $this->forge->createTable('tbl_quizanswerfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_quizanswerfile1');
    }
}
