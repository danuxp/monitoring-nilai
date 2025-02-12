<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mapel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_mapel' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1
            ],
            // 'id_kelas' => [
            //     'type' => 'INT',
            // ],
            'created_at' => [
                'type' => 'TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('mapel');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'mapel');
    }
}
