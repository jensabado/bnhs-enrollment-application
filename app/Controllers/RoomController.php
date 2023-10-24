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
        $roomModel = new Room();

        $request = service('request');
        $postData = $request->getPost();

        $columns = ['id', 'building_name', 'room', 'created_at'];

        $query = $roomModel->table('tbl_room')
            ->select('tbl_room.id, tbl_building.building, tbl_room.room, tbl_room.created_at')
            ->join('tbl_building', 'tbl_room.building_id = tbl_building.id', 'left')
            ->where('tbl_building.is_deleted', 'no')
            ->where('tbl_room.is_deleted', 'no');

        if (!empty($postData['filter_building'])) {
            $query->where('tbl_room.building_id', $postData['filter_building']);
        }

        if (!empty($postData['search']['value'])) {
            $query->groupStart()
                ->like('tbl_room.id', $postData['search']['value'])
                ->orLike('tbl_building.building', $postData['search']['value'])
                ->orLike('tbl_room.room', $postData['search']['value'])
                ->orLike('tbl_room.created_at', $postData['search']['value'])
                ->groupEnd();
        }

        if (!empty($postData['order'])) {
            $orderColumn = $columns[$postData['order'][0]['column']];
            $orderDirection = $postData['order'][0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        } else {
            $query->orderBy('tbl_room.id', 'DESC');
        }

        if ($postData['length'] != -1) {
            $query->limit($postData['length'], $postData['start']);
        }

        $results = $query->get()->getResultArray();

        $data = [];
        $count = $postData['start'] + 1;
        foreach ($results as $row) {
            $subArray = [
                $count++,
                ucwords($row['building']),
                ucwords($row['room']),
                $row['created_at'],
                '<div class="btn-group">
                    <button class="btn btn-primary btn-sm get_edit" data-id="'.$row['id'].'"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger btn-sm get_delete" data-id="'.$row['id'].'"><i class="bi bi-trash2-fill"></i></button>
                </div>',
            ];
            $data[] = $subArray;
        }

        // Get the total records count
        $totalRecords = $roomModel->table('tbl_room')
            ->select('tbl_room.id, tbl_building.building, tbl_room.room')
            ->join('tbl_building', 'tbl_room.building_id = tbl_building.id', 'left')
            ->where('tbl_building.is_deleted', 'no')
            ->where('tbl_room.is_deleted', 'no')
            ->countAllResults();

        // Response data
        $output = [
            'draw' => intval($postData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => count($results),
            'data' => $data,
        ];

        return json_encode($output);
    }

    private function countAllData($db)
    {
        $query = $db->table('tbl_room')
            ->select('tbl_room.id, tbl_building.building, tbl_room.room, tbl_room.created_at')
            ->join('tbl_building', 'tbl_room.building_id = tbl_building.id', 'left')
            ->where('tbl_building.is_deleted', 'no')
            ->where('tbl_room.is_deleted', 'no')
            ->countAllResults();

        return $query;
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
