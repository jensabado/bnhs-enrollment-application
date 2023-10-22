<?php

namespace App\Models;

use CodeIgniter\Model;

class Building extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_building';
    protected $allowedFields = ['id', 'building', 'is_deleted'];

    public function buildingExist($building, $id)
    {
        return $this->table($this->table)
            ->where('building', $building)
            ->where('id !=', $id)
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
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        $builder->set(['is_deleted' => 'yes']);

        if ($builder->update()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }
}
