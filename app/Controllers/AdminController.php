<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\Admin;

class AdminController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Admin Home'
        ];

        return view('pages/admin/home', $data);
    }

    public function login()
    {
        $data = [
            'pageTitle' => 'Admin Login'
        ];

        return view('pages/admin/auth/login', $data);
    }

    public function loginHandler() 
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]|max_length[40]'
        ], [
            'email' => [
                'required' => 'Email is required',
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters long.',
                'max_length' => 'Password must not exceed 40 characters in length.',
            ]
        ]);

        if(!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $adminModel = new Admin();
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            if($adminModel->emailExist($email)) {
                $adminData = $adminModel->getDataByEmail($email);

                if(Hash::check($password, $adminData->password)) {
                    CIAuth::setCIAuthAdmin($adminData);
                    $response = ['status' => 'success'];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Sorry, the password you entered is incorrect. Please double-check your password and try again.'];
                }
            } else {
                $response = ['status'=> 'error','message'=> ['email' => 'Email not exists in system.']];
            }
        }

        return $this->response->setJSON($response);
    }

    public function logout()
    {
        CIAuth::forgetAdmin();
        return redirect()->route('admin.login');
    }
}
