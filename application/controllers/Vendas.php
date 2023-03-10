<?php

defined('BASEPATH') or exit('Ação não permitida');

class Vendas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
            redirect('login');
        }

        $this->load->model('vendas_model');
        $this->load->model('products_model');
    }

    public function index()
    {

        $data = array(
            'pageTitle' => 'Vendas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'vendas' => $this->vendas_model->get_all(),
        );


        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
    }

    public function novo()
    {

        $this->form_validation->set_rules('venda_cliente_id', '', 'required');
        $this->form_validation->set_rules('venda_tipo', '', 'required');
        $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
        $this->form_validation->set_rules('venda_vendedor_id', '', 'required');


        if ($this->form_validation->run()) {

            $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

            $data = elements(
                array(
                    'venda_cliente_id',
                    'venda_forma_pagamento_id',
                    'venda_tipo',
                    'venda_vendedor_id',
                    'venda_valor_desconto',
                    'venda_valor_total',
                ),
                $this->input->post()
            );

            $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total));

            $data = html_escape($data);

            $this->core_model->insert('vendas', $data, TRUE);

            $id_venda = $this->session->userdata('last_id');

            $produto_id = $this->input->post('produto_id');
            $produto_quantidade = $this->input->post('produto_quantidade');
            $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));

            $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

            $produto_preco = str_replace(',', '', $produto_preco_venda);
            $produto_item_total = str_replace(',', '', $produto_item_total);


            $qty_produto = count($produto_id);




            for ($i = 0; $i < $qty_produto; $i++) {

                $data = array(
                    'venda_produto_id_venda' => $id_venda,
                    'venda_produto_id_produto' => $produto_id[$i],
                    'venda_produto_quantidade' => $produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                    'venda_produto_desconto' => $produto_desconto[$i],
                    'venda_produto_valor_total' => $produto_item_total[$i],
                );

                $data = html_escape($data);

                $this->core_model->insert('venda_produtos', $data);


                $produto_qtde_estoque = 0;

                $produto_qtde_estoque += intval($produto_quantidade[$i]);

                $produtos = array(
                    'produto_qtde_estoque' => $produto_qtde_estoque,
                );

                $this->products_model->update($produto_id[$i], $produto_qtde_estoque);
            }
            redirect('vendas/opcoes/' . $id_venda);
        } else {


            $data = array(
                'pageTitle' => 'Cadastrar venda',
                'styles' => array(
                    'vendor/select2/select2.min.css',
                    'vendor/autocomplete/jquery-ui.css',
                    'vendor/autocomplete/estilo.css',
                ),
                'scripts' => array(
                    'vendor/autocomplete/jquery-migrate.js',
                    'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                    'vendor/calcx/venda.js',
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/sweetalert2/sweetalert2.js',
                    'vendor/autocomplete/jquery-ui.js',
                ),
                'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
            );


            $this->load->view('layout/header', $data);
            $this->load->view('vendas/novo');
            $this->load->view('layout/footer');
        }
    }

    public function edit($venda_id = NULL)
    {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não encontrada');
            redirect('vendas');
        } else {

            $this->form_validation->set_rules('venda_cliente_id', '', 'required');
            $this->form_validation->set_rules('venda_tipo', '', 'required');
            $this->form_validation->set_rules('venda_forma_pagamento_id', '', 'required');
            $this->form_validation->set_rules('venda_vendedor_id', '', 'required');


            if ($this->form_validation->run()) {

                $venda_valor_total = str_replace('R$', "", trim($this->input->post('venda_valor_total')));

                $data = elements(
                    array(
                        'venda_cliente_id',
                        'venda_forma_pagamento_id',
                        'venda_tipo',
                        'venda_vendedor_id',
                        'venda_valor_desconto',
                        'venda_valor_total',
                    ),
                    $this->input->post()
                );

                $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total));

                $data = html_escape($data);

                $this->core_model->update('vendas', $data, array('venda_id' => $venda_id));

                $this->vendas_model->delete_old_products($venda_id);

                $produto_id = $this->input->post('produto_id');
                $produto_quantidade = $this->input->post('produto_quantidade');
                $produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));

                $produto_preco_venda = str_replace('R$', '', $this->input->post('produto_preco_venda'));
                $produto_item_total = str_replace('R$', '', $this->input->post('produto_item_total'));

                $produto_preco = str_replace(',', '', $produto_preco_venda);
                $produto_item_total = str_replace(',', '', $produto_item_total);


                $qty_produto = count($produto_id);




                for ($i = 0; $i < $qty_produto; $i++) {

                    $data = array(
                        'venda_produto_id_venda' => $venda_id,
                        'venda_produto_id_produto' => $produto_id[$i],
                        'venda_produto_quantidade' => $produto_quantidade[$i],
                        'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    );

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);

                    /* Início atualização estoque */

                    //                    foreach ($venda_produtos as $venda_p) {
                    //
                    //                        if ($venda_p->venda_produto_quantidade < $produto_quantidade[$i]) {
                    //
                    //                            $produto_qtde_estoque = 0;
                    //
                    //                            $produto_qtde_estoque += intval($produto_quantidade[$i]);
                    //
                    //                            $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);
                    //
                    //                            $this->products_model->update($produto_id[$i], $diferenca);
                    //                        }
                    //                    }
                    /* Fim atualização estoque */
                }

                //                redirect('vendas/imprimir/' . $venda_id);
                redirect('vendas');
            } else {

                //Erro de validação

                $data = array(
                    'pageTitle' => 'Editar venda',
                    'styles' => array(
                        'vendor/select2/select2.min.css',
                        'vendor/autocomplete/jquery-ui.css',
                        'vendor/autocomplete/estilo.css',
                    ),
                    'scripts' => array(
                        'vendor/autocomplete/jquery-migrate.js',
                        'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                        'vendor/calcx/venda.js',
                        'vendor/select2/select2.min.js',
                        'vendor/select2/app.js',
                        'vendor/sweetalert2/sweetalert2.js',
                        'vendor/autocomplete/jquery-ui.js',
                    ),
                    'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
                    'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativa' => 1)),
                    'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
                    'venda' => $this->vendas_model->get_by_id($venda_id),
                    'venda_produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
                    'desabilitar' => TRUE,
                );


                $this->load->view('layout/header', $data);
                $this->load->view('vendas/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($venda_id = NULL)
    {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não encontrada');
            redirect('vendas');
        } else {

            $this->core_model->delete('vendas', array('venda_id' => $venda_id));
            redirect('vendas');
        }
    }

    public function opcoes($venda_id = NULL)
    {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não encontrada');
            redirect('vendas');
        } else {

            $data = array(
                'pageTitle' => 'Escolha uma opção',
                'venda' => $this->core_model->get_by_id('vendas', array('venda_id' => $venda_id)),
            );

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/opcoes');
            $this->load->view('layout/footer');
        }
    }

    public function pdf($venda_id = NULL)
    {

        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não encontrada');
            redirect('vendas');
        } else {

            $empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

            $venda = $this->vendas_model->get_by_id($venda_id);

            $file_name = 'Venda&nbsp;' . $venda->venda_id;


            $html = '<html>';


            $html .= '<head>';


            $html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Impressão de venda</title>';


            $html .= '</head>';

            $html .= '<body style="font-size: 14px">';

            $html .= '<h4 align="center">
                ' . $empresa->sistema_razao_social . '<br/>
                ' . 'CNPJ: ' . $empresa->sistema_cnpj . '<br/>
                ' . $empresa->sistema_endereco . ', &nbsp;' . $empresa->sistema_numero . '<br/>
                ' . 'CEP: ' . $empresa->sistema_cep . ', &nbsp;' . $empresa->sistema_cidade . ', &nbsp;' . $empresa->sistema_estado . '<br/>
                    ' . 'Telefone: ' . $empresa->sistema_telefone_movel . '<br/>
                    ' . 'E-mail: ' . $empresa->sistema_email . '<br/>
                    </h4>';

            $html .= '<hr>';



            $html .= '<p align="right" style="font-size: 12px">Venda Nº&nbsp;' . $venda->venda_id . '</p>';

            $html .= '<p>'
                . '<strong>Cliente: </strong>' . $venda->cliente_nome_completo . '<br/>'
                . '<strong>CPF: </strong>' . $venda->cliente_cpf_cnpj . '<br/>'
                . '<strong>Celular: </strong>' . $venda->cliente_celular . '<br/>'
                . '<strong>Data de emissão: </strong>' . formata_data_banco_com_hora($venda->venda_data_emissao) . '<br/>'
                . '<strong>Forma de pagamento: </strong>' . $venda->forma_pagamento . '<br/>'
                . '</p>';


            $html .= '<hr>';



            $html .= '<table width="100%" border: solid #ddd 1px>';

            $html .= '<tr>';

            $html .= '<th>Código produto</th>';
            $html .= '<th>Descrição</th>';
            $html .= '<th>Quantidade</th>';
            $html .= '<th>Valor unitário</th>';
            $html .= '<th>Desconto</th>';
            $html .= '<th>Valor total</th>';

            $html .= '</tr>';


            $produtos_venda = $this->vendas_model->get_all_produtos($venda_id);


            $valor_final_venda = $this->vendas_model->get_valor_final_venda($venda_id);



            foreach ($produtos_venda as $produto) :

                $html .= '<tr>';
                $html .= '<td>' . $produto->venda_produto_id_produto . '</td>';
                $html .= '<td>' . $produto->produto_descricao . '</td>';
                $html .= '<td>' . $produto->venda_produto_quantidade . '</td>';
                $html .= '<td>' . 'R$&nbsp;' . $produto->venda_produto_valor_unitario . '</td>';
                $html .= '<td>' .   ($produto->venda_produto_desconto ? $produto->venda_produto_desconto . '%&nbsp;' : 'R$ 0.00')  . '</td>';
                $html .= '<td>' . 'R$&nbsp;' . $produto->venda_produto_valor_total . '</td>';
                $html .= '</tr>';

            endforeach;

            $html .= '<th colspan="4" style="border-bottom: solid #ddd 1px;">';

            $html .= '<td style="padding-top: 20px"><strong>Valor final</strong></td>';
            $html .= '<td style="padding-top: 20px">' . 'R$&nbsp;' . $valor_final_venda->venda_valor_total . '</td>';

            $html .= '</th>';



            $html .= '</table>';



            $html .= '</body>';

            $html .= '</html>';

            // False -> Abre PDF no navegador
            // True -> Faz o download

            $this->pdf->createPDF($html, $file_name, false);
        }
    }
}
