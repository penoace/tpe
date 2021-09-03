<?php

namespace App\Controllers;
use App\Models\PetaModel;
use App\Models\RcfaModel;
use App\Models\UserModel;
use App\Models\FdtModel;
use App\Models\EvaluModel;
use App\Models\AreaModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends BaseController
{
	public function index()
	{
		$data['title'] = 'Report';
        $data['breadcrumb_title'] = "Report" ;
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

        $query = $peta->select('peta.problem , peta.rcfa, peta.id_area , peta.effect ,peta.pareto,peta.created_at, users.username as pic_rcfa, peta.status')
            //->join('rcfa', 'rcfa.id_peta = peta.id')
            //->join('fdt','rcfa.id = fdt.id_rcfa');
            //->join('evalu','evalu.id_fdt = fdt.id' , 'left');
             ->where('peta.created_at > ','2021-08-06')
            ->join('area','area.id = peta.id_area', 'left')
            ->join('users','users.id = peta.id_pic', 'left');
            //->orderBy('peta.problem');

        $data['tarik'] = $query->findAll();


        $rcfa = new RcfaModel();

        $tarik = $rcfa->select('peta.problem , peta.id_area , rcfa.workshop , peta.rcfa, peta.id_pic as pic_rcfa,  
                                rcfa.nota, rcfa.tgl_nota , fdt.deskripsi , fdt.id_pic , fdt.target , fdt.no_wo , fdt.progress , fdt.implementasi , fdt.keterangan')
            ->join('fdt','rcfa.id = fdt.id_rcfa','left')->where('fdt.deleted_at', null)
            ->join('peta' , 'peta.id = rcfa.id_peta','left');

             $data['rcfa'] = $tarik->find();


		return view('report/index', $data);
	}
    public function export($start, $end)
    {
        
        $userModel = new PetaModel();
        $users = $userModel->findAll();

        $peta = new PetaModel();
        if($start != null and $end !=  null){
                $peta->where("peta.created_at BETWEEN '$start' AND '$end'" );
            }else if($start != null){
            $peta->where('peta.created_at >= ',$start);
            }else if($end != null){
            $peta->where('peta.created_at <= ',$end);
            }
        

        $query = $peta->select('peta.problem , peta.rcfa, peta.id_area ,peta.created_at , peta.effect ,peta.pareto, users.username as pic_rcfa, peta.status')
            //->join('rcfa', 'rcfa.id_peta = peta.id')
            //->join('fdt','rcfa.id = fdt.id_rcfa');
            //->join('evalu','evalu.id_fdt = fdt.id' , 'left');
           //->where('peta.created_at > ',$start)
            ->join('area','area.id = peta.id_area', 'left')
            ->join('users','users.id = peta.id_pic', 'left');
            //->orderBy('peta.problem');

        $result = $query->findAll();
        dd($result);

        $spreadsheet = new Spreadsheet();
       
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Problem')
            ->setCellValue('B1', 'ID RCFA')
            ->setCellValue('C1', 'Unit')
            ->setCellValue('D1', 'Effect')
            ->setCellValue('E1', 'Pareto')
            ->setCellValue('F1', 'PIC')
            ->setCellValue('G1', 'status');

        $column = 2;

        foreach ($result as $peta) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $peta['problem'])
                ->setCellValue('B' . $column, $peta['rcfa'])
                ->setCellValue('C' . $column, $peta['id_area'])
                ->setCellValue('D' . $column, $peta['effect'])
                ->setCellValue('E' . $column, cetakpareto($peta['pareto']))
                ->setCellValue('F' . $column, $peta['pic_rcfa'])
                ->setCellValue('G' . $column, $peta['status']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-User';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.Xlsx');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
       
        $writer->save('php://output');
    }

    public function exportrcfa($start, $end)
    {
        
        $userModel = new PetaModel();
        $users = $userModel->findAll();

        $peta = new PetaModel();
        if($start != null and $end !=  null){
                $peta->where("peta.created_at BETWEEN '$start' AND '$end'" );
            }else if($start != null){
            $peta->where('peta.created_at >= ',$start);
            }else if($end != null){
            $peta->where('peta.created_at <= ',$end);
            }
        

        $query = $peta->select('peta.problem , peta.rcfa, peta.id_area ,peta.created_at , peta.effect ,peta.pareto, users.username as pic_rcfa, peta.status')
            //->join('rcfa', 'rcfa.id_peta = peta.id')
            //->join('fdt','rcfa.id = fdt.id_rcfa');
            //->join('evalu','evalu.id_fdt = fdt.id' , 'left');
           //->where('peta.created_at > ',$start)
            ->join('area','area.id = peta.id_area', 'left')
            ->join('users','users.id = peta.id_pic', 'left');
            //->orderBy('peta.problem');

        $result = $query->findAll();
        dd($result);

        $spreadsheet = new Spreadsheet();
       
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Problem')
            ->setCellValue('B1', 'ID RCFA')
            ->setCellValue('C1', 'Unit')
            ->setCellValue('D1', 'Effect')
            ->setCellValue('E1', 'Pareto')
            ->setCellValue('F1', 'PIC')
            ->setCellValue('G1', 'status');

        $column = 2;

        foreach ($result as $peta) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $peta['problem'])
                ->setCellValue('B' . $column, $peta['rcfa'])
                ->setCellValue('C' . $column, $peta['id_area'])
                ->setCellValue('D' . $column, $peta['effect'])
                ->setCellValue('E' . $column, cetakpareto($peta['pareto']))
                ->setCellValue('F' . $column, $peta['pic_rcfa'])
                ->setCellValue('G' . $column, $peta['status']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-User';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.Xlsx');
        header('Cache-Control: max-age=0');
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
       
        $writer->save('php://output');
    }

     public function ambildata(){
        $start = $this->request->getVar('startdate');
        $end = $this->request->getVar('enddate');
        if($this->request->isAJAX()){
            $peta = new PetaModel();
            $peta->select('peta.problem , peta.rcfa, peta.status ,  peta.created_at, users.username, area.area');
                       
                $peta->join('users', 'users.id = peta.id_pic' , 'left')
                ->join('area', 'area.id = peta.id_area' , 'left');
                if($start != null and $end !=  null){
                    $peta->where("peta.created_at BETWEEN '$start' AND '$end'" );
                }else if($start != null){
                    $peta->where('peta.created_at >= ',$start);
                }else if($end != null){
                    $peta->where('peta.created_at <= ',$end);
                }
            $data['petas'] = $peta->findAll();


            //dd($data['petas']);

            $rcfa = new RcfaModel();
            $rcfa->select('rcfa.*, peta.id_area,peta.id_pic, peta.rcfa ,peta.problem, peta.deleted_at, area.area ,rcfa.created_at, users.username');
            if($start != null and $end !=  null){
                $rcfa->where("rcfa.created_at BETWEEN '$start' AND '$end'" );
            }else if($start != null){
            $rcfa->where('rcfa.created_at >= ',$start);
            }else if($end != null){
            $rcfa->where('rcfa.created_at <= ',$end);
            }
            //$rcfa->where('peta.deleted_at', null);
            $data['rcfas'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta','left')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->findAll();

            

            $msg = [
                'data'=> view('Report/datapeta', $data)
            ];
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }

    public function ambildatarcfa(){
        $start = $this->request->getVar('startdate');
        $end = $this->request->getVar('enddate');
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
            $rcfa->select('rcfa.*, peta.id_area,peta.id_pic, peta.rcfa ,peta.problem, peta.deleted_at, area.area ,rcfa.created_at, users.username');
            if($start != null and $end !=  null){
                $rcfa->where("rcfa.created_at BETWEEN '$start' AND '$end'" );
            }else if($start != null){
            $rcfa->where('rcfa.created_at >= ',$start);
            }else if($end != null){
            $rcfa->where('rcfa.created_at <= ',$end);
            }
            //$rcfa->where('peta.deleted_at', null);
            $data['rcfas'] = $rcfa->join('peta', 'peta.id = rcfa.id_peta','left')->join('users', 'users.id = peta.id_pic')->join('area', 'area.id = peta.id_area')->findAll();

            

            $msg = [
                'data'=> view('Report/datarcfa', $data)
            ];
            echo json_encode($msg);
        }else{
           exit('Tidak bisa diakses') ;
        }
    }
}
