<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Area extends Migration
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
			'area'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME ',
			'deleted_at DATETIME '
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('area', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('area');
	}
}
