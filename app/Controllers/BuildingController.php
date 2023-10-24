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
        $buildingModel = new Building();

        $request = service('request');
        $postData = $request->getPost();

        $columns = ['id', 'building', 'created_at'];

        $query = $buildingModel->table('tbl_building')
            ->select('id, building, created_at')
            ->where('is_deleted', 'no');

        if (!empty($postData['search']['value'])) {
            $query->groupStart()
                ->like('building', $postData['search']['value'])
                ->orLike('created_at', $postData['search']['value'])
                ->groupEnd();
        }

        if (!empty($postData['order'])) {
            $orderColumn = $columns[$postData['order'][0]['column']];
            $orderDirection = $postData['order'][0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
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
                $row['created_at'],
                '<div class="btn-group">
                    <button class="btn btn-primary btn-sm get_edit" data-id="' . $row['id'] . '"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger btn-sm get_delete" data-id="' . $row['id'] . '"><i class="bi bi-trash2-fill"></i></button>
                </div>',
            ];
            $data[] = $subArray;
        }

        // Get the total records count
        $totalRecords = $buildingModel->table('tbl_building')
            ->select('id, building, created_at')
            ->where('is_deleted', 'no')
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
