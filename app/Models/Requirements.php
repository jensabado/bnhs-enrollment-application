<?php

namespace App\Models;

use CodeIgniter\Model;

class Requirements extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_requirements';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'student_id', 'video_record', 'pdf_file', 'form_138', 'psa_birth_cert', 'brgy_clearance', 'good_moral', 'guardian_id', 'old_id', 'is_deleted'];

    public function getRequirementsByStudentId($id)
    {
        return $this->asObject()->where('student_id', $id)
        ->where('is_deleted', 'no')
        ->first();
    }
}
