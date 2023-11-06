<?php

namespace App\Controllers;

use App\Models\Room;
use App\Models\Admin;
use App\Libraries\Hash;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Building;
use App\Libraries\CIAuth;
use App\Controllers\BaseController;
use App\Models\Subject;

class AdminController extends BaseController
{
    protected $db;
    protected $helpers = ['CIFunctions'];

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $buildingModel = new Building();
        $roomModel = new Room();
        $sectionModel = new Section();
        $teacherModel = new Teacher();
        $subjectModel = new Subject();

        $data = [
            'pageTitle' => 'Admin Home',
            'buildingCount' => $buildingModel->buildingCount(),
            'roomCount' => $roomModel->roomCount(),
            'sectionCount' => $sectionModel->sectionCount(),
            'teacherCount' => $teacherModel->teacherCount(),
            'grade7SubjectCount' => $subjectModel->grade7SubjectCount(),
            'grade8SubjectCount' => $subjectModel->grade8SubjectCount(),
            'grade9SubjectCount' => $subjectModel->grade9SubjectCount(),
            'grade10SubjectCount' => $subjectModel->grade10SubjectCount(),
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

                    if(!empty($this->request->getPost('remember'))) {
                        setcookie('bnhsAdminEmail', $email, time() + (10 * 365 * 24 * 60 * 60));
                        setcookie('bnhsAdminPass', $password, time() + (10 * 365 * 24 * 60 * 60));
                    } else {
                        setcookie('bnhsAdminEmail', '');
                        setcookie('bnhsAdminPass', '');
                    }

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
