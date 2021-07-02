<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Evaluasi extends Migration
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
			'id_fdt'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'desc'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'jenis'      => [
				'type'           => 'ENUM',
				'constraint'     => ['3', '6', '12'],
				'default'        => '3',
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME ',
			'deleted_at DATETIME '
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('evalu', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('evalu');
	}
}
