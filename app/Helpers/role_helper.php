<?php

use App\Models\FdtModel;
use App\Models\RcfaModel;
use App\Models\ParetoModel;
use App\Models\PeretoModel;

function checkrole($user, $role)
{

    $db      = \Config\Database::connect();
    $builder = $db->table('auth_users_permissions');
    $builder->where('user_id', $user);
    $builder->where('permission_id', $role);

    $result = $builder->get();

    if (!is_null($result->getRow())) {
        return "checked='checked'";
    }
}

function checkfdt($rcfa)
{
    $db = \Config\Database::connect();
    //$db->reset_query();
    //$fdt = $db->table('fdt');
    $fdtmodel = new FdtModel();
    $fdt = $fdtmodel->builder();


    $fdt->where('id_rcfa', $rcfa);
    $fdt->groupStart()
        ->where('validasi !=', 'close')
        ->orWhere('validasi', null)
        ->groupEnd();
    $fdt->where('deleted_at', null);
    $result = $fdt->countAllResults();
    //dd($result);
    if ($result == 0) {
        return  'close';
    } else {
        return  'open';
    }
}

function cetakpareto($id)
{
    $isi = json_decode($id, true);

    $pareto = new ParetoModel();
    $hasil = '';
    foreach ($isi as $ini) :
        $pareto->select('pereto');
        $pareto->where('id', $ini);
        $result = $pareto->first();
        $hasil = $hasil . $result['pereto'] . ' | ';
    endforeach;

    return $hasil;
}

function cekopenfdt($id)
{
    $fdtmodel = new FdtModel();

    $fdtmodel->where('id_pic', $id)
        ->groupStart()
        ->where('validasi !=', 'close')
        ->orWhere('validasi', null)
        ->groupEnd();

    $result = $fdtmodel->countAllResults();
    return $result;
}

function cekclosefdt($id)
{
    $fdtmodel = new FdtModel();

    $fdtmodel->where('id_pic', $id)
        ->where('validasi', 'close');

    $result = $fdtmodel->countAllResults();
    return $result;
}

function cekrcfa()
{
    $rcfa = new RcfaModel();
    $uprcfa = new RcfaModel();
    $result = $rcfa->findAll();

    foreach ($result as $isi) :
        if (checkfdt($isi['id']) == 'close') {
            $uprcfa->update($isi['id'], [
                'status' => 'close',
            ]);
        } else {
            $uprcfa->update($isi['id'], [
                'status' => 'open',
            ]);
        }
    endforeach;
}

function cekopenrcfa($id)
{
    $rcfamodel = new RcfaModel();

    $rcfamodel->join('peta', 'peta.id = rcfa.id_peta');
    $rcfamodel->where('peta.id_pic', $id);
    $rcfamodel->groupStart()
        ->where('rcfa.status !=', 'close')
        ->orWhere('rcfa.status', null)
        ->groupEnd();
    $result = $rcfamodel->countAllResults();
    return $result;
}

function cekclosercfa($id)
{
    $rcfamodel = new RcfaModel();

    $rcfamodel->join('peta', 'peta.id = rcfa.id_peta');
    $rcfamodel->where('peta.id_pic', $id);
    $rcfamodel->where('rcfa.status', 'close');
    $result = $rcfamodel->countAllResults();
    return $result;
}
