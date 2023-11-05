<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassroomSchedule extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_classroom_schedule';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'grade_level_id', 'section_id', 'teacher_id', 'subject_id', 'day_id', 'start_time', 'end_time', 'is_deleted', 'created_at'];

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

    public function schedHeader($id)
    {
        return $this->select('tbl_grade_level.grade, tbl_section.section, tbl_building.building, tbl_room.room, tbl_teacher.f_name, tbl_teacher.l_name')
            ->join('tbl_section', 'tbl_classroom_schedule.section_id = tbl_section.id', 'left')
            ->join('tbl_grade_level', 'tbl_section.grade_level_id = tbl_grade_level.id', 'left')
            ->join('tbl_building', 'tbl_section.building_id = tbl_building.id', 'left')
            ->join('tbl_room', 'tbl_section.room_id = tbl_room.id', 'left')
            ->join('tbl_classroom_advisory', 'tbl_classroom_schedule.section_id = tbl_classroom_advisory.section_id', 'left')
            ->join('tbl_teacher', 'tbl_classroom_advisory.teacher_id = tbl_teacher.id', 'left')
            ->where('tbl_classroom_schedule.section_id', $id)
            ->where('tbl_classroom_schedule.is_deleted', 'no')
            ->groupBy('tbl_classroom_schedule.section_id')
            ->findAll();
    }

    public function schedule($id)
    {
        return $this->select('tbl_classroom_schedule.id, tbl_classroom_schedule.start_time, tbl_classroom_schedule.end_time, tbl_classroom_schedule.day_id, tbl_subject.subject, tbl_teacher.f_name, tbl_teacher.l_name')
            ->join('tbl_subject', 'tbl_classroom_schedule.subject_id = tbl_subject.id', 'left')
            ->join('tbl_teacher', 'tbl_classroom_schedule.teacher_id = tbl_teacher.id', 'left')
            ->where('tbl_classroom_schedule.section_id', $id)
            ->where('tbl_classroom_schedule.is_deleted', 'no')
            ->orderBy('tbl_classroom_schedule.start_time, tbl_classroom_schedule.day_id')
            ->findAll();
    }
}
