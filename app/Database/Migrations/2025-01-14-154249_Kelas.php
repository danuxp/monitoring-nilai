<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'kelas');
    }
}
