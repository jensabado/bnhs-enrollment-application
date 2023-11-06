<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'students';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'lrn', 'grade_level_id', 'lastname', 'firstname', 'middle_initial', 'gender', 'date_of_birth', 'address', 'place_of_birth', 'nationality', 'religion', 'civil_status', 'contact_no', 'guardian', 'email', 'parent_contact_no', 'password', 'status', 'reason', 'is_deleted', 'created_at'];

    public function grade7StudentCount()
    {
        return $this->where('is_deleted', 'no')
        ->where('status', 1)
        ->countAllResults();
    }
}
