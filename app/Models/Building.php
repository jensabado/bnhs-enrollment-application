<?php

namespace App\Models;

use CodeIgniter\Model;

class Building extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_building';
    protected $allowedFields    = ['id', 'building', 'is_deleted'];
}
