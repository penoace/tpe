<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\AreaModel;
use App\Models\ParetoModel;
use App\Models\RcfaModel;
use App\Models\FdtModel;
use App\Models\EvalModel;

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
                        'deskripsi' => 'required',
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
        $data['validation'] = $isDataValid;
        return view('rcfa/detail', $data);
    }

    public function simpanfdt($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                    ],
                'target' => [
                    'label' => 'Target',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                ]
                    

                ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'deskripsi' => $validation->getError('deskripsi'),
                        'target' => $validation->getError('target')
                    ]
                    ];
               
            }else {
                $fdt = new FdtModel();
                //dd($this->request->getPost());
                $fdt->insert([
                    "deskripsi" => $this->request->getVar('deskripsi'),
                    "id_rcfa" => $id,
                    "id_pic" => $this->request->getVar('id_pic'),
                    "target" => $this->request->getVar('target'),
                    "no_wo" => $this->request->getVar('no_wo'),
                    "implementasi" => $this->request->getVar('implementasi'),
                    "keterangan" => $this->request->getVar('keterangan'),
                    "progress" => $this->request->getVar('progress')

                ]);
                $msg =[
                    'sukses' => 'Data Disimpan'
                ];

            }
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
        }

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
    public function formedit(){
        $id = $this->request->getVar('id');
        if($this->request->isAJAX()){
            
            $data['rcfa'] =['id'=>$id];
            $area2 = new AreaModel();
            $data['area'] = $area2->findAll();
    
            $pareto = new ParetoModel();
            $data['paretos'] = $pareto->findAll();

            $fdt = new FdtModel();
            $data['fdt'] = $fdt->where('id',$id)->first();
    
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->select('users.id, username, email , auth_groups.name as group ');
            $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $query = $builder->get();
    
            $data['users'] = $query->getResult();

            $msg = [
                'sukses'=> view('Rcfa/editfdt', $data)
            ];
            //return view('Peta/create', $data);
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }

    public function simpaneval($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'desc' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                    ]
                
                ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'desc' => $validation->getError('deskripsi')
                        
                    ]
                    ];
               
            }else {
                $evalu = new EvalModel();
                //dd($this->request->getPost());
                $evalu->insert([
                    "desc" => $this->request->getVar('desc'),
                    "id_fdt" => $id,
                    "jenis" => $this->request->getVar('jenis')
                ]);
                $msg =[
                    'sukses' => 'Data Disimpan'
                ];

            }
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
        }

    }

    public function updateeval($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'desc' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                    ]
                
                ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'desc' => $validation->getError('deskripsi')
                        
                    ]
                    ];
               
            }else {
                $evalu = new EvalModel();
                //dd($this->request->getPost());
                $evalu->update( $id ,[
                    "desc" => $this->request->getVar('desc'),
                    
                    "jenis" => $this->request->getVar('jenis')
                ]);
                $msg =[
                    'sukses' => 'Data Disimpan'
                ];

            }
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
        }

    }
    public function formtambaheval(){
        $id_fdt = $this->request->getVar('id');
        if($this->request->isAJAX()){
            
            
            $data['id_fdt'] = $id_fdt;
            

            $msg = [
                'sukses'=> view('Rcfa/tambaheval.php', $data)
            ];
            //return view('Peta/create', $data);
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }

    public function formediteval(){
        $id= $this->request->getVar('id');
        if($this->request->isAJAX()){
            $evalu = new EvalModel();
            $evalu->where('id',$id);
            $data['eval'] = $evalu->first();
            
           // $data['id_fdt'] = $id_fdt;
            

            $msg = [
                'sukses'=> view('Rcfa/editeval.php', $data)
            ];
            //return view('Peta/create', $data);
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }
    

    public function showeval(){
        $id = $this->request->getVar('id');
        if($this->request->isAJAX()){
            
            $eval = new EvalModel();
            $eval->where('id_fdt',$id);

            $data['eval']= $eval->findAll();
            $data['id'] = $id;
            $msg = [
                'sukses'=> view('Rcfa/showeval', $data)
            ];
            //return view('Peta/create', $data);
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }


    public function updatefdt($id){
        if($this->request->isAJAX()){
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'deskripsi' => [
                    'label' => 'Deskripsi',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                    ],
                'target' => [
                    'label' => 'Target',
                    'rules' => 'required',
                    'errors' => [
                        'required' =>'{field} Harus Diisi']
                ]
                    

                ]);
            if(!$valid){
                $msg = [
                    'error' => [
                        'deskripsi' => $validation->getError('deskripsi'),
                        'target' => $validation->getError('target')
                    ]
                    ];
               
            }else {
                $fdt = new FdtModel();
                //dd($this->request->getPost());
                //$id = $this->request->getVar('id');
                $fdt->update($id,[
                    "deskripsi" => $this->request->getVar('deskripsi'),
                    "id_pic" => $this->request->getVar('id_pic'),
                    "target" => $this->request->getVar('target'),
                    "no_wo" => $this->request->getVar('no_wo'),
                    "implementasi" => $this->request->getVar('implementasi'),
                    "keterangan" => $this->request->getVar('keterangan'),
                    "progress" => $this->request->getVar('progress'),
                    "validasi" => $this->request->getVar('validasi'),

                ]);
                $msg =[
                    'sukses' => 'Data diupdate'
                ];

            }
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
        }
    }

    public function hapus(){
        if($this->request->isAJAX()){
            
                $fdt = new FdtModel();
                //dd($this->request->getPost());
                $id = $this->request->getVar('id');
                $fdt->delete($id);

                $evalu = new EvalModel();
                $evalu->where('id_fdt', $id)->delete();


                $msg =[
                    'sukses' => 'Data Dihapus'
                ];

            
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
        }
    }
    public function hapuseval(){
        if($this->request->isAJAX()){
            
                $evalu = new EvalModel();
                //dd($this->request->getPost());
                $id = $this->request->getVar('id');
                $evalu->delete($id);
                $msg =[
                    'sukses' => 'Data Dihapus'
                ];

            
            echo json_encode($msg);

        }else{
            exit("tidak diproses");
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
                "status" => $this->request->getPost('status')
            ]);

            return redirect()->to('rcfa/detail/' . $id);
        }

        // dd($data['rcfa']);
        return view('rcfa/edit', $data);
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
