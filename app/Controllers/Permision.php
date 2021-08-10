<?php

namespace App\Controllers;

use App\Models\PermisionModel;

class Permision extends BaseController
{
    public function index()
    {
        $permision= new PermisionModel();

        /*
         siapkan data untuk dikirim ke view dengan nama $newses
         dan isi datanya dengan news yang sudah terbit
        */
        $data['permisions'] = $permision->findAll();

        $data['title'] = "Permission";
        $data['breadcrumb_title'] = "Permission";
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
        return view('Permision/index', $data);
    }

    public function input()
    {

        $data['title'] = "Permission Input";
        $data['breadcrumb_title'] = "Permission Input";

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
        $validation->setRules(['name' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $permision= new PermisionModel();
            $permision->insert([
                "name" => $this->request->getPost('name'),
                "description" => $this->request->getPost('description')
            ]);

            return redirect()->to('/permision/index');
        }

        // tampilkan form create
        return view('Permision/create', $data);
    }
    public function edit($id = 0)
    {

        $data['title'] = "Permision Edit";
        $data['breadcrumb_title'] = "Permision Edit";

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
        $permision = new PermisionModel();
        $data['permision'] = $permision->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(['name' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {


            $permision->update($id, [
                "name" => $this->request->getPost('name'),
                "description" => $this->request->getPost('description')
            ]);

            return redirect()->to('/permision/index');
        }

        // tampilkan form create
        return view('Permision/edit', $data);
    }

    public function delete($id)
    {
        $area = new PermisionModel();
        $area->delete($id);
        return redirect()->to('/permision/index');
    }
}
