<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeacherFile1Update extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('tbl_teacherfile1', 'employeeno');
        $this->forge->addColumn('tbl_teacherfile1', [
            'employeeno' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_teacherfile1', 'employeeno');
    }
    
}
