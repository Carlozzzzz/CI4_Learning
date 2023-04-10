<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizresultdetailfile1 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'quizresultdetailid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quizresultid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quizquestionid' => [
                'type' => 'int',
                'constraint' => 50
            ],
            'quizanswerid' => [
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
        $this->forge->createTable('tbl_quizresultdetailfile1');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_quizresultdetailfile1');
    }
}
