<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subjectfile2 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'recid' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'teachersfid' => [
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
        $this->forge->createTable('tbl_subjectfile2');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_subjectfile2');
    }
}
