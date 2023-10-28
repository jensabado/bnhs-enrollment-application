<?php

namespace App\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\GradeLevel;
use App\Libraries\Sanitize;
use App\Models\TeacherSubject;
use App\Controllers\BaseController;

class TeacherSubjectController extends BaseController
{
    public function teacherSubject()
    {
        $gradeLevelModel = new GradeLevel();
        $teacherModel = new Teacher();

        $data = [
            'pageTitle' => 'Teacher Subject',
            'gradeLevelData' => $gradeLevelModel->getAllData(),
            'teacherData' => $teacherModel->getAllData(),
        ];

        return view('pages/admin/teacher-subject', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'name', 'grade', 'subject', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_teacher_subject.id, tbl_teacher.f_name, tbl_teacher.l_name, tbl_grade_level.grade, tbl_subject.`subject`, tbl_teacher_subject.created_at
        FROM tbl_teacher_subject
        LEFT JOIN tbl_teacher
        ON tbl_teacher_subject.teacher_id = tbl_teacher.id
        LEFT JOIN tbl_subject
        ON tbl_teacher_subject.subject_id = tbl_subject.id
        LEFT JOIN tbl_grade_level
        ON tbl_subject.grade_level_id = tbl_grade_level.id
        WHERE tbl_teacher_subject.is_deleted = 'no'";

        if ($request->getPost('filter_grade') != '') {
            $query .= ' AND tbl_teacher_subject.grade_level_id = "' . $request->getPost('filter_grade') . '"';
        }

        if ($request->getPost('filter_subject') != '') {
            $query .= ' AND tbl_teacher_subject.subject_id = "' . $request->getPost('filter_subject') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_teacher.f_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher.l_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_grade_level.grade LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_subject.`subject` LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher_subject.created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
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
            $sub_array[] = ucwords($row['f_name'] . ' ' . $row['l_name']);
            $sub_array[] = ucwords($row['grade']);
            $sub_array[] = ucwords($row['subject']);
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
        $query = "SELECT tbl_teacher_subject.id, tbl_teacher.f_name, tbl_teacher.l_name, tbl_grade_level.grade, tbl_subject.`subject`, tbl_teacher_subject.created_at
        FROM tbl_teacher_subject
        LEFT JOIN tbl_teacher
        ON tbl_teacher_subject.teacher_id = tbl_teacher.id
        LEFT JOIN tbl_subject
        ON tbl_teacher_subject.subject_id = tbl_subject.id
        LEFT JOIN tbl_grade_level
        ON tbl_subject.grade_level_id = tbl_grade_level.id
        WHERE tbl_teacher_subject.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
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

    public function addTeacherSubject()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_teacher' => 'required',
            'add_grade' => 'required',
            'add_subject' => 'required',
        ], [
            'add_teacher' => [
                'required' => 'Select Teacher first.',
            ],
            'add_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'add_subject' => [
                'required' => 'Select Subject first.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $teacherSubjectModel = new TeacherSubject();
            $teacher = Sanitize::sanitize($this->request->getPost('add_teacher'));
            $grade = Sanitize::sanitize($this->request->getPost('add_grade'));
            $subject = Sanitize::sanitize($this->request->getPost('add_subject'));

            if(!$teacherSubjectModel->teacherSubjectExists($grade, $subject, 0)) {
                $data = [
                    'teacher_id' => $teacher,
                    'grade_level_id' => $grade,
                    'subject_id' => $subject,
                ];

                $insert = $teacherSubjectModel->insertTeacherSubject($data);


                if($insert) {
                    $response = ['status' => 'success', 'message' => 'Teacher Subject added successfully.'];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.'];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Teacher Subject already exists in system.'];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getTeacherSubjectData()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $teacherSubjectModel = new TeacherSubject();

        $teacherSubjectData = $teacherSubjectModel->getDataById($id);

        $data = [
            'edit_id' => $teacherSubjectData->id,
            'edit_teacher' => $teacherSubjectData->teacher_id,
            'edit_grade' => $teacherSubjectData->grade_level_id,
            'edit_subject' => $teacherSubjectData->subject_id,
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
    }

    public function editTeacherSubject()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_teacher' => 'required',
            'edit_grade' => 'required',
            'edit_subject' => 'required',
        ], [
            'edit_teacher' => [
                'required' => 'Select Teacher first.',
            ],
            'edit_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'edit_subject' => [
                'required' => 'Select Subject first.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $teacherSubjectModel = new TeacherSubject();
            $id = Sanitize::sanitize($this->request->getPost('edit_id'));
            $grade = Sanitize::sanitize($this->request->getPost('edit_grade'));
            $teacher = Sanitize::sanitize($this->request->getPost('edit_teacher'));
            $subject = Sanitize::sanitize($this->request->getPost('edit_subject'));

            if (!$teacherSubjectModel->teacherSubjectExists($grade, $subject, $id)) {
                $data = [
                    'teacher_id' => $teacher,
                    'grade_level_id' => $grade,
                    'subject_id' => $subject,
                ];

                $update = $teacherSubjectModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Teacher Subject updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Teacher Subject already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteTeacherSubject()
    {
        $id = $this->request->getVar('id');
        $teacherSubjectModel = new TeacherSubject();

        if ($teacherSubjectModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Teacher Subject deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }
}
