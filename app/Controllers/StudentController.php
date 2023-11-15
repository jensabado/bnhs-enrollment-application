<?php

namespace App\Controllers;

use App\Libraries\Hash;
use App\Models\Student;
use App\Libraries\CIAuth;
use App\Controllers\BaseController;

class StudentController extends BaseController
{
    public function index()
    {
        return view('pages/student/home');
    }

    public function login()
    {
        return view('pages/student/auth/login', [
            'pageTitle' => 'Student Login'
        ]);
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
            $studentModel = new Student();
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if($studentModel->emailExist($email)) {
                $studentData = $studentModel->getStudentByEmail($email);

                if(in_array($studentData->status, [0, 3, 6, 9])) {
                    $response = ['status' => 'error_alert', 'message' => 'Sorry, your enrollment application is still pending. Please wait for an email confirmation.'];
                } else if(in_array($studentData->status, [2, 5, 8])) {
                    $grade = '';
                    if($studentData->status == 2) {
                        $grade = 8;
                    } else if($studentData->status == 5) {
                        $grade = 9;
                    } else if($studentData->status == 8) {
                        $grade = 10;
                    }

                    $response = ['status' => 'error_alert', 'message' => 'You\'re now candidate for Grade ' . $grade . '. Register now for Old Student.'];
                } else if(in_array($studentData->status, [1, 4, 7, 10])) {
                    if(Hash::check($password, $studentData->password)) {
                        CIAuth::setCIAuthStudent($studentData);
    
                        if(!empty($this->request->getPost('remember'))) {
                            setcookie('bnhsStudentEmail', $email, time() + (10 * 365 * 24 * 60 * 60));
                            setcookie('bnhsStudentPass', $password, time() + (10 * 365 * 24 * 60 * 60));
                        } else {
                            setcookie('bnhsStudentEmail', '');
                            setcookie('bnhsStudentPass', '');
                        }
    
                        $response = ['status' => 'success'];
                    } else {
                        $response = ['status' => 'error_alert', 'message' => 'Sorry, the password you entered is incorrect. Please double-check your password and try again.'];
                    }
                }
            } else {
                $response = ['status'=> 'error','message'=> ['email' => 'Email not exists in system.']];
            }
        }

        return $this->response->setJSON($response);
    }
}
