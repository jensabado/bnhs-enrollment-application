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

    public function emailExists($email, $id)
    {
        return $this->where('email', $email)
            ->where('id !=', $id)
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
        return $this->asObject()->find($id);
    }

    public function updateData($id, $data)
    {
        // Attempt to update the record
        $result = $this->update($id, $data);

        // Check if the update was successful
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteData($id)
    {
        $data = [
            'is_deleted' => 'yes',
        ];

        return $this->update($id, $data);
    }

    public function getAllData()
    {
        return $this->asObject()
            ->where('is_deleted', 'no')
            ->where('status', 'enable')
            ->findAll();
    }

    public function getTeachersBySubject($subject)
    {
        return $this->asObject()->select('tbl_teacher.id, f_name, l_name')
            ->join('tbl_teacher_subject', 'tbl_teacher_subject.teacher_id = tbl_teacher.id', 'left')
            ->where('tbl_teacher_subject.subject_id', $subject)
            ->findAll();
    }
}
