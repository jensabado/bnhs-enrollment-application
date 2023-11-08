<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentSection extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_student_section';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id','student_id', 'grade_level_id', 'section_id', 'created_at'];

    public function insertData($data)
    {
        if ($this->insert($data)) {
            return true; // Insert successful
        } else {
            return false; // Insert failed
        }
    }
}
