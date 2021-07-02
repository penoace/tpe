<?php

namespace App\Controllers;

use App\Models\AreaModel;

class Area extends BaseController
{
    public function index()
    {
        $area = new AreaModel();

        /*
         siapkan data untuk dikirim ke view dengan nama $newses
         dan isi datanya dengan news yang sudah terbit
        */
        $data['area'] = $area->findAll();

        $data['title'] = "Area";
        $data['breadcrumb_title'] = "Area";
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
        return view('Area/index', $data);
    }

    public function input()
    {

        $data['title'] = "Area";
        $data['breadcrumb_title'] = "Area";

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
        $validation->setRules(['area' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {
            $area = new AreaModel();
            $area->insert([
                "area" => $this->request->getPost('area')
            ]);

            return redirect()->to('/area/index');
        }

        // tampilkan form create
        return view('Area/create', $data);
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
        $area = new AreaModel();
        $data['area'] = $area->where('id', $id)->first();

        $validation =  \Config\Services::validation();
        $validation->setRules(['area' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data valid, simpan ke database
        if ($isDataValid) {


            $area->update($id, [
                "area" => $this->request->getPost('area')
            ]);

            return redirect()->to('/area/index');
        }

        // tampilkan form create
        return view('Area/edit', $data);
    }

    public function delete($id)
    {
        $area = new AreaModel();
        $area->delete($id);
        return redirect()->to('/area/index');
    }
}
