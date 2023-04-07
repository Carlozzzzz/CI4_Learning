<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScoreboard extends Migration
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
            'playername' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'move' => [
                'type' => 'int',
                'constraint' => 100,
            ],
            'iswinner' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
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
        $this->forge->createTable('tbl_scoreboardfile1');
    }

    public function down()
    {
        $this->forger->dropTable('tbl_scoreboardfile1');
    }
}
