<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rcfa extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_peta'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'workshop'       => [
				'type'           => 'DATETIME',
				'null' => true,

			],
			'nota'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null' => true,
			],
			'status'      => [
				'type'           => 'ENUM',
				'constraint'     => ['open', 'inprogress', 'close'],
				'default'        => 'open',
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME ',
			'deleted_at DATETIME '
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('rcfa', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('rcfa');
	}
}
