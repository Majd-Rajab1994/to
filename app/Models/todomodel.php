<?php
namespace App\Models;

use CodeIgniter\Model;

class todomodel extends Model
{
    protected $table = 'todo';
    protected $primaryKey = 'id';
    protected $allowedFields =['name','is_deleted','user_id'];
}

?>