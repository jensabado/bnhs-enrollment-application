<?php

namespace App\Models;

use CodeIgniter\Model;

class Subject extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_subject';
    protected $allowedFields = ['id', 'grade_level_id', 'subject', 'is_deleted', 'created_at'];

    public function subjectExists($grade_level, $subject, $id)
    {
        return $this->table($this->table)
            ->where('id !=', $id)
            ->where('grade_level_id', $grade_level)
            ->where('subject', $subject)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
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

    public function getSubjectsByGrade($grade)
    {
        return $this->asObject()->where('grade_level_id', $grade)
            ->where('is_deleted', 'no')
            ->findAll();
    }

    public function grade7SubjectCount()
    {
        return $this->where('is_deleted', 'no')
        ->where('grade_level_id', 1)
        ->countAllResults();
    }

    public function grade8SubjectCount()
    {
        return $this->where('is_deleted', 'no')
        ->where('grade_level_id', 2)
        ->countAllResults();
    }

    public function grade9SubjectCount()
    {
        return $this->where('is_deleted', 'no')
        ->where('grade_level_id', 3)
        ->countAllResults();
    }

    public function grade10SubjectCount()
    {
        return $this->where('is_deleted', 'no')
        ->where('grade_level_id', 4)
        ->countAllResults();
    }
}
