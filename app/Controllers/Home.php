<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return redirect()->to('dashboard');
	}
	public function register()
	{
		return view('auth/register');
	}
	public function user()
	{
		return view('user/index');
	}
}
