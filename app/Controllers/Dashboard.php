<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\RcfaModel;
use App\Models\FdtModel;
use App\Models\UserModel as userl;
use CodeIgniter\HTTP\IncomingRequest;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = "AdminLTE 3 | Dashboard";
        $data['breadcrumb_title'] = "Dashboard";
        $breadcrumb =   array(
            array(
                'title' => 'Home',
                'link' => 'dashboard'
            ),
            array(
                'title' => 'Dashboard v1',
                'link' => null
            )
        );
        $data['breadcrumb'] = $breadcrumb;

        $peta = new PetaModel();
        $rcfa = new RcfaModel();
        $fdt = new FdtModel();
        $user = new userl();

        $list = $rcfa->find();
        $open = 0;
        $close = 0;
        foreach ($list as $lis) {
            if (checkfdt($lis['id']) == 'close') {
                $close++;
            } else {
                $open++;
            }
        }

        $data['jpetao'] = $peta->countAllResults() - $peta->where('status', 'close')->countAllResults();
        $data['jpetac'] = $peta->where('status', 'close')->countAllResults();

        $data['jrcfao'] = $open;
        $data['jrcfac'] = $close;

        $data['jfdto'] = $fdt->countAllResults() - $fdt->where('validasi', 'close')->countAllResults();
        $data['jfdtc'] = $fdt->where('validasi', 'close')->countAllResults();

        $data['fdtlist'] = $fdt->where('id_pic', user()->id)->groupStart()->where('validasi', 'revisi')->orWhere('validasi', null)->groupEnd()->findAll();
        $data['rcfalist'] = $rcfa->select('rcfa.id , peta.problem , rcfa.status')->join('peta', 'peta.id = rcfa.id_peta')->where('peta.id_pic', user()->id)->where('rcfa.status !=', 'close')->findAll();
        //dd($data['fdtlist']);

        //$user = $user; ambiluser()->where('auth_permissions.description', 'fdt')->where('users.id !=', 1)->
        $coba = $user->builder();
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, users.username , auth_permissions.description as permission')
            ->where('auth_permissions.description', 'fdt')->where('users.id !=', 1)
            ->join('auth_users_permissions', 'users.id = auth_users_permissions.user_id',)
            ->join('auth_permissions', 'auth_permissions.id = auth_users_permissions.permission_id');
        $query = $builder->get();

        $builder2 = $db->table('users');
        $builder2->select('users.id, users.username , auth_permissions.description as permission')
            ->where('auth_permissions.description', 'rcfa')->where('users.id !=', 1)
            ->join('auth_users_permissions', 'users.id = auth_users_permissions.user_id',)
            ->join('auth_permissions', 'auth_permissions.id = auth_users_permissions.permission_id');
        $query2 = $builder2->get();


        $data['chart'] =  $query->getResult();
        $data['chart2'] =  $query2->getResult();


        // dd($data['fdtlist']);

        return view('dashboard', $data);
    }
}
