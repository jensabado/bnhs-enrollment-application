<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\ClassAdvisory;
use App\Models\Requirements;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentSection;

class EnrolleesController extends BaseController
{
    protected $studentModel, $requirementsModel, $sectionModel, $classAdvisoryModel, $studentSectionModel;
    protected $helpers = ['CIMail'];

    public function __construct()
    {
        $this->studentModel = new Student();
        $this->requirementsModel = new Requirements();
        $this->sectionModel = new Section();
        $this->classAdvisoryModel = new ClassAdvisory();
        $this->studentSectionModel = new StudentSection();
    }

    public function index()
    {
        $data = [
            'pageTitle' => 'Enrollees - Grade 7',
        ];

        return view('pages/admin/enrollees/grade-7/index', $data);
    }

    public function grade7Datatable()
    {
        $request = service('request');

        $column = ['id', 'lrn', 'firstname', 'gender', 'contact_no', 'email', 'parent_contact_no', 'created_at'];

        $db = db_connect();

        $query = "SELECT id, lrn, firstname, middle_initial, lastname, gender, contact_no, email, parent_contact_no, guardian, created_at FROM tbl_student WHERE status = 0 AND is_deleted = 0 ";

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (lrn LIKE "%' . $request->getPost('search')['value'] . '%"
                OR firstname LIKE "%' . $request->getPost('search')['value'] . '%"
                OR middle_initial LIKE "%' . $request->getPost('search')['value'] . '%"
                OR lastname LIKE "%' . $request->getPost('search')['value'] . '%"
                OR gender LIKE "%' . $request->getPost('search')['value'] . '%"
                OR contact_no LIKE "%' . $request->getPost('search')['value'] . '%"
                OR email LIKE "%' . $request->getPost('search')['value'] . '%"
                OR parent_contact_no LIKE "%' . $request->getPost('search')['value'] . '%"
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
            $name = '';
            if (!empty($row['middle_initial'])) {
                $name = ucwords($row['firstname'] . ' ' . $row['middle_initial'] . '. ' . $row['lastname']);
            } else {
                $name = ucwords($row['firstname'] . ' ' . $row['lastname']);
            }

            $sub_array[] = $count++;
            $sub_array[] = $row['lrn'] ? $row['lrn'] : '';
            $sub_array[] = $name;
            $sub_array[] = strtoupper($row['gender']);
            $sub_array[] = $row['contact_no'];
            $sub_array[] = $row['email'];
            $sub_array[] = $row['guardian'] . '<br>' . '<a href="tel:0' . $row['parent_contact_no'] . '">0' . $row['parent_contact_no'] . '</a>';
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
        $query = "SELECT id, lrn, firstname, middle_initial, lastname, gender, contact_no, email, parent_contact_no, guardian, created_at FROM tbl_student WHERE status = 0 AND is_deleted = 0 ";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function grade7View($id)
    {

        if (!$this->studentModel->enrolleeExist(1, $id)) {
            return redirect()->route('admin.enrollees/grade-7');
        } else {
            $data = [
                'pageTitle' => 'View Enrollee',
                'studentData' => $this->studentModel->getStudentById($id),
                'studentRequirements' => $this->requirementsModel->getRequirementsByStudentId($id),
            ];

            return view('pages/admin/enrollees/grade-7/view', $data);
        }
    }

    public function updateStatus()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'status' => 'required',
        ], [
            'status' => [
                'required' => 'Select Status first.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors()];
        } else {
            $status = $this->request->getPost('status');
            $id = $this->request->getPost('id');

            if ($status == '1') {
                $validator = \Config\Services::validation();

                $validator->setRules([
                    'section' => 'required',
                    'status_password' => 'required',
                ], [
                    'section' => [
                        'required' => 'Select Section first.',
                    ],
                    'status_password' => [
                        'required' => 'Password is required',
                    ],
                ]);

                if (!$validator->withRequest($this->request)->run()) {
                    $response = ['status' => 'error', 'message' => $validator->getErrors()];
                } else {
                    $section = $this->request->getPost('section');
                    $status_password = $this->request->getPost('status_password');
                    $studentData = (array) $this->studentModel->getStudentById($id);
                    $studentData['password_plain'] = $status_password;
                    $sectionData = (array) $this->sectionModel->getDataById($section);
                    $adviserData = (array) $this->classAdvisoryModel->getTeachersBySection($section);

                    $mailData = array(
                        'studentData' => $studentData,
                        'sectionData' => $sectionData,
                        'adviserData' => $adviserData,
                    );

                    $view = \Config\Services::renderer();
                    $mailBody = $view->setVar('mailData', $mailData)->render('email-templates/enrolled-email');

                    $mailConfig = array(
                        'mailFromEmail' => 'nextgen.techiq@gmail.com',
                        'mailFromName' => 'BACOOR NATIONAL HIGH SCHOOL',
                        'mailRecipientEmail' => $studentData['email'],
                        'mailRecipientName' => empty($studentData['middle_initial']) ? $studentData['lastname'] . ', ' . $studentData['firstname'] : $studentData['lastname'] . ', ' . $studentData['firstname'] . ' ' . $studentData['middle_initial'] . '.',
                        'mailSubject' => 'Welcome to Bacoor National High School',
                        'mailBody' => $mailBody,
                    );

                    if (sendMail($mailConfig)) {
                        $year = date('y');
                        $last_number = 000000 + (int) $id;
                        $result = str_pad($last_number, 6, '0', STR_PAD_LEFT);
                        $lrn = $year . '' . $result;

                        $data = [
                            'status' => $status,
                            'password' => Hash::make($status_password),
                            'lrn' => $lrn,
                        ];

                        $updateStudent = $this->studentModel->updateData($id, $data);

                        if ($updateStudent) {
                            $insertStudentSectionData = [
                                'student_id' => $studentData['id'],
                                'grade_level_id' => $studentData['grade_level_id'],
                                'section_id' => $section,
                            ];

                            $insertStudentSection = $this->studentSectionModel->insertData($insertStudentSectionData);

                            if ($insertStudentSection) {
                                $response = ['status' => 'success', 'message' => 'Updated successfully'];
                            }
                        }
                    }
                }
            } else if ($status == 11) {
                $validator = \Config\Services::validation();

                $validator->setRules([
                    'reason' => 'required',
                ], [
                    'reason' => [
                        'required' => 'Reason is required.',
                    ],
                ]);

                if (!$validator->withRequest($this->request)->run()) {
                    $response = ['status' => 'error', 'message' => $validator->getErrors()];
                } else {
                    $reason = $this->request->getPost('reason');

                    $studentData = (array) $this->studentModel->getStudentById($id);

                    $mailData = array(
                        'studentData' => $studentData,
                        'reason' => $reason,
                    );

                    $view = \Config\Services::renderer();
                    $mailBody = $view->setVar('mailData', $mailData)->render('email-templates/decline-email');

                    $mailConfig = array(
                        'mailFromEmail' => 'nextgen.techiq@gmail.com',
                        'mailFromName' => 'BACOOR NATIONAL HIGH SCHOOL',
                        'mailRecipientEmail' => $studentData['email'],
                        'mailRecipientName' => empty($studentData['middle_initial']) ? $studentData['lastname'] . ', ' . $studentData['firstname'] : $studentData['lastname'] . ', ' . $studentData['firstname'] . ' ' . $studentData['middle_initial'] . '.',
                        'mailSubject' => 'Enrollment Application Declined - Bacoor National High School',
                        'mailBody' => $mailBody,
                    );

                    if (sendMail($mailConfig)) {
                        $data = [
                            'status' => $status,
                        ];

                        $updateStudent = $this->studentModel->updateData($id, $data);

                        if ($updateStudent) {
                            $response = ['status' => 'success', 'message' => 'Updated successfully'];
                        }
                    }
                }
            }
        }

        return $this->response->setJSON($response);
    }
}
