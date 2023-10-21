<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_admin';
    protected $allowedFields = ['id', 'name', 'email', 'password', 'type', 'status', 'is_deleted'];

    public function emailExist($email)
    {
        return $this->table($this->table)
            ->where('email', $email)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }

    public function getDataByEmail($email)
    {
        return $this->table($this->table)
            ->where('email', $email)
            ->where('is_deleted', 'no')
            ->get()
            ->getRow();
    }
}
