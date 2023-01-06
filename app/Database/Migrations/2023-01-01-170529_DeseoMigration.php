<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class DeseoMigration extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
		  $this->forge->addField([
			  'id' => [
				  'type'					=> 'INT',
				  'unsigned'			=> true,
				  'auto_increment'	=> true,
				  'null'					=> false
			  ],
			  'descripcion' => [
				  'type'			=> 'VARCHAR',
				  'constraint'	=> 255,
				  'null'			=> false
			  ],
			  'id_jugador' => [
				  'type'			=> 'INT',
				  'unsigned'	=> true,
				  'null'			=> false
			  ],
			  'created_at' => [
				  'type'		=> 'DATETIME',
				  'null'		=> false,
				  'default'	=> new RawSql('CURRENT_TIMESTAMP')
			  ],
			  'updated_at' => [
				  'type'	=> 'DATETIME',
				  'null'	=> true,
			  ],
			  'deleted_at' => [
				  'type'	=> 'DATETIME',
				  'null'	=> true
			  ]
		  ]);
		  $this->forge->addPrimaryKey('id');
		  $this->forge->addForeignKey('id_jugador', 'jugadores', 'id', 'CASCADE', 'CASCADE');
		  $this->forge->createTable('deseos', false, ['engine' => 'InnoDB']);
		  $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('deseos');
    }
}
