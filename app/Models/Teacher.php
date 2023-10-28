<?php

namespace App\Models;

use CodeIgniter\Model;

class Teacher extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_teacher';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'f_name', 'l_name', 'gender', 'mobile_no', 'avatar', 'email', 'password', 'status', 'is_deleted', 'created_at'];

    public function disableAccount($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $builder->set(['status' => 'disable']);

        if ($builder->update()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    public function enableAccount($id)
    {
        $builder = $this->table($this->table);
        $builder->where('id', $id);
        $builder->set(['status' => 'enable']);

        if ($builder->update()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    public function emailExists($email)
    {
        return $this->where('email', $email)
            ->where('is_deleted', 'no')
            ->countAllResults() > 0 ? true : false;
    }

    public function insertData($data)
    {
        $builder = $this->insert($data);

        if ($builder) {
            return true;
        } else {
            return false;
        }
    }

    public function getTeacherById($id)
    {
        return $this->find($id);
    }
}
