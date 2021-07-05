<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\AreaModel;
use App\Models\ParetoModel;
use App\Models\RcfaModel;

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

        $data['title'] = "Peta";
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
        return view('Rcfa/index', $data);
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
            'id_pic' => 'required',
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
                "status" => $this->request->getPost('status')
            ]);

            return redirect()->to('/peta/index');
        }

        // tampilkan form create
        return view('Peta/create', $data);
    }
    public function detail($id){
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
        $rcfa->where('rcfa.id',$id);
        $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

       // dd($data['rcfa']);
        return view('rcfa/detail', $data);
    }
    public function edit($id = 0)
    {

        $data['title'] = "Area Edit";
        $data['breadcrumb_title'] = "Area Edit";

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
        $peta = new PetaModel();
        $data['peta'] = $peta->where('id', $id)->first();

        $area2 = new AreaModel();
        $data['area'] = $area2->findAll();

        $pareto = new ParetoModel();
        $data['paretos'] = $pareto->findAll();

        $validation =  \Config\Services::validation();
        $validation->setRules([
            'problem' => 'required',
            'id_area' => 'required',
            'effect' => 'required',
            'pareto' => 'required',
            'id_pic' => 'required',
            'status' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, username, email , auth_groups.name as group ');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();
        // jika data valid, simpan ke database
        //6dd($peta->findall());

        if ($isDataValid) {
            $peta = new PetaModel();
            $s_rcfa = 0;
            if ($this->request->getPost('s_rcfa') == "on") {
                $s_rcfa = 1;
            }
            $peta->update($id, [
                "problem" => $this->request->getPost('problem'),
                "id_area" => $this->request->getPost('id_area'),
                "effect" => $this->request->getPost('effect'),
                "pareto" => json_encode($this->request->getPost('pareto')),
                "rcfa" => $this->request->getPost('rcfa'),
                "s_rcfa" => $s_rcfa,
                "id_pic" => $this->request->getPost('id_pic'),
                "status" => $this->request->getPost('status')
            ]);

            return redirect()->to('/peta/index');
        }

        // tampilkan form create
        return view('rcfa/edit', $data);
    }

    public function delete($id)
    {
        $peta = new PetaModel();
        $peta->delete($id);
        return redirect()->to('/peta/index');
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
