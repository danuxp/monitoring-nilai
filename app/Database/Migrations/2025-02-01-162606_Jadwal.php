<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'mapel_id' => [
                'type' => 'INT'
            ],
            'kelas_id' => [
                'type' => 'INT'
            ],
            'guru_id' => [
                'type' => 'INT'
            ],
            'hari' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'tahun_ajaran_id' => [
                'type' => 'INT',
            ],
            'jam_ke' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true
            ],
            'created_at' => [
                'type' => 'TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'jadwal');
    }
}
