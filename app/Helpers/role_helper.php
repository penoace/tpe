<?php 

use App\Models\FdtModel;

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



?>