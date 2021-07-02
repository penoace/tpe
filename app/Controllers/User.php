<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{
		$data['title'] = 'User';
		return view('user/index', $data);
	}
}
