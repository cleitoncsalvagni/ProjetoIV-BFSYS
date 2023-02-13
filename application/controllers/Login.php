<?php

defined('BASEPATH') or exit('Ação não permitida');


class Login extends CI_Controller
{

    public function index()
    {

        $this->load->view('layout/header');
        $this->load->view('auth/login/index');
    }
}
