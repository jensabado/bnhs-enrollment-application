<?php

namespace App\Controllers;

use App\Models\Section;
use App\Models\Teacher;
use App\Models\GradeLevel;
use App\Libraries\Sanitize;
use App\Controllers\BaseController;

class ClassAdvisoryController extends BaseController
{
    public function classAdvisory()
    {
        $gradeLevelModel = new GradeLevel();
        $teacherModel = new Teacher();
        $data = [
            'pageTitle' => 'Class Advisory',
            'gradeLevelData' => $gradeLevelModel->getAllData(),
            'teacherData' => $teacherModel->getAllData(),
        ];

        return view('pages/admin/class-advisory', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'grade', 'section', 'teacher', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_classroom_advisory.id, tbl_grade_level.grade, tbl_section.section, tbl_teacher.f_name, tbl_teacher.l_name, tbl_classroom_advisory.created_at
        FROM tbl_classroom_advisory
        LEFT JOIN tbl_section
        ON tbl_classroom_advisory.section_id = tbl_section.id
        LEFT JOIN tbl_teacher
        ON tbl_classroom_advisory.teacher_id = tbl_teacher.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        WHERE tbl_section.is_deleted = 'no' AND tbl_classroom_advisory.is_deleted = 'no'";

        // if ($request->getPost('filter_grade') != '') {
        //     $query .= ' AND tbl_subject.grade_level_id = "' . $request->getPost('filter_grade') . '"';
        // }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_grade_level.grade LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_section.section LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher.f_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_teacher.l_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_classroom_advisory.created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
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
        $query = "SELECT tbl_classroom_advisory.id, tbl_grade_level.grade, tbl_section.section, tbl_teacher.f_name, tbl_teacher.l_name, tbl_classroom_advisory.created_at
        FROM tbl_classroom_advisory
        LEFT JOIN tbl_section
        ON tbl_classroom_advisory.section_id = tbl_section.id
        LEFT JOIN tbl_teacher
        ON tbl_classroom_advisory.teacher_id = tbl_teacher.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        WHERE tbl_section.is_deleted = 'no' AND tbl_classroom_advisory.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function getSectionData()
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
}
