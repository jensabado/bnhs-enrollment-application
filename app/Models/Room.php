<?php

namespace App\Models;

use CodeIgniter\Model;

class Room extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rooms';
    protected $allowedFields    = ['id', 'building_id', 'room', 'created_at'];

    
}
