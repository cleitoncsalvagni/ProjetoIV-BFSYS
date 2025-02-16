<?php

defined('BASEPATH') or exit('Ação não permitida');

class Ordens_servicos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
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

    public function novo($ordem_servico_id = NULL)
    {
        $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
        $this->form_validation->set_rules('ordem_servico_equipamento', '', 'trim|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', '', 'trim|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', '', 'trim|min_length[2]|max_length[80]');
        $this->form_validation->set_rules('ordem_servico_acessorios', '', 'trim|max_length[400]');
        $this->form_validation->set_rules('ordem_servico_defeito', '', 'trim|max_length[700]');
        $this->form_validation->set_rules('ordem_servico_obs', '', 'trim|max_length[400]');

        if ($this->form_validation->run()) {


            $data = elements(
                array(
                    'ordem_servico_cliente_id',
                    'ordem_servico_forma_pagamento_id',
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    'ordem_servico_status',
                    'ordem_servico_valor_desconto',
                    'ordem_servico_valor_total',
                    'ordem_servico_obs',
                ),
                $this->input->post()
            );

            $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

            $data = html_escape($data);

            $this->core_model->insert('ordens_servicos', $data, TRUE);
            $id_ordem_servico = $this->session->userdata('last_id');

            $servico_id = $this->input->post('servico_id');


            $servico_quantidade = $this->input->post('servico_quantidade');

            $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));

            $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

            $qtd_servico = count($servico_id);

            $ordem_servico_id = $this->input->post('ordem_servico_id');

            for ($i = 0; $i < $qtd_servico; $i++) {

                $data = array(
                    'ordem_ts_id_ordem_servico' => $id_ordem_servico,
                    'ordem_ts_id_servico' => $servico_id[$i],
                    'ordem_ts_quantidade' => $servico_quantidade[$i],
                    'ordem_ts_valor_unitario' => $servico_preco[$i],
                    'ordem_ts_valor_desconto' => $servico_desconto[$i],
                    'ordem_ts_valor_total' => $servico_item_total[$i],
                );

                $data = html_escape($data);

                $this->core_model->insert('ordem_tem_servicos', $data);
            }


            redirect('os/opcoes/' . $id_ordem_servico);
        } else {

            $data = array(
                'pageTitle' => 'Nova ordem de serviço',
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
            );

            $ordem_servico = $data['ordem_servico'] = $this->ordem_servico_model->get_by_id($ordem_servico_id);

            $this->load->view('layout/header', $data);
            $this->load->view('ordens_servicos/novo');
            $this->load->view('layout/footer');
        }
    }

    public function edit($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        } else {
            $ordem_servico_status = $this->input->post('ordem_servico_status');

            $this->form_validation->set_rules('ordem_servico_cliente_id', '', 'required');
            $this->form_validation->set_rules('ordem_servico_equipamento', '', 'trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento', '', 'trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento', '', 'trim|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios', '', 'trim|max_length[400]');
            $this->form_validation->set_rules('ordem_servico_defeito', '', 'trim|max_length[700]');
            $this->form_validation->set_rules('ordem_servico_obs', '', 'trim|max_length[400]');

            if ($ordem_servico_status == 1) {
                $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', '', 'required');
            }

            if ($this->form_validation->run()) {

                $data = elements(
                    array(
                        'ordem_servico_cliente_id',
                        'ordem_servico_forma_pagamento_id',
                        'ordem_servico_equipamento',
                        'ordem_servico_marca_equipamento',
                        'ordem_servico_modelo_equipamento',
                        'ordem_servico_acessorios',
                        'ordem_servico_defeito',
                        'ordem_servico_status',
                        'ordem_servico_valor_desconto',
                        'ordem_servico_valor_total',
                        'ordem_servico_obs',
                    ),
                    $this->input->post()
                );

                if ($ordem_servico_status == 0) {
                    unset($data['ordem_servico_forma_pagamento_id']);
                }

                $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));

                $data = html_escape($data);

                $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));
                $this->ordem_servico_model->delete_old_services($ordem_servico_id);
                $servico_id = $this->input->post('servico_id');

                $servico_quantidade = $this->input->post('servico_quantidade');

                $servico_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
                $servico_preco = str_replace('R$', '', $this->input->post('servico_preco'));

                $servico_item_total = str_replace('R$', '', $this->input->post('servico_item_total'));

                $qtd_servico = count($servico_id);

                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for ($i = 0; $i < $qtd_servico; $i++) {

                    $data = array(
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('ordem_tem_servicos', $data);
                }


                redirect('os/opcoes/' . $ordem_servico_id);
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

                $this->load->view('layout/header', $data);
                $this->load->view('ordens_servicos/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        }

        if ($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status' => 0))) {
            $this->session->set_flashdata('error', 'Não é possível excluir uma ordem de serviço em aberto');
            redirect('os');
        }

        $this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id));
        redirect('os');
    }

    public function opcoes($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        } else {



            $data = array(
                'pageTitle' => 'Escolha uma opção',

                'ordem_servico' => $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))
            );

            $this->load->view('layout/header', $data);
            $this->load->view('ordens_servicos/opcoes');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($ordem_servico_id = NULL)
    {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {

            $this->session->set_flashdata('error', 'Ordem de serviço não encontrada');
            redirect('os');
        } else {

            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
            $ordem_servico = $this->ordem_servico_model->get_by_id($ordem_servico_id);
            $ordem_servico_id = $ordem_servico->ordem_servico_id;
            $servicos_ordem = $this->ordem_servico_model->get_all_servicos($ordem_servico_id);
            $valor_final_os = $this->ordem_servico_model->get_valor_final_os($ordem_servico_id);
            $file_name = 'OS_' . $ordem_servico->ordem_servico_id;

            $html = '<html>';
            $html .= '<head>';
            $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Impressão de ordem</title>';
            $html .= '<style>';
            $html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
            $html .= 'h4 {text-align: center;}';
            $html .= 'table {border-collapse: collapse; width: 100%;}';
            $html .= 'th, td {text-align: left; padding: 8px;}';
            $html .= 'th {background-color: #f2f2f2;}';
            $html .= 'footer {font-size: 12px; text-align: center;}';
            $html .= 'hr {border: 0; height: 1px; background-color: #ddd; margin: 20px 0;}';
            $html .= '</style>';
            $html .= '</head>';
            $html .= '<body>';
            $html .= '<div style="padding: 10px;">';
            $html .= '<h4>' . $empresa->sistema_razao_social . '</h4>';
            $html .= '<p style="text-align: center;">CNPJ: ' . $empresa->sistema_cnpj . '</p>';
            $html .= '<p style="text-align: center;">' . $empresa->sistema_endereco . ', ' . $empresa->sistema_numero . '<br>';
            $html .= 'CEP: ' . $empresa->sistema_cep . ', ' . $empresa->sistema_cidade . ', ' . $empresa->sistema_estado . '<br>';
            $html .= 'Telefone: ' . $empresa->sistema_telefone_movel . '<br>';
            $html .= 'E-mail: ' . $empresa->sistema_email . '</p>';
            $html .= '<hr>';
            $html .= '<p style="text-align: right; font-size: 12px;">O.S Nº ' . $ordem_servico->ordem_servico_id . '</p>';
            $html .= '<div style="margin-top: 20px;">';
            $html .= '<h4 style="text-align: left;">Cliente:</h4>';
            $html .= '<p><strong>' . $ordem_servico->cliente_nome_completo . '</strong><br>';
            $html .= '<strong>CPF/CNPJ:</strong> ' . $ordem_servico->cliente_cpf_cnpj . '<br>';
            $html .= '<strong>Celular:</strong> ' . $ordem_servico->cliente_celular . '<br>';
            $html .= '<strong>Data de emissão:</strong> ' . formata_data_banco_com_hora($ordem_servico->ordem_servico_data_emissao) . '</p>';
            $html .= '</div>';
            $html .= '<hr>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Serviço</th>';
            $html .= '<th style="text-align: center;">Quantidade</th>';
            $html .= '<th>Valor unitário</th>';
            $html .= '<th style="text-align: center;">Desconto</th>';
            $html .= '<th>Valor total itens </th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            foreach ($servicos_ordem as $servico) {
                $html .= '<tr>';
                $html .= '<td>' . $servico->servico_nome . '</td>';
                $html .= '<td style="text-align: center;">' . $servico->ordem_ts_quantidade . '</td>';
                $html .= '<td>' . 'R$&nbsp;' . $servico->ordem_ts_valor_unitario . '</td>';
                $html .= '<td style="text-align: center;">' . ($servico->ordem_ts_valor_desconto != 0 ? $servico->ordem_ts_valor_desconto . '%&nbsp;' : 'R$ 0.00') . '</td>';
                $html .= '<td>' . 'R$&nbsp;' . $servico->ordem_ts_valor_total . '</td>';
                $html .= '</tr>';
            }

            $html .= '<tfoot>';
            $html .= '<tr>';
            $html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
            $html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_os->os_valor_total . '</td>';
            $html .= '</tr>';
            $html .= '</tfoot>';

            $html .= '</table>';

            $html .= '<div style="width: 100%; padding: 8px">';
            $html .= '<h4 style="text-align: left;">Forma de pagamento:</h4>';
            $html .= '<p>' . ($ordem_servico->ordem_servico_status == 1 ? $ordem_servico->forma_pagamento : 'Em aberto') . '</p>';
            $html .= '</div>';

            $html .= '<div style="margin-top: 100px">';
            $html .= '<table style="width: 100%;">';
            $html .= '<tr>';
            $html .= '<td style="border-bottom: 1px solid #000000; text-align: center; padding-top: 50px;"></td>';
            $html .= '<td style="width: 30%;"></td>';
            $html .= '<td style="border-bottom: 1px solid #000000; text-align: center; padding-top: 50px;"></td>';
            $html .= '</tr>';
            $html .= '<tr>';
            $html .= '<td style="text-align: center;"><strong>' . $empresa->sistema_nome_fantasia . '</strong></td>';
            $html .= '<td></td>';
            $html .= '<td style="text-align: center;"><strong>' . $ordem_servico->cliente_nome_completo . '</strong></td>';
            $html .= '</tr>';
            $html .= '</table>';
            $html .= '</div>';

            $html .= '<footer style="text-align: center; position: absolute; bottom: 0;">';
            $html .= '<p>' . $empresa->sistema_txt_ordem_servico . '</p>';
            $html .= '</footer>';

            $html .= '</body>';
            $html .= '</html>';

            $this->pdf->createPDF($html, $file_name, false);
        }
    }
}
