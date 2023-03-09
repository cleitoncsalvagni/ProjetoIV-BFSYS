<?php

defined('BASEPATH') or exit('Ação não permitida');

class Ordens_servicos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        $this->load->model('ordem_servico_model');
    }

    public function index()
    {

        $data = array(

            'pageTitle' => 'Ordens de serviços',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'ordens_servicos' => $this->ordem_servico_model->get_all(),

        );

        $this->load->view('layout/header', $data);
        $this->load->view('ordens_servicos/index');
        $this->load->view('layout/footer');
    }

    public function edit($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        } else {
            // [ordem_servico_id] => 1
            // [ordem_servico_forma_pagamento_id] => 1
            // [ordem_servico_cliente_id] => 1
            // [ordem_servico_data_emissao] => 2020-02-14 17:30:35
            // [ordem_servico_data_conclusao] => 
            // [ordem_servico_equipamento] => Fone de ouvido
            // [ordem_servico_marca_equipamento] => Awell
            // [ordem_servico_modelo_equipamento] => AV1801
            // [ordem_servico_acessorios] => Mouse e carregador
            // [ordem_servico_defeito] => Não sai aúdio no lado esquerdo
            // [ordem_servico_valor_desconto] => R$ 0.00
            // [ordem_servico_valor_total] => 490.00
            // [ordem_servico_status] => 0
            // [ordem_servico_obs] => 
            // [ordem_servico_data_alteracao] => 2020-02-19 22:58:42
            // [cliente_id] => 1
            // [cliente_nome] => Cleiton
            // [forma_pagamento_id] => 1
            // [forma_pagamento] => Cartão de crédito

            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', '', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', '', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', '', 'trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', '', 'trim|required|max_length[400]');
            $this->form_validation->set_rules('ordem_servico_defeito', '', 'trim|required|max_length[700]');

            if ($this->form_validation->run()) {

                exit('Validado');
            } else {

                $data = array(
                    'pageTitle' => 'Editar ordem de serviço',
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/os.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'os_tem_servicos' => $this->ordem_servico_model->get_all_servicos_by_ordem($ordem_servico_id)
                );

                $ordem_servico = $data['ordem_servico'] = $this->ordem_servico_model->get_by_id($ordem_servico_id);

                // echo '<pre>';
                // print_r($data['os_tem_servicos']);
                // exit;

                $this->load->view('layout/header', $data);
                $this->load->view('ordens_servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }
}
