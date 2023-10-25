<?php

namespace App\Controllers;

use App\Models\Subject;
use App\Models\GradeLevel;
use App\Controllers\BaseController;

class SubjectController extends BaseController
{
    public function subject()
    {
        $gradeLevelModel = new GradeLevel();

        $data = [
            'pageTitle' => 'Subject',
            'gradeLevelData' => $gradeLevelModel->getAllData(),
        ];

        return view('pages/admin/subject', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'grade', 'subject', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_subject.id, tbl_grade_level.grade, tbl_subject.subject, tbl_subject.created_at
        FROM tbl_subject
        LEFT JOIN tbl_grade_level
        ON tbl_subject.grade_level_id = tbl_grade_level.id
        WHERE tbl_subject.is_deleted = 'no'";

        if ($request->getPost('filter_grade') != '') {
            $query .= ' AND tbl_subject.grade_level_id = "' . $request->getPost('filter_grade') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_grade_level.grade LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_subject.subject LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_subject.created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
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
        $query = "SELECT tbl_subject.id, tbl_grade_level.grade, tbl_subject.subject
        FROM tbl_subject
        LEFT JOIN tbl_grade_level
        ON tbl_subject.grade_level_id = tbl_grade_level.id
        WHERE tbl_subject.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function addSubject()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_grade' => 'required',
            'add_subject' => 'required',
        ], [
            'add_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'add_subject' => [
                'required' => 'Subject is required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $subjectModel = new Subject();
            $grade = $this->request->getVar('add_grade');
            $subject = $this->request->getVar('add_subject');

            if (!$subjectModel->subjectExists($grade, $subject, 0)) {
                $insert = $subjectModel->insert([
                    'grade_level_id' => $grade,
                    'subject' => $subject,
                ]);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Subject added successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Subject already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getSubjectData()
    {
        $id = $this->request->getVar('id');
        $subjectModel = new Subject();

        $subjectData = $subjectModel->getDataById($id);

        $data = [
            'edit_id' => $subjectData->id,
            'edit_grade' => $subjectData->grade_level_id,
            'edit_subject' => ucwords($subjectData->subject),
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
    }

    public function editSubject()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_grade' => 'required',
            'edit_subject' => 'required',
        ], [
            'edit_grade' => [
                'required' => 'Select Grade Level first.',
            ],
            'edit_subject' => [
                'required' => 'Subject is required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $subjectModel = new Subject();
            $id = $this->request->getVar('edit_id');
            $grade_level = $this->request->getVar('edit_grade');
            $subject = $this->request->getVar('edit_subject');

            if (!$subjectModel->subjectExists($grade_level, $subject, $id)) {
                $data = [
                    'grade_level_id' => $grade_level,
                    'subject' => $subject,
                ];

                $update = $subjectModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Subject updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Subject already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteSubject()
    {
        $id = $this->request->getVar('id');
        $subjectModel = new Subject();

        if ($subjectModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Subject deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }
}