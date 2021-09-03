<?php 

use App\Models\FdtModel;
use App\Models\ParetoModel;
use App\Models\PeretoModel;

function checkrole($user , $role){

    $db      = \Config\Database::connect();
    $builder = $db->table('auth_users_permissions');
    $builder->where('user_id',$user);
    $builder->where('permission_id',$role);

    $result = $builder->get();

    if( !is_null($result->getRow()) ){
        return "checked='checked'";
    }
}

function checkfdt($rcfa){
    $fdt = new FdtModel();

    $fdt->where('id_rcfa',$rcfa);
    $fdt->where('validasi !=' , 'close');
    $fdt->orWhere('validasi', null);

    $result = $fdt->findAll();
    
    if($result == null){
        return true;
    }else{
        return false;
    }

}

function cetakpareto($id){
    $isi = json_decode($id, true);

    $pareto = new ParetoModel();
    $hasil = '';
    foreach ($isi as $ini ) :
        $pareto->select('pereto');
        $pareto->where('id', $ini);
        $result = $pareto->first();
        $hasil = $hasil.$result['pereto'].' | ';
    endforeach ;

    return $hasil;

}



?>