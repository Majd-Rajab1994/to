<?php
namespace App\Models;

use CodeIgniter\Model;

class todomodel extends Model
{
    protected $table = 'todo';
    protected $primaryKey = 'id';

    //protected $returnType = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields =['name','is_deleted','user_id'];

    //protected $useTimestamps = false;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    //protected $validationRules    = [];
    //protected $validationMessages = [];
    //protected $skipValidation     = false;
}

?>