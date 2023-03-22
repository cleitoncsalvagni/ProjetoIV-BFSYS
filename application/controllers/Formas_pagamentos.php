<?php

defined('BASEPATH') or exit('Ação não permitida');

class Formas_pagamentos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
            redirect('login');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Você não tem permissão para acessar o menu Formas de Pagamentos');
            redirect('/');
        }
    }

    public function index()
    {
        $data = array(

            'pageTitle' => 'Formas de pagamentos',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),

        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }

    public function edit($forma_pagamento_id = NULL)
    {
        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
            redirect('formas');
        } else {
            $this->form_validation->set_rules('forma_pagamento_nome', '', 'trim|required|min_length[4]|max_length[45]|callback_check_pagamento_nome');

            if ($this->form_validation->run()) {

                $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

                if ($this->db->table_exists('vendas')) {

                    if ($forma_pagamento_ativa == 0 && $this->core_model('vendas', array('venda_forma_pagamento_id' => $forma_pagamento_id, 'venda_status' => 0))) {
                        $this->session->set_flashdata('error', 'Esta forma de pagamento não pode ser desativada pois está sendo utilizada em vendas');
                        redirect('formas');
                    }
                }

                $data = elements(
                    array(
                        'forma_pagamento_nome',
                        'forma_pagamento_aceita_parc',
                        'forma_pagamento_ativa',
                    ),
                    $this->input->post()
                );

                $data = html_escape($data);

                $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));
                redirect('formas');
            } else {
                $data = array(
                    'pageTitle' => 'Editar forma de pagamento',
                    'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),

                );

                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function novo()
    {
        $this->form_validation->set_rules('forma_pagamento_nome', '', 'trim|required|min_length[4]|max_length[45]|is_unique[formas_pagamentos.forma_pagamento_nome]');

        if ($this->form_validation->run()) {

            $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

            $data = elements(
                array(
                    'forma_pagamento_nome',
                    'forma_pagamento_aceita_parc',
                    'forma_pagamento_ativa',
                ),
                $this->input->post()
            );

            $data = html_escape($data);

            $this->core_model->insert('formas_pagamentos', $data);
            redirect('formas');
        } else {
            $data = array(
                'pageTitle' => 'Nova forma de pagamento',

            );

            $this->load->view('layout/header', $data);
            $this->load->view('formas_pagamentos/novo');
            $this->load->view('layout/footer');
        }
    }

    public function del($forma_pagamento_id = NULL)
    {

        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {

            $this->session->set_flashdata('error', 'Forma de pagamento não encontrada!');
            redirect('formas');
        }

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id, 'forma_pagamento_ativa' => 1))) {

            $this->session->set_flashdata('error', 'Não é possível excluir uma forma de pagamento ativa');
            redirect('formas');
        }

        $this->core_model->delete('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id));
        redirect('formas');
    }

    public function check_pagamento_nome($forma_pagamento_nome)
    {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id))) {
            $this->form_validation->set_message('check_pagamento_nome', 'Esta forma de pagamento já existe!');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
