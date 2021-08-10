<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\AreaModel;
use App\Models\ParetoModel;
use App\Models\RcfaModel;
use App\Models\FdtModel;
use App\Models\EvalModel;

class Rcfa extends BaseController
{

    public function index()
    {
        $peta = new PetaModel();
        $peta->select('peta.*, users.username, area.area');
        /*
         siapkan data untuk dikirim ke view dengan nama $newses
         dan isi datanya dengan news yang sudah terbit
        */

        $data['petas'] = $peta->join('users', 'users.id = peta.id_pic')
            ->join('area', 'area.id = peta.id_area')->findAll();

        //dd($data);

        $rcfa = new RcfaModel();
        $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
        $data['rcfas'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->findAll();

        $data['title'] = "RCFA";
        $data['breadcrumb_title'] = "RCFA";
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
        return view('Rcfa/index', $data);
    }

    public function ambildata(){
        
        if($this->request->isAJAX()){
            $peta = new PetaModel();
            $peta->select('peta.*, users.username, area.area');
            /*
            siapkan data untuk dikirim ke view dengan nama $newses
            dan isi datanya dengan news yang sudah terbit
            */

            $data['petas'] = $peta->join('users', 'users.id = peta.id_pic')
                ->join('area', 'area.id = peta.id_area')->findAll();

            //dd($data);

            $rcfa = new RcfaModel();
            $rcfa->select('rcfa.*, peta.id_area,peta.id_pic, peta.rcfa ,peta.problem, peta.deleted_at, area.area , users.username');
            //$rcfa->where('peta.deleted_at', null);
            $data['rcfas'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta','left')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->findAll();

            

            $msg = [
                'data'=> view('Rcfa/datarcfa', $data)
            ];
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }

    public function formtambah(){
        $id = $this->request->getVar('id');
        if($this->request->isAJAX()){
            $data['title'] = "Peta Input";
            $data['breadcrumb_title'] = "Peta";
    
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
            $data['rcfa'] =['id'=>$id];
            $area2 = new AreaModel();
            $data['area'] = $area2->findAll();
    
            $pareto = new ParetoModel();
            $data['paretos'] = $pareto->findAll();
    
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->select('users.id, username, email , auth_groups.name as group ');
            $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $builder->get();
    
            $data['users'] = $query->getResult();

            $msg = [
                'data'=> view('Rcfa/tambahfdt', $data)
            ];
            //return view('Peta/create', $data);
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }
    public function input()
    {

        $data['title'] = "Peta Input";
        $data['breadcrumb_title'] = "Peta";

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

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'problem' => 'required',
            'id_area' => 'required',
            'effect' => 'required',
            'pareto' => 'required',
            'status' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        //dd($validation);
        $area2 = new AreaModel();
        $data['area'] = $area2->findAll();

        $pareto = new ParetoModel();
        $data['paretos'] = $pareto->findAll();

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, username, email , auth_groups.name as group ');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();

        //$all = $this->request->getPost();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            //dd($all);
            $area = new PetaModel();
            $s_rcfa = 0;
            if ($this->request->getPost('s_rcfa') == "on") {
                $s_rcfa = 1;
            }
            //dd($s_rcfa);
            $area->insert([
                "problem" => $this->request->getPost('problem'),
                "id_area" => $this->request->getPost('id_area'),
                "effect" => $this->request->getPost('effect'),
                "pareto" => json_encode($this->request->getPost('pareto')),
                "rcfa" => $this->request->getPost('rcfa'),
                "s_rcfa" => $s_rcfa,
                "id_pic" => $this->request->getPost('id_pic'),
                "status" => $this->request->getPost('status'),
            ]);

            return redirect()->to('/peta/index');
        }

        // tampilkan form create
        return view('Peta/create', $data);
    }
    public function detail($id)
    {
        $data['title'] = "RCFA Detail";
        $data['breadcrumb_title'] = "Detail RCFA";

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
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, username, email , auth_groups.name as group ');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();
        $rcfa = new RcfaModel();
        $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
        $rcfa->where('rcfa.id', $id);
        $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

        $fdt = new FdtModel();
        $fdt->select('fdt.* , users.username');
        $fdt->where('id_rcfa', $id);
        $fdt->join('users', 'users.id = fdt.id_pic');
        $data['fdt'] = $fdt->findAll();
        // dd($data['rcfa']);
        return view('rcfa/detail', $data);
    }

    public function ambilfdt(){
        $id = $this->request->getVar('id');
        if($this->request->isAJAX()){
            $data['title'] = "RCFA Detail";
            $data['breadcrumb_title'] = "Detail RCFA";

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
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->select('users.id, username, email , auth_groups.name as group ');
            $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $builder->get();

            $data['users'] = $query->getResult();
            $rcfa = new RcfaModel();
            $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
            $rcfa->where('rcfa.id', $id);
            $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

            $fdt = new FdtModel();
            $fdt->select('fdt.* , users.username');
            $fdt->where('id_rcfa', $id);
            $fdt->join('users', 'users.id = fdt.id_pic');
            $data['fdt'] = $fdt->findAll();
            // dd($data['rcfa']);
            //return view('rcfa/detail', $data);

            $msg = [
                'data'=> view('Rcfa/datafdt', $data)
            ];
            
            echo json_encode($msg);

        }else{
            echo "tidak bisa diakses";
        }
    }



    public function edit($id = 0)
    {

        $data['title'] = "RCFA Detail";
        $data['breadcrumb_title'] = "Detail RCFA";

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

        $rcfa = new RcfaModel();
        $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
        $rcfa->where('rcfa.id', $id);
        $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_peta' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $rcfas = new RcfaModel();
            //dd($this->request->getPost());
            $rcfas->update($id, [
                "workshop" => $this->request->getPost('workshop'),
                "nota" => $this->request->getPost('nota'),
                "status" => $this->request->getPost('status'),
                "tgl_nota" => $this->request->getPost('tgl_nota'),
            ]);

            return redirect()->to('rcfa/index/' . $id);
        }

        // dd($data['rcfa']);
        return view('rcfa/edit', $data);
    }
    public function edit2($id = 0)
    {

        $data['title'] = "RCFA Detail";
        $data['breadcrumb_title'] = "Detail RCFA";

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

        $rcfa = new RcfaModel();
        $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
        $rcfa->where('rcfa.id', $id);
        $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_peta' => 'required'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $rcfas = new RcfaModel();
            //dd($this->request->getPost());
            $rcfas->update($id, [
                "workshop" => $this->request->getPost('workshop'),
                "nota" => $this->request->getPost('nota'),
                "status" => $this->request->getPost('status'),
                "tgl_nota" => $this->request->getPost('tgl_nota'),
            ]);

            return redirect()->to('rcfa/detail/' . $id);
        }

        // dd($data['rcfa']);
        return view('rcfa/edit', $data);
    }

    public function delete($id)
    {
       // $peta = new RcfaModel();
        //$peta->delete($id);
       
        $rcfa = new RcfaModel();
        $fdt = new FdtModel();
        $idfdt = new FdtModel();


        
        $bfdt = $idfdt->where('id_rcfa', $id)->find();
        foreach ($bfdt as $dfdt){
            $evalu = new EvalModel();
            $evalu->where('id_fdt', $dfdt['id'])->delete();
        }

        
        //dd($idrcfa[0]['id']);
        
        $fdt->where('id_rcfa', $id)->delete();
        
        $rcfa->delete($id);
        
        

        return redirect()->to('/rcfa/index');

    }


    public function addrcfa()
    {

        $rcfa = new RcfaModel();


        $rcfa->insert([
            "id_peta" => $this->request->getPost('id_peta'),

        ]);

        return redirect()->to('/peta/index');
    }
    public function pareto($id)
    {
        // $id = '["1","2"]';
        $peta = new PetaModel();
        $data = $peta->where('id', $id)->first();

        $tes = json_decode($data['pareto'], true);
        $hasil = "";
        foreach ($tes as $te) {
            $pareto = new ParetoModel();
            $pareto->select('pereto');
            $isi = $pareto->where('id', $te)->first();
            $hasil = $hasil . "<li>" . $isi['pereto'] . "</li>";
        }

        //$pareto = new ParetoModel();
        //$pareto->select('pereto');
        //$isi = $pareto->where('id', 1)->first();


        return print($hasil);
    }
}
