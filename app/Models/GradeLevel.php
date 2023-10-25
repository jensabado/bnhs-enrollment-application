<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeLevel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_grade_level';
    protected $allowedFields    = ['id', 'grade', 'is_deleted'];

    public function getAllData()
    {
        $query = $this->table($this->table)
        ->where('is_deleted', 'no')
        ->orderBy('id', 'ASC')
        ->get();

        if($query->getNumRows() > 0) {
            $results = $query->getResult();
        } else {
            $results = null;
        }

        return $results;
    }
}
