<?php

namespace App\Controllers;
use App\Models\PetaModel;
use App\Models\RcfaModel;
use App\Models\FdtModel;
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
        

        $list = $rcfa->find();
        $open = 0; 
        $close = 0;
        foreach ($list as $lis ){
            if(checkfdt($lis['id'])){
                $close=+1;
            }else{
                $open=+1;
            }

        }

        $data['jpetao'] = $peta->countAllResults() - $peta->where('status', 'close')->countAllResults() ;
        $data['jpetac'] = $peta->where('status', 'close')->countAllResults();

        $data['jrcfao'] = $open;
        $data['jrcfac'] = $close;

        $data['jfdto'] =$fdt->countAllResults() - $fdt->where('validasi', 'close')->countAllResults();
        $data['jfdtc'] =$fdt->where('validasi', 'close')->countAllResults();

        $data['fdtlist'] = $fdt->where('id_pic', user()->id)->findAll();

       // dd($data['fdtlist']);

        return view('dashboard', $data);
    }
}