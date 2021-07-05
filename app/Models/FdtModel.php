<?php

namespace App\Models;

use CodeIgniter\Model;

class FdtModel extends Model
{

    protected $table      = 'fdt';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_rcfa', 'deskripsi', 'id_pic', 'target', 'no_wo', 'prgress', 'implementasi', 'keterangan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
