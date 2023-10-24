<?php

namespace App\Models;

use CodeIgniter\Model;

class Room extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_room';
    protected $allowedFields = ['id', 'building_id', 'room', 'created_at', 'is_deleted'];

    public function roomExist($building_id, $room, $id)
    {
        return $this->table($this->table)
            ->where('building_id', $building_id)
            ->where('room', $room)
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
        $builder = $this->table($this->table);
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
