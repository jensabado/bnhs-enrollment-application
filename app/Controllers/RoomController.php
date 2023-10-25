<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Building;
use App\Models\Room;

class RoomController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function room()
    {
        $buildingModel = new Building();

        $data = [
            'pageTitle' => 'Room',
            'buildingData' => $buildingModel->getAllData(),
        ];

        return view('pages/admin/room', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'building', 'room', 'created_at'];

        $db = db_connect();

        $query = "SELECT tbl_room.id, tbl_building.building, tbl_room.room, tbl_room.created_at
            FROM tbl_room
            LEFT JOIN tbl_building
            ON tbl_room.building_id = tbl_building.id
            WHERE tbl_building.is_deleted = 'no' AND tbl_room.is_deleted = 'no'";

        if ($request->getPost('filter_building') != '') {
            $query .= ' AND tbl_room.building_id = "' . $request->getPost('filter_building') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (tbl_room.id LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_building.building LIKE "%' . $request->getPost('search')['value'] . '%"
                OR tbl_room.room LIKE "%' . $request->getPost('search')['value'] . '%" )
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
            $sub_array[] = ucwords($row['room']);
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
        $query = "SELECT tbl_room.id, tbl_building.building, tbl_room.room, tbl_room.created_at
        FROM tbl_room
        LEFT JOIN tbl_building
        ON tbl_room.building_id = tbl_building.id
        WHERE tbl_building.is_deleted = 'no' AND tbl_room.is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function addRoom()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_building' => 'required',
            'add_room' => 'required',
        ], [
            'add_building' => [
                'required' => 'Select Building first.',
            ],
            'add_room' => [
                'required' => 'Room Name is required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $roomModel = new Room();
            $building_id = $this->request->getVar('add_building');
            $room = $this->request->getVar('add_room');
            $id = 0;

            if (!$roomModel->roomExist($building_id, $room, $id)) {
                $insert = $roomModel->insert([
                    'building_id' => $building_id,
                    'room' => $room,
                ]);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Room added successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Room already exist.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getRoomData()
    {
        $id = $this->request->getVar('id');
        $roomModel = new Room();

        $roomData = $roomModel->getDataById($id);

        $data = [
            'edit_id' => $roomData->id,
            'edit_building' => $roomData->building_id,
            'edit_room' => ucwords($roomData->room),
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
    }

    public function editRoom()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_building' => 'required',
            'edit_room' => 'required',
        ], [
            'edit_building' => [
                'required' => 'Select Building first.',
            ],
            'edit_room' => [
                'required' => 'Room Name required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $roomModel = new Room();
            $id = $this->request->getVar('edit_id');
            $building_id = $this->request->getVar('edit_building');
            $room = $this->request->getVar('edit_room');

            if (!$roomModel->roomExist($building_id, $room, $id)) {
                $data = [
                    'building_id' => $building_id,
                    'room' => $room,
                ];

                $update = $roomModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Room updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error_alert', 'message' => 'Room already exists in system.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteRoom()
    {
        $id = $this->request->getVar('id');
        $roomModel = new Room();

        if ($roomModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Room deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }
}
