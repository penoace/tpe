<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peta extends Migration
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
			'problem'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'id_area'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'effect'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'pareto'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'rcfa'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null' => true,
			],
			's_rcfa'       => [
				'type'           => 'BOOLEAN',

				'null' => true,
			],
			'id_pic'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
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
		$this->forge->createTable('peta', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('peta');
	}
}
