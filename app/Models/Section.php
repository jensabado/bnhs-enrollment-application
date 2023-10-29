<?php

namespace App\Models;

use CodeIgniter\Model;

class Section extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_section';
    protected $allowedFields = ['id', 'building_id', 'room_id', 'grade_level_id', 'section', 'is_deleted', 'created_at'];

    public function sectionExists($building, $room, $grade_level, $section, $id)
    {
        return $this->table($this->table)
            ->where('id !=', $id)
            ->where('building_id', $building)
            ->where('room_id', $room)
            ->where('grade_level_id', $grade_level)
            ->where('section', $section)
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

    public function getSectionsByGrade($grade)
    {
        return $this->asObject()->where('grade_level_id', $grade)
            ->where('is_deleted', 'no')
            ->findAll();
    }
}
