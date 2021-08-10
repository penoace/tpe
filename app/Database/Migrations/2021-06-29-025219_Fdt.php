<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fdt extends Migration
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
			'deskripsi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'id_rcfa'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'id_pic'      => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'target'       => [
				'type'           => 'DATETIME'

			],
			'no_wo'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'progress'      => [
				'type'           => 'ENUM',
				'constraint'     => ['open', 'inprogress', 'close'],
				'default'        => 'open',
			],
			'implementasi'       => [
				'type'           => 'DATETIME'

			],
			'keterangan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'validasi'      => [
				'type'           => 'ENUM',
				'constraint'     => ['revisi',  'close'],
				
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME ',
			'deleted_at DATETIME '
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('fdt', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('fdt');
	}
}
