<?php

namespace App\Models;


use Myth\Auth\Models\UserModel as MythModel;

class UserModel extends MythModel
{

    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    //protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
        'firstname', 'lastname', 'phone',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function listrcfa()
    {
        $user = $this
            ->join('auth_users_permissions', 'users.id = auth_users_permissions.user_id',)
            ->where('permission_id', 3)
            ->where('users.id !=', '1')
            ->find();
        return $user;
    }

    public function ambiluser()
    {
        $user = $this
            ->select('users.id, users.username , auth_permissions.description as permission')
            ->join('auth_users_permissions', 'users.id = auth_users_permissions.user_id',)
            ->join('auth_permissions', 'auth_permissions.id = auth_users_permissions.permission_id');
        return $user;
    }
}
