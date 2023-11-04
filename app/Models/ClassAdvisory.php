<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassAdvisory extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_classroom_advisory';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'grade_level_id', 'section_id', 'teacher_id', 'is_deleted', 'created_at'];

    public function classAdvisoryExists($grade, $section, $id)
    {
        return $this->where('section_id', $section)
            ->where('grade_level_id', $grade)
            ->where('id !=', $id)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }

    public function insertClassAdvisory($data)
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
