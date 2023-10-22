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
        $db = \Config\Database::connect();
        $request = $this->request;

        $columns = ['id', 'building', 'created_at'];

        $builder = $db->table('tbl_building')
            ->where('is_deleted', 'no');

        if ($request->getPost('search')['value']) {
            $searchValue = $request->getPost('search')['value'];
            $builder->like('id', $searchValue)
                ->orLike('building', $searchValue);
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
                $row['created_at'],
                '<div class="btn-group">
                    <button class="btn btn-primary btn-sm get_edit" data-id="'.$row['id'].'"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-danger btn-sm get_delete" data-id="'.$row['id'].'"><i class="bi bi-trash2-fill"></i></button>
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
        $query = $db->table('tbl_building')
            ->where('is_deleted', 'no')
            ->countAllResults();

        return $query;
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
            'edit_building' => 'required'
        ], [
            'edit_building' => [
                'required' => 'Building Name required.'
            ]
        ]);

        if(!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $id = $this->request->getVar('edit_building_id');
            $newBuilding = $this->request->getVar('edit_building');

            if(!$this->buildingModel->buildingExist($newBuilding, $id)) {
                $update = $this->buildingModel->updateData($id, ['building' => $newBuilding]);

                if($update) {
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

        if($this->buildingModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Building deleted successfully.'];
        }

        return $this->response->setJSON($response);
    }
}