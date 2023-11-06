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

    public function getAllData()
    {
        $builder = $this->db->table('tbl_building')
        ->select('id, building')
        ->where('is_deleted', 'no');

        $query = $builder->get();

        if($query->getNumRows() > 0) {
            $results = $query->getResult();
        } else {
            $results = null;
        }

        return $results;
    }

    public function buildingCount()
    {
        return $this->where('is_deleted', 'no')->countAllResults();
    }
}
