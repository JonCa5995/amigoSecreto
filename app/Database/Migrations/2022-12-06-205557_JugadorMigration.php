<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class JugadorMigration extends Migration
{
    public function up()
    {
		 $this->db->disableForeignKeyChecks();
		 $this->forge->addField([
			 'id' => [
				 'type'				=> 'INT',
				 'unsigned'			=> true,
				 'auto_increment'	=> true,
				 'null'				=> false
			 ],
			 'nombre' => [
				 'type'			=> 'VARCHAR',
				 'constraint'	=> 255,
				 'null'			=> false,
				 'unique'		=> true
			 ],
			 'clave' => [
				 'type'			=> 'VARCHAR',
				 'constraint'	=> 255,
				 'null'			=> true,
			 ],
			 'admin' => [
				 'type'		=> 'BOOLEAN',
				 'null'		=> false,
				 'default'	=> false,
			 ],
			 'activado' => [
				 'type'		=> 'BOOLEAN',
				 'null'		=> false,
				 'default'	=> false
			 ],
			 'restablece' => [
				 'type'		=> 'BOOLEAN',
				 'null'		=> false,
				 'default'	=> false
			 ],
			 'regala' => [
				 'type'		=> 'INT',
				 'unsigned'	=> true,
				 'null'		=> true
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
		 $this->forge->addForeignKey('regala', 'jugadores', 'id', 'CASCADE', 'SET NULL');
		 $this->forge->createTable('jugadores', false, ['engine' => 'InnoDB']);
		 $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
		 $this->forge->dropTable('jugadores');
	 }
}
