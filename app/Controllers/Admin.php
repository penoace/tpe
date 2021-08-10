<?php

namespace App\Controllers;
use App\Models\PermisionModel;
use CodeIgniter\HTTP\IncomingRequest;

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
		$data['breadcrumb_title'] = "User" ;
		$data['breadcrumb']  =  array(
            array(
                'title' => 'Home',
                'link' => 'dashboard'
            ),
            array(
                'title' => 'Breadcrumb Title',
                'link' => null
            )
        );
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
		$data['breadcrumb_title'] = "User" ;
		$data['breadcrumb']  =  array(
            array(
                'title' => 'Home',
                'link' => 'dashboard'
            ),
            array(
                'title' => 'Breadcrumb Title',
                'link' => null
            )

        );
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

	public function edit($id = 0)
	{
		$data['title'] = 'User Edit';
		$data['breadcrumb_title'] = "User" ;
		$data['breadcrumb']  =  array(
            array(
                'title' => 'Home',
                'link' => 'dashboard'
            ),
            array(
                'title' => 'Breadcrumb Title',
                'link' => null
            )
        );
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

		return view('admin/edit', $data);
	}

	public function akses($id = 0)
	{
		$data['title'] = 'User Akses';
		$data['breadcrumb_title'] = "User Akses" ;
		$data['breadcrumb']  =  array(
            array(
                'title' => 'Home',
                'link' => 'dashboard'
            ),
            array(
                'title' => 'Breadcrumb Title',
                'link' => null
            )
        );
		//$users = new \Myth\Auth\Models\UserModel();
		//$data['users'] = $users->findAll();
		$permision= new PermisionModel();
        $data['permisions'] = $permision->findAll();

		$this->builder->select('users.id, username, email  ');
		//$this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
		//$this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
		$this->builder->where('users.id', $id);
		$query = $this->builder->get();


		$data['users'] = $query->getRow();
		if (empty($data['users'])) {
			return redirect()->to('/admin');
		}

		return view('admin/akses', $data);
	}

	public function changeaccess(){
		
		$request = service('request');
		$role_id = $request->getPost('roleid');
		$user_id = $request->getPost('userid');

		$data = [
			'user_id' => $user_id,
			'permission_id' => $role_id,
		];

		$dbs = \Config\Database::connect();
		$builders = $dbs->table('auth_users_permissions');
		$builders->where($data);
		$result = $builders->get(); 

		if( !is_null($result->getRow()) < 1){
			$builders->insert($data);
		}else{
			$builders->delete($data);
		}

		$this->session->setFlashdata('message','berhasil');
		
	}
	
}
