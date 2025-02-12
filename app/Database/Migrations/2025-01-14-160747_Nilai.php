<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Nilai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'siswa_id' => [
                'type' => 'INT',
            ],
            'mapel_id' => [
                'type' => 'INT',
            ],
            'guru_id' => [
                'type' => 'INT'
            ],
            'kelas_id' => [
                'type' => 'INT'
            ],
            'tugas' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'uts' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'uas' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'tahun_ajaran_id' => [
                'type' => 'INT',
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
        $this->forge->createTable('nilai');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'nilai');
    }
}
