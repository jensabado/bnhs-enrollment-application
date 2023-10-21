<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        return view('pages/home/home');
    }

    public function login()
    {
        $data = [
            'pageTitle' => 'Login'
        ];

        return view('pages/home/login', $data);
    }

    public function enroll()
    {
        $data = [
            'pageTitle' => 'Enroll'
        ];

        return view('pages/home/enroll', $data);
    }
}
