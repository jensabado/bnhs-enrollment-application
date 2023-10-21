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
        $request = \Config\Services::request();
        $draw = intval($request->getVar('draw'));
        $start = intval($request->getVar('start'));
        $length = intval($request->getVar('length'));
        $searchValue = $request->getVar('search[value]');
        $orderColumnIndex = intval($request->getVar('order[0][column]'));
        $orderColumnName = ['id', 'building'][$orderColumnIndex]; // Adjust according to your columns
        $orderDir = $request->getVar('order[0][dir]');

        $query = $this->buildingModel->where('is_deleted', 'no');

        if (!empty($searchValue)) {
            $query->groupStart()
                ->like('id', $searchValue)
                ->orLike('building', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $query->countAllResults(false);

        $query->orderBy($orderColumnName, $orderDir);

        if ($length != -1) {
            $query->limit($length, $start);
        }

        $buildings = $query->findAll();

        $data = [];

        foreach ($buildings as $building) {
            $subArray = [];
            $subArray[] = '#' . $building['id'];
            $subArray[] = ucwords($building['building']);
            $subArray[] = '
            <div class="btn-group">
                <button class="btn btn-primary btn-sm get_edit" data-id="'.$building['id'].'"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger btn-sm"><i class="bi bi-trash2-fill"></i></button>
            </div>
            ';
            $data[] = $subArray;
        }

        $output = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ];

        return $this->response->setJSON($output);
    }
}
