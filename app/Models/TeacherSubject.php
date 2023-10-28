<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherSubject extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_teacher_subject';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'teacher_id', 'grade_level_id', 'subject_id', 'is_deleted', 'created_at'];

    public function teacherSubjectExists($grade, $subject, $id)
    {
        return $this->where('grade_level_id', $grade)
            ->where('subject_id', $subject)
            ->where('id !=', $id)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }

    public function insertTeacherSubject($data)
    {
        if ($this->insert($data)) {
            return true; // Insert successful
        } else {
            return false; // Insert failed
        }
    }

    public function getDataById($id)
    {
        return $this->table($this->table)
            ->where('id', $id)
            ->where('is_deleted', 'no')
            ->get()->getRow();
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

    public function deleteData($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $builder->set(['is_deleted' => 'yes']);

        if ($builder->update()) {
            return true;
        } else {
            return false;
        }
    }
}