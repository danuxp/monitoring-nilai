<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'slogan' => [
                'type' => 'VARCHAR',
                'constraint' => 150
            ],
            'logo' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('setting');
    }

    public function down()
    {
        $this->forge->dropTable(tableName: 'setting');
    }
}
