<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Building;
use App\Models\GradeLevel;
use App\Models\Room;
use App\Models\Section;

class SectionController extends BaseController
{
    public function section()
    {
        $gradeLevelModel = new GradeLevel();
        $buildingModel = new Building();
        $roomModel = new Room();

        $data = [
            'pageTitle' => 'Section',
            'gradeLevelData' => $gradeLevelModel->getAllData(),
            'buildingData' => $buildingModel->getAllData(),
            'roomData' => $roomModel->getAllData(),
        ];

        return view('pages/admin/section', $data);
    }

    public function getRoomOption()
    {
        $id = $this->request->getVar('building');
        $roomModel = new Room();

        if ($roomModel->getDataByBuildingId($id)) {
            $response = ['status' => 'success', 'message' => $roomModel->getDataByBuildingId($id)];
        } else {
            $response = ['status' => 'error', 'message' => 'No Room Found'];
        }

        return $this->response->setJSON($response);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'building', 'grade', 'room', 'section', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_section.id, tbl_building.building, tbl_grade_level.grade, tbl_room.room, tbl_section.section, tbl_section.created_at
        FROM tbl_section
        LEFT JOIN tbl_room
        ON tbl_section.room_id = tbl_room.id
        LEFT JOIN tbl_building
        ON tbl_room.building_id = tbl_building.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        WHERE tbl_section.is_deleted = 'no' AND tbl_building.is_deleted = 'no' AND tbl_room.is_deleted = 'no'";

        if ($request->getPost('filter_building') != '') {
            $query .= ' AND tbl_section.building_id = "' . $request->getPost('filter_building') . '"';
        }

        if ($request->getPost('filter_grade') != '') {
            $query .= ' AND tbl_section.grade_level_id = "' . $request->getPost('filter_grade') . '"';
        }

        if ($request->getPost('filter_room') != '') {
            $query .= ' AND tbl_section.room_id = "' . $request->getPost('filter_room') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_building.building LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_grade_level.grade LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_room.room LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_section.section LIKE "%' . $request->getPost('search')['value'] . '%" )
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
            $sub_array[] = ucwords($row['building']);
            $sub_array[] = ucwords($row['grade']);
            $sub_array[] = ucwords($row['room']);
            $sub_array[] = ucwords($row['section']);
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
        $query = "SELECT tbl_section.id, tbl_building.building, tbl_grade_level.grade, tbl_room.room, tbl_section.section, tbl_section.created_at
        FROM tbl_section
        LEFT JOIN tbl_room
        ON tbl_section.room_id = tbl_room.id
        LEFT JOIN tbl_building
        ON tbl_room.building_id = tbl_building.id
        LEFT JOIN tbl_grade_level
        ON tbl_section.grade_level_id = tbl_grade_level.id
        WHERE tbl_section.is_deleted = 'no' AND tbl_building.is_deleted = 'no' AND tbl_room.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function addSection()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_grade_level' => 'required',
            'add_building' => 'required',
            'add_room' => 'required',
            'add_section' => 'required',
        ], [
            'add_grade_level' => [
                'required' => 'Select Grade Level first.',
            ],
            'add_building' => [
                'required' => 'Select Building first.',
            ],
            'add_room' => [
                'required' => 'Select Room first.',
            ],
            'add_section' => [
                'required' => 'Section is required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $sectionModel = new Section();
            $grade_level = $this->request->getVar('add_grade_level');
            $building = $this->request->getVar('add_building');
            $room = $this->request->getVar('add_room');
            $section = $this->request->getVar('add_section');

            if (!$sectionModel->sectionExists($building, $room, $grade_level, $section, 0)) {
                $insert = $sectionModel->insert([
                    'building_id' => $building,
                    'room_id' => $room,
                    'grade_level_id' => $grade_level,
                    'section' => $section,
                ]);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Section added successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Section already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getSectionData()
    {
        $id = $this->request->getVar('id');
        $sectionModel = new Section();

        $sectionData = $sectionModel->getDataById($id);

        $data = [
            'edit_id' => $sectionData->id,
            'edit_building' => $sectionData->building_id,
            'edit_grade_level' => $sectionData->grade_level_id,
            'edit_room' => $sectionData->room_id,
            'edit_section' => ucwords($sectionData->section),
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
    }

    public function editSection()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_grade_level' => 'required',
            'edit_building' => 'required',
            'edit_room' => 'required',
            'edit_section' => 'required',
        ], [
            'edit_grade_level' => [
                'required' => 'Select Grade Level first.',
            ],
            'edit_building' => [
                'required' => 'Select Building first.',
            ],
            'edit_room' => [
                'required' => 'Select Room first.',
            ],
            'edit_section' => [
                'required' => 'Section Name is required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $sectionModel = new Section();
            $id = $this->request->getVar('edit_id');
            $grade_level = $this->request->getVar('edit_grade_level');
            $building = $this->request->getVar('edit_building');
            $room = $this->request->getVar('edit_room');
            $section = $this->request->getVar('edit_section');

            if (!$sectionModel->sectionExists($building, $room, $grade_level, $section, $id)) {
                $data = [
                    'building_id' => $building,
                    'grade_level_id' => $grade_level,
                    'room_id' => $room,
                    'section' => $section,
                ];

                $update = $sectionModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Section updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Section already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteSection()
    {
        $id = $this->request->getVar('id');
        $sectionModel = new Section();

        if ($sectionModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Section deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }
}
