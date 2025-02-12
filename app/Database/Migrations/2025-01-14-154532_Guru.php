<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
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
            'nuptk' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 1,
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
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true
            ],
            'agama' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
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
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'guru');
    }
}
