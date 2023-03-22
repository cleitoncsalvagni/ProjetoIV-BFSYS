<?php

defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
            redirect('login');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não tem permissão para acessar o menu do Sistema');
            redirect('home');
        }
    }

    public function index()
    {

        $data = array(
            'pageTitle' => 'Informações do sistema',

            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),

            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );

        $this->form_validation->set_rules('sistema_razao_social', '', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', '', 'required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', '', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo', '', 'max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_movel', '', 'required|max_length[25]');
        $this->form_validation->set_rules('sistema_email', '', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', '', 'valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', '', 'required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', '', 'required|max_length[100]');
        $this->form_validation->set_rules('sistema_numero', '', 'max_length[25]');
        $this->form_validation->set_rules('sistema_cidade', '', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', '', 'required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', '', 'max_length[400]');

        if ($this->form_validation->run()) {


            $data = elements(array(
                'sistema_razao_social',
                'sistema_nome_fantasia',
                'sistema_cnpj',
                'sistema_ie',
                'sistema_telefone_fixo',
                'sistema_telefone_movel',
                'sistema_email',
                'sistema_site_url',
                'sistema_cep',
                'sistema_endereco',
                'sistema_numero',
                'sistema_cidade',
                'sistema_estado',
                'sistema_txt_ordem_servico',
            ), $this->input->post());

            $data = html_escape($data);
            $this->security->xss_clean($data);

            $this->core_model->update('sistema', $data, array('sistema_id' => 1));

            redirect('sistema');
        } else {

            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }
    }
}
