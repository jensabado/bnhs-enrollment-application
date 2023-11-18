<?php

namespace App\Controllers;

use App\Models\Section;
use App\Controllers\BaseController;

class EnrolledController extends BaseController
{
    public function index()
    {
        $sectionModel = new Section();
        
        $data = [
            'pageTitle' => 'Enrolled - Grade 7',
            'sectionData' => $sectionModel->getSectionsByGrade(1),
        ];

        return view('pages/admin/enrolled/grade-7/index', $data);
    }

    public function grade7Datatable()
    {
        $request = service('request');

        $column = ['id', 'lrn', 'firstname', 'gender', 'contact_no', 'email', 'section', 'section_id', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_student.id, tbl_student.lrn, tbl_student.firstname, tbl_student.middle_initial, tbl_student.lastname, tbl_student.gender, tbl_student.contact_no, tbl_student.email, tbl_section.section, tbl_student_section.created_at, tbl_student_section.id as section_id FROM tbl_student LEFT JOIN tbl_student_section ON tbl_student.id = tbl_student_section.student_id AND tbl_student.grade_level_id = tbl_student_section.grade_level_id LEFT JOIN tbl_section ON tbl_student_section.section_id = tbl_section.id WHERE status = 1 AND tbl_student.is_deleted = 0 ";

        if ($request->getPost('filter_section') != '') {
            $query .= ' AND tbl_student_section.section_id = "' . $request->getPost('filter_section') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_student.lrn LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.firstname LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.middle_initial LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.lastname LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.gender LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.contact_no LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.email LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student.section LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_student_section.created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
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
            $name = '';
            if (!empty($row['middle_initial'])) {
                $name = ucwords($row['firstname'] . ' ' . $row['middle_initial'] . '. ' . $row['lastname']);
            } else {
                $name = ucwords($row['firstname'] . ' ' . $row['lastname']);
            }

            $sub_array[] = $count++;
            $sub_array[] = $row['lrn'] ? $row['lrn'] : '';
            $sub_array[] = $name;
            $sub_array[] = strtoupper($row['gender']);
            $sub_array[] = $row['contact_no'];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['section'];
            $sub_array[] = $row['section_id'];
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
        $query = "SELECT tbl_student.id, tbl_student.lrn, tbl_student.firstname, tbl_student.middle_initial, tbl_student.lastname, tbl_student.gender, tbl_student.contact_no, tbl_student.email, tbl_section.section, tbl_student_section.created_at, tbl_student_section.id as section_id FROM tbl_student LEFT JOIN tbl_student_section ON tbl_student.id = tbl_student_section.student_id AND tbl_student.grade_level_id = tbl_student_section.grade_level_id LEFT JOIN tbl_section ON tbl_student_section.section_id = tbl_section.id WHERE status = 1 AND tbl_student.is_deleted = 0 ";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }
}
