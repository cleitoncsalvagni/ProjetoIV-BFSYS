<?php

defined('BASEPATH') or exit('Ação não permitida');

class Pagar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        $this->load->model('bills_model');
    }

    public function index()
    {
        $data = array(

            'pageTitle' => 'Contas a pagar',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'contas_pagar' => $this->bills_model->get_all_pagar(),

        );


        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }

    public function edit($conta_pagar_id = NULL)
    {
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta a pagar não encontrada!');
            redirect('pagar');
        } else {
            $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
            $this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'required');
            $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
            $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[400]');

            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'conta_pagar_fornecedor_id',
                        'conta_pagar_data_vencimento',
                        'conta_pagar_valor',
                        'conta_pagar_obs',
                        'conta_pagar_status',
                    ),
                    $this->input->post()
                );
                $conta_pagar_status = $this->input->post('conta_pagar_status');

                if ($conta_pagar_status == 1) {
                    $data['conta_pagar_data_pagamento'] = date('Y-m-d h:i:s');
                }

                $data = html_escape($data);

                $this->core_model->update('contas_pagar', $data, array('conta_pagar_id' => $conta_pagar_id));
                redirect('pagar');
            } else {
                $data = array(

                    'pageTitle' => 'Editar conta a pagar',
                    'styles' => array(
                        'vendor/select2/select2.min.css'
                    ),
                    'scripts' => array(
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ),
                    'conta_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id)),
                    'fornecedores' => $this->core_model->get_all('fornecedores'),

                );

                $this->load->view('layout/header', $data);
                $this->load->view('pagar/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function novo()
    {
        $this->form_validation->set_rules('conta_pagar_fornecedor_id', '', 'required');
        $this->form_validation->set_rules('conta_pagar_data_vencimento', '', 'required');
        $this->form_validation->set_rules('conta_pagar_valor', '', 'required');
        $this->form_validation->set_rules('conta_pagar_obs', '', 'max_length[400]');

        if ($this->form_validation->run()) {

            $data = elements(
                array(
                    'conta_pagar_fornecedor_id',
                    'conta_pagar_data_vencimento',
                    'conta_pagar_valor',
                    'conta_pagar_obs',
                    'conta_pagar_status',
                ),
                $this->input->post()
            );
            $conta_pagar_status = $this->input->post('conta_pagar_status');

            if ($conta_pagar_status == 1) {
                $data['conta_pagar_data_pagamento'] = date('Y-m-d h:i:s');
            }

            $data = html_escape($data);

            $this->core_model->insert('contas_pagar', $data);
            redirect('pagar');
        } else {
            $data = array(

                'pageTitle' => 'Nova conta a pagar',
                'styles' => array(
                    'vendor/select2/select2.min.css'
                ),
                'scripts' => array(
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',
                ),
                'fornecedores' => $this->core_model->get_all('fornecedores'),

            );

            $this->load->view('layout/header', $data);
            $this->load->view('pagar/novo');
            $this->load->view('layout/footer');
        }
    }

    public function del($conta_pagar_id = NULL)
    {
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta a pagar não encontrada!');
            redirect('pagar');
        }

        if ($this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id, 'conta_pagar_status' => 0))) {
            $this->session->set_flashdata('error', 'A conta não pode ser deletada pois ainda está em aberto!');
            redirect('pagar');
        }

        $this->core_model->delete('contas_pagar', array('conta_pagar_id' => $conta_pagar_id));
        redirect('pagar');
    }
}
