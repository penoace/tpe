<?php

namespace App\Controllers;

class Admin extends BaseController
{

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->builder = $this->db->table('users');
	}

	public function index()
	{
		$data['title'] = 'User List';
		//$users = new \Myth\Auth\Models\UserModel();
		//$data['users'] = $users->findAll();

		$this->builder->select('users.id, username, email , auth_groups.name as group ');
		$this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
		$this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
		$query = $this->builder->get();

		$data['users'] = $query->getResult();
		return view('admin/index', $data);
	}

	public function detail($id = 0)
	{
		$data['title'] = 'User Detail';
		//$users = new \Myth\Auth\Models\UserModel();
		//$data['users'] = $users->findAll();


		$this->builder->select('users.id, username, email , auth_groups.name as group ');
		$this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
		$this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
		$this->builder->where('users.id', $id);
		$query = $this->builder->get();

		$data['users'] = $query->getRow();
		if (empty($data['users'])) {
			return redirect()->to('/admin');
		}

		return view('admin/detail', $data);
	}
}
