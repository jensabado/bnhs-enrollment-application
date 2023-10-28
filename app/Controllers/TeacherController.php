<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Libraries\Sanitize;
use App\Models\Teacher;

use function PHPUnit\Framework\fileExists;

class TeacherController extends BaseController
{
    public function teacher()
    {
        $data = [
            'pageTitle' => 'Teacher',
        ];

        return view('pages/admin/teacher', $data);
    }

    public function datatable()
    {
        $request = service('request');

        $column = ['id', 'avatar', 'name', 'gender', 'mobile_no', 'email', 'status', 'created_at'];

        $db = db_connect();

        $query = "SELECT * FROM tbl_teacher WHERE is_deleted = 'no'";

        if ($request->getPost('filter_status') != '') {
            $query .= ' AND status = "' . $request->getPost('filter_status') . '"';
        }

        if ($request->getPost('filter_gender') != '') {
            $query .= ' AND gender = "' . $request->getPost('filter_gender') . '"';
        }

        if ($request->getPost('search')['value']) {
            $query .= '
                AND (f_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR l_name LIKE "%' . $request->getPost('search')['value'] . '%"
                OR gender LIKE "%' . $request->getPost('search')['value'] . '%"
                OR mobile_no LIKE "%' . $request->getPost('search')['value'] . '%"
                OR email LIKE "%' . $request->getPost('search')['value'] . '%"
                OR status LIKE "%' . $request->getPost('search')['value'] . '%"
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
            $status = '<span class="badge badge-primary">ENABLED</span>';
            $status_btn = '<button class="btn btn-danger btn-sm disable" data-id="' . $row['id'] . '"><i class="bi bi-toggle-off"></i></button>';
            if ($row['status'] == 'disable') {
                $status = '<span class="badge badge-danger">DISABLED</span>';

                $status_btn = '<button class="btn btn-success btn-sm enable" data-id="' . $row['id'] . '"><i class="bi bi-toggle-on"></i></i></button>';
            }

            $sub_array = [];
            $sub_array[] = $count++;
            $sub_array[] = !empty($row['avatar']) ? '<img style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" src="' . base_url('avatar/teacher/' . $row['avatar']) . '"/>' : '<img style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;" src="' . base_url('avatar/no-image/avatar-5.png') . '"/>';
            $sub_array[] = ucwords($row['f_name'] . ' ' . $row['l_name']);
            $sub_array[] = strtoupper($row['gender']);
            $sub_array[] = $row['mobile_no'];
            $sub_array[] = $row['email'];
            $sub_array[] = $status;
            $sub_array[] = $row['created_at'];
            $sub_array[] = '<div class="btn-group">
                                ' . $status_btn . '
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
        $query = "SELECT * FROM tbl_teacher WHERE is_deleted = 'no'";
        $statement = $db->query($query);
        return $statement->getNumRows();
    }

    public function disable()
    {
        $id = $this->request->getVar('id');
        $teacherModel = new Teacher();
        $update = $teacherModel->disableAccount($id);

        if ($update) {
            $response = ['status' => 'success', 'message' => 'Account disabled successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong.'];
        }

        return $this->response->setJSON($response);
    }

    public function enable()
    {
        $id = $this->request->getVar('id');
        $teacherModel = new Teacher();
        $update = $teacherModel->enableAccount($id);

        if ($update) {
            $response = ['status' => 'success', 'message' => 'Account enabled successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong.'];
        }

        return $this->response->setJSON($response);
    }

    public function addTeacher()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'add_fname' => 'required',
            'add_lname' => 'required',
            'add_gender' => 'required',
            'add_email' => 'required',
            'add_password' => 'required',
            'add_contact' => 'required|is_contact_num[add_contact]',
            'add_avatar' => 'is_image[add_avatar]|max_size[add_avatar,2048]',
        ], [
            'add_fname' => [
                'required' => 'First Name is required.',
            ],
            'add_lname' => [
                'required' => 'Last Name is required.',
            ],
            'add_gender' => [
                'required' => 'Select Gender first.',
            ],
            'add_email' => [
                'required' => 'Email is required.',
            ],
            'add_password' => [
                'required' => 'Password is required.',
            ],
            'add_contact' => [
                'required' => 'Contact is required.',
                'is_contact_num' => 'Contact number format is invalid.',
            ],
            'add_avatar' => [
                'is_image' => 'The avatar must be a valid image file.',
                'max_size' => 'Avatar file size too large. Maximum of 5mb.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $teacherModel = new Teacher();
            $fname = Sanitize::sanitize($this->request->getPost('add_fname'));
            $lname = Sanitize::sanitize($this->request->getPost('add_lname'));
            $gender = Sanitize::sanitize($this->request->getPost('add_gender'));
            $contact = Sanitize::sanitize($this->request->getPost('add_contact'));
            $email = Sanitize::sanitize($this->request->getPost('add_email'));
            $password = Hash::make(Sanitize::sanitize($this->request->getPost('add_password')));

            if (!$teacherModel->emailExists($email, 0)) {
                $data = [
                    'f_name' => $fname,
                    'l_name' => $lname,
                    'gender' => $gender,
                    'mobile_no' => $contact,
                    'email' => $email,
                    'password' => $password,
                ];

                if ($this->request->getFile('add_avatar')->isValid()) {
                    $avatar = $this->request->getFile('add_avatar');

                    $newName = $avatar->getRandomName();
                    $avatar->move(ROOTPATH . 'public/avatar/teacher', $newName);
                    $data['avatar'] = $newName;
                }

                $insert = $teacherModel->insertData($data);

                if ($insert) {
                    $response = ['status' => 'success', 'message' => 'Teacher added successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error', 'message' => ['add_email' => 'Email already exists in system.'], 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function getTeacherData()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $teacherModel = new Teacher();

        $teacherData = $teacherModel->getTeacherById($id);

        if ($teacherData) {
            $data = [
                'edit_id' => $teacherData->id,
                'edit_fname' => ucwords($teacherData->f_name),
                'edit_lname' => ucwords($teacherData->l_name),
                'edit_gender' => ucwords($teacherData->gender),
                'edit_contact' => ucwords($teacherData->mobile_no),
                'edit_email' => strtolower($teacherData->email),
                'edit_avatar' => ucwords($teacherData->avatar),
            ];

            return $this->response->setJSON(['status' => 'success', 'message' => $data, 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()]);
        }
    }

    public function editTeacher()
    {
        $validator = \Config\Services::validation();

        $validator->setRules([
            'edit_fname' => 'required',
            'edit_lname' => 'required',
            'edit_gender' => 'required',
            'edit_email' => 'required',
            'edit_contact' => 'required|is_contact_num[edit_contact]',
            'edit_avatar' => 'is_image[edit_avatar]|max_size[edit_avatar,2048]',
        ], [
            'edit_fname' => [
                'required' => 'First Name is required.',
            ],
            'edit_lname' => [
                'required' => 'Last Name is required.',
            ],
            'edit_gender' => [
                'required' => 'Select Gender first.',
            ],
            'edit_email' => [
                'required' => 'Email is required.',
            ],
            'edit_contact' => [
                'required' => 'Contact is required.',
                'is_contact_num' => 'Contact number format is invalid.',
            ],
            'edit_avatar' => [
                'is_image' => 'The avatar must be a valid image file.',
                'max_size' => 'Avatar file size too large. Maximum of 5mb.',
            ],
        ]);

        if (!$validator->withRequest($this->request)->run()) {
            $response = ['status' => 'error', 'message' => $validator->getErrors(), 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
        } else {
            $teacherModel = new Teacher();
            $id = Sanitize::sanitize($this->request->getPost('edit_id'));
            $fname = Sanitize::sanitize($this->request->getPost('edit_fname'));
            $lname = Sanitize::sanitize($this->request->getPost('edit_lname'));
            $gender = Sanitize::sanitize($this->request->getPost('edit_gender'));
            $contact = Sanitize::sanitize($this->request->getPost('edit_contact'));
            $email = Sanitize::sanitize($this->request->getPost('edit_email'));
            $password = Hash::make(Sanitize::sanitize($this->request->getPost('edit_password')));

            if (!$teacherModel->emailExists($email, $id)) {
                $data = [
                    'f_name' => $fname,
                    'l_name' => $lname,
                    'gender' => $gender,
                    'mobile_no' => $contact,
                    'email' => $email,
                    'password' => $password,
                ];

                if ($this->request->getFile('edit_avatar')->isValid()) {
                    $avatar = $this->request->getFile('edit_avatar');
                    $teacherData = $teacherModel->getTeacherById($id);

                    $newName = $avatar->getRandomName();
                    $avatar->move(ROOTPATH . 'public/avatar/teacher', $newName);

                    if(!empty($teacherData->avatar)) {
                        $filePath = ROOTPATH . 'public/avatar/teacher/' . $teacherData->avatar;

                        if(fileExists($filePath)) {
                            unlink($filePath);
                        }
                    }

                    $data['avatar'] = $newName;
                }

                $update = $teacherModel->updateData($id, $data);

                if ($update) {
                    $response = ['status' => 'success', 'message' => 'Teacher updated successfully.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                } else {
                    $response = ['status' => 'error_alert', 'message' => 'Something went wrong.', 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
                }
            } else {
                $response = ['status' => 'error', 'message' => ['edit_email' => 'Email already exists in system.'], 'csrfName' => csrf_token(), 'csrfHash' => csrf_hash()];
            }
        }

        return $this->response->setJSON($response);
    }

    public function deleteTeacher()
    {
        $id = Sanitize::sanitize($this->request->getPost('id'));
        $teacherModel = new Teacher();

        if ($teacherModel->deleteData($id)) {
            $response = ['status' => 'success', 'message' => 'Teacher deleted successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Something went wrong'];
        }

        return $this->response->setJSON($response);
    }
}
