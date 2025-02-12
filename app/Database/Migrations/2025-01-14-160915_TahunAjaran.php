<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TahunAjaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tahun' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'tahun_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'start_date' => [
                'type' => 'DATE'
            ],
            'end_date' => [
                'type' => 'DATE'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tahun_ajaran');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'tahun_ajaran');
    }
}
