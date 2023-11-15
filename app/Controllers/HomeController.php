<?php

namespace App\Controllers;

use App\Models\Requirements;
use App\Models\Student;

class HomeController extends BaseController
{

    protected $studentModel, $requirementsModel;

    public function __construct()
    {
        $this->studentModel = new Student();
        $this->requirementsModel = new Requirements();
    }
    public function index(): string
    {
        return view('pages/home/home');
    }

    public function login()
    {
        $data = [
            'pageTitle' => 'Login',
        ];

        return view('pages/home/login', $data);
    }

    public function enroll()
    {
        $data = [
            'pageTitle' => 'Enroll',
        ];

        return view('pages/home/enroll', $data);
    }

    public function enrollSubmit()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_new_firstname' => 'required',
            'add_new_lastname' => 'required',
            'add_new_gender' => 'required',
            'add_new_bdate' => 'required',
            'add_new_address' => 'required',
            'add_new_placebirth' => 'required',
            'add_new_nationality' => 'required',
            'add_new_religion' => 'required',
            'add_new_contact' => 'required',
            'add_new_guardian' => 'required',
            'add_new_email' => 'required',
            'add_new_guardian_contact' => 'required',
            'add_new_video' => 'required|valid_url|mediafire_url[add_new_video]',
            'add_new_pdf_file' => 'uploaded[add_new_pdf_file]|ext_in[add_new_pdf_file,pdf]',
            'add_new_form_138' => 'uploaded[add_new_form_138]|ext_in[add_new_form_138,pdf,png,docs,docx,jepg,jpg]',
            'add_new_psa' => 'uploaded[add_new_psa]|ext_in[add_new_psa,pdf,png,docs,docx,jepg,jpg]',
            'add_new_brgy_clearance' => 'uploaded[add_new_brgy_clearance]|ext_in[add_new_brgy_clearance,pdf,png,docs,docx,jepg,jpg]',
            'add_new_good_moral' => 'uploaded[add_new_good_moral]|ext_in[add_new_good_moral,pdf,png,docs,docx,jepg,jpg]',
            'add_new_guardian_id' => 'uploaded[add_new_guardian_id]|ext_in[add_new_guardian_id,pdf,png,docs,docx,jepg,jpg]',
        ], [
            'add_new_firstname' => [
                'required' => 'First Name is required.',
            ],
            'add_new_lastname' => [
                'required' => 'Last Name is required.',
            ],
            'add_new_gender' => [
                'required' => 'Select Gender first.',
            ],
            'add_new_bdate' => [
                'required' => 'Birth Date is required.',
            ],
            'add_new_address' => [
                'required' => 'Address is required.',
            ],
            'add_new_placebirth' => [
                'required' => 'Place of Birth is required',
            ],
            'add_new_nationality' => [
                'required' => 'Nationality is required',
            ],
            'add_new_religion' => [
                'required' => 'Religion is required.',
            ],
            'add_new_contact' => [
                'required' => 'Contact is required.',
            ],
            'add_new_guardian' => [
                'required' => 'Guardian is required.',
            ],
            'add_new_email' => [
                'required' => 'Email is required ',
            ],
            'add_new_guardian_contact' => [
                'required' => 'Guardian\'s Contact is required',
            ],
            'add_new_video' => [
                'required' => 'Video record link is required.',
                'valid_url' => 'The URL provided is not valid..',
                'mediafire_url' => 'The video record link must contain "https://www.mediafire.com/".',
            ],
            'add_new_pdf_file' => [
                'uploaded' => 'PDF File is required.',
                'ext_in' => 'File is not supported.',
            ],
            'add_new_form_138' => [
                'uploaded' => 'Form 138 is required.',
                'ext_in' => 'File is not supported.',
            ],
            'add_new_psa' => [
                'uploaded' => 'PSA Birth Certificate is required.',
                'ext_in' => 'File is not supported.',
            ],
            'add_new_brgy_clearance' => [
                'uploaded' => 'Barangay Clearance is required.',
                'ext_in' => 'File is not supported.',
            ],
            'add_new_good_moral' => [
                'uploaded' => 'Good Moral is required.',
                'ext_in' => 'File is not supported.',
            ],
            'add_new_guardian_id' => [
                'uploaded' => 'Guardian\'s ID is required.',
                'ext_in' => 'File is not supported.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {

            $dateTime = date('YmdHis');
            $firstname = $this->request->getPost('add_new_firstname');
            $lastname = $this->request->getPost('add_new_lastname');
            $mi = $this->request->getPost('add_new_mi') ?? '';
            $gender = $this->request->getPost('add_new_gender');
            $bdate = $this->request->getPost('add_new_bdate');
            $address = $this->request->getPost('add_new_address');
            $placebirth = $this->request->getPost('add_new_placebirth');
            $nationality = $this->request->getPost('add_new_nationality');
            $religion = $this->request->getPost('add_new_religion');
            $contact = $this->request->getPost('add_new_contact');
            $guardian = $this->request->getPost('add_new_guardian');
            $email = $this->request->getPost('add_new_email');
            $guardian_contact = $this->request->getPost('add_new_guardian_contact');
            $video = $this->request->getPost('add_new_video');
            $pdf_file = "{$firstname}-{$lastname}-pdf-file-{$dateTime}.{$this->request->getFile('add_new_pdf_file')->getExtension()}";
            $form_138 = "{$firstname}-{$lastname}-form-138-{$dateTime}.{$this->request->getFile('add_new_form_138')->getExtension()}";
            $psa = "{$firstname}-{$lastname}-psa-{$dateTime}.{$this->request->getFile('add_new_psa')->getExtension()}";
            $brgy_clearance = "{$firstname}-{$lastname}-brgy-clearance-{$dateTime}.{$this->request->getFile('add_new_brgy_clearance')->getExtension()}";
            $good_moral = "{$firstname}-{$lastname}-good-moral-{$dateTime}.{$this->request->getFile('add_new_good_moral')->getExtension()}";
            $guardian_id = "{$firstname}-{$lastname}-guardian-id-{$dateTime}.{$this->request->getFile('add_new_guardian_id')->getExtension()}";

            $studentDataInsert = [
                'grade_level_id' => 1,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'middle_initial' => $mi,
                'gender' => $gender,
                'date_of_birth' => $bdate,
                'address' => $address,
                'place_of_birth' => $placebirth,
                'nationality' => $nationality,
                'religion' => $religion,
                'contact_no' => $contact,
                'guardian' => $guardian,
                'email' => $email,
                'parent_contact_no' => $guardian_contact,
                'status' => 0,
            ];

            $this->request->getFile('add_new_pdf_file')->move(ROOTPATH . 'public/requirements/pdf-file', $pdf_file);
            $this->request->getFile('add_new_form_138')->move(ROOTPATH . 'public/requirements/form-138', $form_138);
            $this->request->getFile('add_new_psa')->move(ROOTPATH . 'public/requirements/psa-birth-cert', $psa);
            $this->request->getFile('add_new_brgy_clearance')->move(ROOTPATH . 'public/requirements/brgy-clearance', $brgy_clearance);
            $this->request->getFile('add_new_good_moral')->move(ROOTPATH . 'public/requirements/good-moral', $good_moral);
            $this->request->getFile('add_new_guardian_id')->move(ROOTPATH . 'public/requirements/guardian-id', $guardian_id);

            $insert = $this->studentModel->save($studentDataInsert);

            if ($insert) {
                $id = $this->studentModel->getInsertID();
                $requirementsDataInsert = [
                    'student_id' => $id,
                    'video_record' => $video,
                    'pdf_file' => $pdf_file,
                    'form_138' => $form_138,
                    'psa_birth_cert' => $psa,
                    'brgy_clearance' => $brgy_clearance,
                    'good_moral' => $good_moral,
                    'guardian_id' => $guardian_id,
                ];

                $insertReq = $this->requirementsModel->insert($requirementsDataInsert);

                if ($insertReq) {
                    $response = ['status' => 'success', 'message' => 'Enrollment application submitted successfully. Please wait for the email enrollment update. Thank you.'];
                }
            }

        }

        return $this->response->setJSON($response);
    }
}
