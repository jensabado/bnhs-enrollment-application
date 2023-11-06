<?php

namespace App\Controllers;

use App\Models\Day;
use App\Models\Section;
use App\Models\GradeLevel;
use App\Libraries\Sanitize;
use App\Controllers\BaseController;
use App\Models\ClassroomSchedule;
use App\Models\Subject;
use App\Models\Teacher;

class ClassroomScheduleController extends BaseController
{
    public function classroomSchedule()
    {
        $dayModel = new Day();
        $gradeLevelModel = new GradeLevel();

        $data = [
            'pageTitle' => 'Classroom Schedule',
            'dayData' => $dayModel->getAllData(),
            'gradeLevelData' => $gradeLevelModel->getAllData(),
        ];

        return view('pages/admin/classroom-schedule', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'grade', 'section', 'start_time', 'day', 'subject', 'teacher', 'teacher', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_classroom_schedule.id, tbl_grade_level.grade, tbl_section.section, tbl_classroom_schedule.start_time, tbl_classroom_schedule.end_time, tbl_days.`name`, tbl_subject.`subject`, tbl_teacher.f_name, tbl_teacher.l_name, tbl_classroom_schedule.created_at, tbl_classroom_schedule.day_id
        FROM tbl_classroom_schedule
        LEFT JOIN tbl_section
        ON tbl_classroom_schedule.section_id = tbl_section.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        LEFT JOIN tbl_days
        ON tbl_classroom_schedule.day_id = tbl_days.id
        LEFT JOIN tbl_subject
        ON tbl_classroom_schedule.subject_id = tbl_subject.id
        LEFT JOIN tbl_teacher
        ON tbl_classroom_schedule.teacher_id = tbl_teacher.id
        WHERE tbl_classroom_schedule.is_deleted = 'no'";

        if ($request->getPost('filter_grade') != '') {
            $query .= ' AND tbl_classroom_schedule.grade_level_id = "' . $request->getPost('filter_grade') . '"';
        }

        if ($request->getPost('filter_section') != '') {
            $query .= ' AND tbl_classroom_schedule.section_id = "' . $request->getPost('filter_section') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_grade_level.grade LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_section.section LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher.f_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher.l_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_classroom_schedule.start_time LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_classroom_schedule.end_time LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_days.`name` LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_subject.`subject` LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_classroom_schedule.created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
                ';
        }

        if ($request->getPost('order')) {
            $query .= 'ORDER BY ' . $column[$request->getPost('order')[0]['column']] . ' ' . $request->getPost('order')[0]['dir'] . ' ';
        } else {
            $query .= 'ORDER BY id DESC ';
        }

        $query1 = '';

        if ($request->getPost('length') != -1) {
            $query1 = 'LIMIT ' . $request->getPost('start') . ', ' . $request->getPost('length');
        }

        $statement = $db->query($query);
        $number_filter_row = $statement->getNumRows();

        $query .= $query1;
        $statement = $db->query($query);
        $result = $statement->getResult('array');

        $data = [];

        $count = ($request->getPost('start') / $request->getPost('length')) * $request->getPost('length') + 1;

        foreach ($result as $row) {
            $sub_array = [];
            $sub_array[] = $count++;
            $sub_array[] = ucwords($row['grade']);
            $sub_array[] = ucwords($row['section']);
            $sub_array[] = date('h:i A', strtotime($row['start_time'])) . ' - ' . date('h:i A', strtotime($row['end_time']));
            $sub_array[] = ucwords($row['day_id']);
            $sub_array[] = ucwords($row['name']);
            $sub_array[] = ucwords($row['subject']);
            $sub_array[] = ucwords($row['f_name'] . ' ' . $row['l_name']);
            $sub_array[] = $row['created_at'];
            $sub_array[] = '<div class="btn-group">
                                <button class="btn btn-primary btn-sm get_edit" data-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm get_delete" data-id="' . $row['id'] . '"><i class="bi bi-trash2-fill"></i></button>
                            </div>';
            $data[] = $sub_array;
        }

        $output = [
            'draw' => (int) $request->getPost('draw'),
            'recordsTotal' => $this->countAllData($db),
            'recordsFiltered' => $number_filter_row,
            'data' => $data,
        ];

        return json_encode($output);
    }

    private function countAllData($db)
    {
        $query = "SELECT tbl_classroom_schedule.id, tbl_grade_level.grade, tbl_section.section, tbl_classroom_schedule.start_time, tbl_classroom_schedule.end_time, tbl_days.`name`, tbl_subject.`subject`, tbl_teacher.f_name, tbl_teacher.l_name, tbl_classroom_schedule.created_at, tbl_classroom_schedule.day_id
        FROM tbl_classroom_schedule
        LEFT JOIN tbl_section
        ON tbl_classroom_schedule.section_id = tbl_section.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        LEFT JOIN tbl_days
        ON tbl_classroom_schedule.day_id = tbl_days.id
        LEFT JOIN tbl_subject
        ON tbl_classroom_schedule.subject_id = tbl_subject.id
        LEFT JOIN tbl_teacher
        ON tbl_classroom_schedule.teacher_id = tbl_teacher.id
        WHERE tbl_classroom_schedule.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function getSectionOption()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $sectionModel = new Section();

        if ($sectionModel->getSectionsByGrade($id)) {
            $response = ['status' => 'success', 'message' => $sectionModel->getSectionsByGrade($id)];
        } else {
            $response = ['status' => 'error', 'message' => 'No Section Found'];
        }

        return $this->response->setJSON($response);
    }

    public function getSubjectOption()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $subjectModel = new Subject();

        if ($subjectModel->getSubjectsByGrade($id)) {
            $response = ['status' => 'success', 'message' => $subjectModel->getSubjectsByGrade($id)];
        } else {
            $response = ['status' => 'error', 'message' => 'No Subject Found'];
        }

        return $this->response->setJSON($response);
    }

    public function getTeacherOption()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $teacherModel = new Teacher();

        if ($teacherModel->getTeachersBySubject($id)) {
            $response = ['status' => 'success', 'message' => $teacherModel->getTeachersBySubject($id)];
        } else {
            $response = ['status' => 'error', 'message' => 'No Teacher Found'];
        }

        return $this->response->setJSON($response);
    }

    public function addClassroomSchedule()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_grade' => 'required',
            'add_section' => 'required',
            'add_start_time' => 'required',
            'add_end_time' => 'required',
            'add_day' => 'required',
            'add_subject' => 'required',
            'add_teacher' => 'required',
        ], [
            'add_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'add_section' => [
                'required' => 'Select Section first.',
            ],
            'add_start_time' => [
                'required' => 'Start time is required.',
            ],
            'add_end_time' => [
                'required' => 'End time is required.',
            ],
            'add_day' => [
                'required' => 'Select Day first.',
            ],
            'add_subject' => [
                'required' => 'Select Subject first.',
            ],
            'add_teacher' => [
                'required' => 'Select Teacher first.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $classroomScheduleModel = new ClassroomSchedule();
            $grade = Sanitize::sanitize($this->request->getPost('add_grade'));
            $section = Sanitize::sanitize($this->request->getPost('add_section'));
            $start_time = Sanitize::sanitize($this->request->getPost('add_start_time'));
            $end_time = Sanitize::sanitize($this->request->getPost('add_end_time'));
            $day = Sanitize::sanitize($this->request->getPost('add_day'));
            $subject = Sanitize::sanitize($this->request->getPost('add_subject'));
            $teacher = Sanitize::sanitize($this->request->getPost('add_teacher'));

            if (!$classroomScheduleModel->classroomScheduleExists($grade, $subject, $day, 0)) {
                $data = [
                    'grade_level_id' => $grade,
                    'section_id' => $section,
                    'teacher_id' => $teacher,
                    'subject_id' => $subject,
                    'day_id' => $day,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ];

                $insert = $classroomScheduleModel->insertData($data);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Classroom Schedule added successfully.'];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.'];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Classroom Schedule already exists in system.'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getClassroomScheduleData()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $classroomScheduleModel = new ClassroomSchedule();

        $classroomScheduleData = $classroomScheduleModel->getDataById($id);

        $data = [
            'edit_id' => $classroomScheduleData->id,
            'edit_grade' => $classroomScheduleData->grade_level_id,
            'edit_section' => $classroomScheduleData->section_id,
            'edit_start_time' => $classroomScheduleData->start_time,
            'edit_end_time' => $classroomScheduleData->end_time,
            'edit_day' => $classroomScheduleData->day_id,
            'edit_subject' => $classroomScheduleData->subject_id,
            'edit_teacher' => $classroomScheduleData->teacher_id,
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
    }

    public function editClassroomSchedule()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_grade' => 'required',
            'edit_section' => 'required',
            'edit_start_time' => 'required',
            'edit_end_time' => 'required',
            'edit_day' => 'required',
            'edit_subject' => 'required',
            'edit_teacher' => 'required',
        ], [
            'edit_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'edit_section' => [
                'required' => 'Select Section first.',
            ],
            'edit_start_time' => [
                'required' => 'Start time is required.',
            ],
            'edit_end_time' => [
                'required' => 'End time is required.',
            ],
            'edit_day' => [
                'required' => 'Select Day first.',
            ],
            'edit_subject' => [
                'required' => 'Select Subject first.',
            ],
            'edit_teacher' => [
                'required' => 'Select Teacher first.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $classroomScheduleModel = new ClassroomSchedule();
            $id = Sanitize::sanitize($this->request->getPost('edit_id'));
            $grade = Sanitize::sanitize($this->request->getPost('edit_grade'));
            $section = Sanitize::sanitize($this->request->getPost('edit_section'));
            $start_time = Sanitize::sanitize($this->request->getPost('edit_start_time'));
            $end_time = Sanitize::sanitize($this->request->getPost('edit_end_time'));
            $day = Sanitize::sanitize($this->request->getPost('edit_day'));
            $subject = Sanitize::sanitize($this->request->getPost('edit_subject'));
            $teacher = Sanitize::sanitize($this->request->getPost('edit_teacher'));

            if (!$classroomScheduleModel->classroomScheduleExists($grade, $subject, $day, $id)) {
                $data = [
                    'grade_level_id' => $grade,
                    'section_id' => $section,
                    'teacher_id' => $teacher,
                    'subject_id' => $subject,
                    'day_id' => $day,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ];

                $update = $classroomScheduleModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Subject Schedule updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Subject Schedule already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteClassroomSchedule()
    {
        $id = $this->request->getVar('id');
        $classroomScheduleModel = new ClassroomSchedule();

        if ($classroomScheduleModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Subject Schedule deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }

    public function getPrint($id)
    {
        $sectionModel = new Section();
        $classroomScheduleModel = new ClassroomSchedule();

        if($sectionModel->idExist($id)) {
            $data = [
                'pageTitle' => 'Section Schedule',
                'id' => $id,
                'schedHeader' => $classroomScheduleModel->schedHeader($id),
                'schedules' => $classroomScheduleModel->schedule($id),
            ];
    
            return view('pages/admin/classroom-schedule-print', $data);
        } else {
            return redirect()->route('admin.classroom-schedule');
        }
    }
}