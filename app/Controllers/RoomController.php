<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Building;

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
        $db = \Config\Database::connect();
        $request = $this->request;

        $columns = ['id', 'building', 'room', 'created_at'];

        $builder = $db->table('tbl_room')
            ->select('tbl_room.id, tbl_building.building, tbl_room.room, tbl_room.created_at')
            ->join('tbl_building', 'tbl_room.building_id = tbl_building.id', 'left')
            ->where('tbl_building.is_deleted', 'no')
            ->where('tbl_room.is_deleted', 'no');

        if ($request->getPost('search')['value']) {
            $searchValue = $request->getPost('search')['value'];
            $builder->like('tbl_building.building', $searchValue)
                ->orLike('tbl_room.room', $searchValue)
                ->orLike('tbl_room.created_at', $searchValue);
        }

        if ($request->getPost('order')) {
            $orderColumn = $columns[$request->getPost('order')[0]['column']];
            $orderDirection = $request->getPost('order')[0]['dir'];
            $builder->orderBy($orderColumn, $orderDirection);
        } else {
            $builder->orderBy('id', 'DESC');
        }

        $totalFiltered = $builder->countAllResults(false); // Count all filtered rows without limits

        if ($request->getPost('length') != -1) {
            $start = $request->getPost('start');
            $length = $request->getPost('length');
            $builder->limit($length, $start);
        }

        $query = $builder->get();
        $result = $query->getResultArray();

        $data = [];

        $count = $start + 1;

        foreach ($result as $row) {
            $sub_array = [
                $count++,
                ucwords($row['building']),
                ucwords($row['room']),
                $row['created_at'],
                '<div class="btn-group">
                    <button class="btn btn-primary btn-sm get_edit" data-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger btn-sm get_delete" data-id="' . $row['id'] . '"><i class="bi bi-trash2-fill"></i></button>
                </div>',
            ];

            $data[] = $sub_array;
        }

        $output = [
            'draw' => intval($request->getPost('draw')),
            'recordsTotal' => $this->countAllData($db),
            'recordsFiltered' => $totalFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($output);
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
}
