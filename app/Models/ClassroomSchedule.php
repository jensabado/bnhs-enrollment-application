<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassroomSchedule extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_classroom_schedule';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id', 'grade_level_id', 'section_id', 'teacher_id', 'subject_id', 'day_id', 'start_time', 'end_time', 'is_deleted', 'created_at'];

    public function classroomScheduleExists($grade, $subject, $day, $id)
    {
        return $this->where('grade_level_id', $grade)
            ->where('subject_id', $subject)
            ->where('day_id', $day)
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

    public function getDataById($id)
    {
        return $this->table($this->table)
            ->where('id', $id)
            ->where('is_deleted', 'no')
            ->get()->getRow();
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
}
