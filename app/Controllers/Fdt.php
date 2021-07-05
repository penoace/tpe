<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\AreaModel;
use App\Models\ParetoModel;
use App\Models\RcfaModel;
use App\Models\FdtModel;

class Fdt extends BaseController
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

    public function input($id)
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

            'target' => 'required',
            'id_pic' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
            $fdt = new FdtModel();
            //dd($this->request->getPost());
            $fdt->insert([
                "deskripsi" => $this->request->getPost('deskripsi'),
                "id_rcfa" => $id,
                "id_pic" => $this->request->getPost('id_pic'),
                "target" => $this->request->getPost('target'),
                "no_wo" => $this->request->getPost('no_wo'),
                "implementasi" => $this->request->getPost('implementasi'),
                "keterangan" => $this->request->getPost('keterangan'),
                "progress" => $this->request->getPost('progress')

            ]);

            return redirect()->to('rcfa/detail/' . $id);
        }
        // dd($data['rcfa']);

        return view('rcfa/detail', $data);
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

        $rcfa = new RcfaModel();
        $rcfa->select('rcfa.*, peta.id_area, peta.rcfa ,peta.problem, area.area , users.username');
        $rcfa->where('rcfa.id', $id);
        $data['rcfa'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->first();

        // dd($data['rcfa']);
        return view('rcfa/detail', $data);
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
                "status" => $this->request->getPost('status')
            ]);

            return redirect()->to('rcfa/detail/' . $id);
        }

        // dd($data['rcfa']);
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
