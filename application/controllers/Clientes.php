<?php

defined('BASEPATH') or exit('Ação não permitida');

class Clientes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }

    public function index()
    {

        $data = array(

            'titulo' => 'Clientes',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'clientes' => $this->core_model->get_all('clientes'),

        );

        // echo '<pre>';
        // print_r($data['clientes']);
        // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id = NULL)
    {

        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {

            $this->session->set_flashdata('error', 'Cliente não encontrado!');
            redirect('clientes');
        } else {

            $this->form_validation->set_rules('cliente_nome', '', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', '', 'trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_nascimento', '', 'required');
            $this->form_validation->set_rules('cliente_cpf_cnpj', '', 'trim|required|min_length[10]|max_length[20]');
            $this->form_validation->set_rules('cliente_rg_ie', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_email', '', 'trim|valid_email|max_length[50]');
            $this->form_validation->set_rules('cliente_telefone', '', 'trim|max_length[14]');
            $this->form_validation->set_rules('cliente_celular', '', 'trim|max_length[15]');
            $this->form_validation->set_rules('cliente_cep', '', 'trim|required|exact_length[9]');
            $this->form_validation->set_rules('cliente_endereco', '', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', '', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', '', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', '', 'trim|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', '', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', '', 'trim|required|exact_length[2]');
            $this->form_validation->set_rules('cliente_obs', '', 'max_length[400]');

            if ($this->form_validation->run()) {

                // echo '<pre>';
                // $this->input->post();
                // exit();
            } else {
                $data = array(

                    'titulo' => 'Editar Cliente',

                    'scripts' => array(
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),

                );

                // echo '<pre>';
                // print_r($data['cliente']);
                // exit();

                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }
}
