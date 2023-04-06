<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUseridToTodos extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_todolist1', [
            'userid' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'after' => 'description' // Add the column after the 'description' column
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_todolist1', 'userid');
    }

}
