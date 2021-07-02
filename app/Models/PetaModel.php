<?php

namespace App\Models;

use CodeIgniter\Model;

class PetaModel extends Model
{

    protected $table      = 'peta';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['problem', 'id_area', 'effect', 'pareto', 'rcfa', 's_rcfa', 'id_pic', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
