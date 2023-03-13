<?php

defined('BASEPATH') or exit('Ação não permitida');


class Login extends CI_Controller
{

    public function index()
    {
        $data = array(
            'pageTitle' => 'Login'
        );


        $this->load->view('layout/header', $data);
        $this->load->view('auth/login/index');
        $this->load->view('layout/footer');
    }

    public function auth()
    {

        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = FALSE;

        if ($this->ion_auth->login($identity, $password, $remember)) {

            $this->session->set_flashdata('info', 'É um prazer ter você aqui! 😉');
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'Usuário ou senha incorretos.');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('login');
    }
}
