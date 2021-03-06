<?php

namespace App\Controllers;

use App\Models\PetaModel;
use App\Models\AreaModel;
use App\Models\EvalModel;
use App\Models\FdtModel;
use App\Models\ParetoModel;
use App\Models\RcfaModel;
use App\Models\UserModel;

class Peta extends BaseController
{

    public function index()
    {
        $peta = new PetaModel();
        $peta->select('peta.*, users.username, area.area');
        /*
         siapkan data untuk dikirim ke view dengan nama $newses
         dan isi datanya dengan news yang sudah terbit
        */

        $data['petas'] = $peta->join('users', 'users.id = peta.id_pic' , 'left')
            ->join('area', 'area.id = peta.id_area')->findAll();
         
        //dd($data);

        $rcfa = new RcfaModel();
        $data['rcfa'] = $rcfa->findAll();

        $data['title'] = "Peta Impovement Enjiniring";
        $data['breadcrumb_title'] = "Peta Impovement Enjiniring" ;
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
        return view('Peta/index', $data);
    }

    public function ambildata(){
        
        if($this->request->isAJAX()){
            $peta = new PetaModel();
            $peta->select('peta.*, users.username, area.area');
            /*
            siapkan data untuk dikirim ke view dengan nama $newses
            dan isi datanya dengan news yang sudah terbit
            */

            $data['petas'] = $peta->join('users', 'users.id = peta.id_pic' , 'left')
                ->join('area', 'area.id = peta.id_area')->findAll();
            
            //dd($data);

            $rcfa = new RcfaModel();
            $data['rcfa'] = $rcfa->findAll();
            

            $msg = [
                'data'=> view('Peta/datapeta', $data)
            ];
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }

    public function input()
    {

        $data['title'] = "Peta Input";
        $data['breadcrumb_title'] = "Input Peta";

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
        $builder->where('auth_groups_users.group_id', 2 );
        $builder->orWhere('auth_groups_users.group_id', 3 );
        $query = $builder->get();

//        $data['users'] = $query->getResult();
        
        $user = new UserModel();
        
        $data['users'] = $user->listrcfa();;
        

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
            if(has_permission('sub_admin')){
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
            }else{
            $peta->update($id, [
                "problem" => $this->request->getPost('problem'),
                "id_area" => $this->request->getPost('id_area'),
                "effect" => $this->request->getPost('effect'),
                "pareto" => json_encode($this->request->getPost('pareto')),
              
            ]);
            }

            return redirect()->to('/peta/index');
        }

        // tampilkan form create
        return view('peta/edit', $data);
    }

    public function delete($id)
    {
        
        $peta = new PetaModel();
        $rcfa = new RcfaModel();
        $fdt = new FdtModel();
        
        $idrcfa = $rcfa->select('id')->where('id_peta',$id)->find();
        $idfdt = new FdtModel();
        $bfdt = $idfdt->where('id_rcfa', $idrcfa[0]['id'])->find();
        foreach ($bfdt as $dfdt){
            $evalu = new EvalModel();
            $evalu->where('id_fdt', $dfdt['id'])->delete();
        }

        
        //dd($idrcfa[0]['id']);
        
        $fdt->where('id_rcfa', $idrcfa[0]['id'])->delete();
        
        $rcfa->where('id_peta' , $id)->delete();
        
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
