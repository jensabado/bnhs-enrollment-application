<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassAdvisory extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_classroom_advisory';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'section_id', 'teacher_id', 'is_deleted', 'created_at'];

    
}
