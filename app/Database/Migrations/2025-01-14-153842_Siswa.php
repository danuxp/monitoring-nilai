<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT'
            ],
            'nis' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'tempat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tgl_lahir' => [
                'type' => 'DATE',
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'nama_ibu' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'nama_ayah' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'default' => 'A'
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
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'siswa');
    }
}
