<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_student';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'lrn', 'grade_level_id', 'lastname', 'firstname', 'middle_initial', 'gender', 'date_of_birth', 'address', 'place_of_birth', 'nationality', 'religion', 'civil_status', 'contact_no', 'guardian', 'email', 'parent_contact_no', 'password', 'status', 'reason', 'is_deleted', 'created_at'];

    public function grade7StudentCount()
    {
        return $this->where('is_deleted', 'no')
            ->where('status', 1)
            ->countAllResults();
    }

    public function enrolleeExist($grade, $id)
    {
        return $this->where('grade_level_id', $grade)
            ->where('id', $id)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }

    public function getStudentById($id)
    {
        return $this->asObject()->select('tbl_student.*, tbl_grade_level.grade')
            ->join('tbl_grade_level', 'tbl_student.grade_level_id = tbl_grade_level.id', 'left')
            ->where('tbl_student.id', $id)
            ->where('tbl_student.is_deleted', 'no')
            ->first();
    }

    public function getStudentByEmail($email)
    {
        return $this->asObject()->select('tbl_student.*, tbl_grade_level.grade')
            ->join('tbl_grade_level', 'tbl_student.grade_level_id = tbl_grade_level.id', 'left')
            ->where('tbl_student.email', $email)
            ->where('tbl_student.is_deleted', 'no')
            ->first();
    }

    public function updateData($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        $builder->set($data);

        if ($builder->update()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    public function insertData($data)
    {
        $result = $this->db->table($this->table)->insert($data);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function emailExist($email)
    {
        return $this->table($this->table)
            ->where('email', $email)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }
}
