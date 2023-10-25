<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Building;

class BuildingController extends BaseController
{
    protected $buildingModel;

    public function __construct()
    {
        $this->buildingModel = new Building();
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Building',
        ];

        return view('pages/admin/building', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'building', 'created_at'];

        $db = db_connect();

        $query = "SELECT id, building, created_at FROM tbl_building WHERE is_deleted = 'no'";

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (building LIKE "%' . $request->getPost('search')['value'] . '%"
                OR created_at LIKE "%' . $request->getPost('search')['value'] . '%" )
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
        $query = "SELECT id, building, created_at FROM tbl_building WHERE is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function addBuilding()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_building' => 'required',
        ], [
            'add_building' => [
                'required' => 'Building Name required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $buildingModel = new Building();
            $building = $this->request->getVar('add_building');

            if (!$buildingModel->buildingExist($building, 0)) {
                $insert = $buildingModel->insert([
                    'building' => $building,
                ]);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Building added successfully'];
                } else {
                    $response = ['status' => 'error', 'message' => ['add_building' => 'Something went wrong.']];
                }
            } else {
                $response = ['status' => 'error', 'message' => ['add_building' => 'Building Name already exists in system.']];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getBuildingData()
    {
        $id = $this->request->getVar('id');
        $buildingModel = new Building();
        $buildingData = $buildingModel->getDataById($id);

        $data = [
            'edit_building_id' => $buildingData->id,
            'edit_building' => ucwords($buildingData->building),
        ];

        return $this->response->setJSON(['status' => 'success', 'message' => $data]);
    }

    public function editBuilding()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_building' => 'required',
        ], [
            'edit_building' => [
                'required' => 'Building Name required.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $id = $this->request->getVar('edit_building_id');
            $newBuilding = $this->request->getVar('edit_building');

            if (!$this->buildingModel->buildingExist($newBuilding, $id)) {
                $update = $this->buildingModel->updateData($id, ['building' => $newBuilding]);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Building updated successfully.'];
                }
            } else {
                $response = ['status' => 'error', 'message' => ['edit_building' => 'Building Name already exists in system.']];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteBuilding()
    {
        $id = $this->request->getVar('id');

        if ($this->buildingModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Building deleted successfully.'];
        }

        return $this->response->setJSON($response);
    }
}
