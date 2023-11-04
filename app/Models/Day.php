<?php

namespace App\Models;

use CodeIgniter\Model;

class Day extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_days';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name'];

    public function getAllData()
    {
        return $this->asObject()
            ->orderBy('id', 'asc')
            ->findAll();
    }
}
