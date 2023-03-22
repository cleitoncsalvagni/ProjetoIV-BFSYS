<?php

defined('BASEPATH') or exit('Ação não permitida');

class Relatorios extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			$this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
			redirect('login');
		}

		if (!$this->ion_auth->is_admin()) {
			$this->session->set_flashdata('info', 'Você não tem permissão para acessar o menu Relatórios');
			redirect('/');
		}
	}

	public function vendas()
	{

		$data = array(
			'pageTitle' => 'Relatórios de vendas'
		);

		$data_inicial = $this->input->post('data_inicial');
		$data_final = $this->input->post('data_final');


		if ($data_inicial) {

			$this->load->model('vendas_model');

			if ($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)) {

				$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

				$vendas = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);

				$file_name = 'Relatório de vendas';

				$html = '<html>';
				$html .= '<head>';
				$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de vendas</title>';
				$html .= '<style>';
				$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
				$html .= 'h3 {text-align: center;}';
				$html .= 'table {border-collapse: collapse; width: 100%;}';
				$html .= 'th, td {text-align: left; padding: 8px;}';
				$html .= 'th {background-color: #f2f2f2;}';
				$html .= 'footer {font-size: 12px; text-align: center;}';
				$html .= '</style>';
				$html .= '</head>';
				$html .= '<body>';
				$html .= '<div style="padding: 20px;">';
				$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
				$html .= '<hr>';
				if ($data_inicial && $data_final) {
					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Vendas</b> realizadas entre as seguintes datas:</p>';
					$html .= '<p align="center" style="font-size: 15px">' . '<i>' . formata_data_banco_sem_hora($data_inicial) . '</i>' . ' - ' . '<i>' . formata_data_banco_sem_hora($data_final) . '</i>' . '</p>';
				} else {
					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Vendas</b> realizadas a partir da data:</p>';
					$html .= '<p align="center" style="font-size: 15px">' . '<i>' . formata_data_banco_sem_hora($data_inicial) . '</i>' . '</p>';
				}
				$html .= '<hr>';
				$html .= '<table>';
				$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th></th>';
				$html .= '<th>Data</th>';
				$html .= '<th>Cliente</th>';
				$html .= '<th>Forma de pagamento</th>';
				$html .= '<th>Valor total</th>';
				$html .= '<th></th>';
				$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';

				$valor_final_vendas = $this->vendas_model->get_valor_final_relatorio($data_inicial, $data_final);

				foreach ($vendas as $venda) :
					$html .= '<tr>';
					$html .= '<td></td>';
					$html .= '<td>' . formata_data_banco_com_hora($venda->venda_data_emissao) . '</td>';
					$html .= '<td>' . $venda->cliente_nome_completo . '</td>';
					$html .= '<td>' . $venda->forma_pagamento . '</td>';
					$html .= '<td>' . 'R$&nbsp;' . $venda->venda_valor_total . '</td>';
					$html .= '<td></td>';
					$html .= '<td></td>';
					$html .= '</tr>';
				endforeach;

				$html .= '<tfoot>';
				$html .= '<tr>';
				$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
				$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_vendas->venda_valor_total . '</td>';
				$html .= '</tr>';
				$html .= '</tfoot>';
				$html .= '</table>';
				$html .= '</body>';
				$html .= '</html>';

				$this->pdf->createPDF($html, $file_name, false);
			} else {

				if (!empty($data_inicial) && !empty($data_final)) {
					$this->session->set_flashdata('info', 'Não foram encontradas Vendas entre as datas ' . formata_data_banco_sem_hora($data_inicial) . '&nbsp;e&nbsp;' . formata_data_banco_sem_hora($data_final));
				} else {
					$this->session->set_flashdata('info', 'Não foram encontradas Vendas a partir da data ' . formata_data_banco_sem_hora($data_inicial));
				}
				redirect('relatorios/vendas');
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('relatorios/vendas');
		$this->load->view('layout/footer');
	}

	public function os()
	{

		$data = array(
			'pageTitle' => 'Relatórios de ordens de serviços'
		);

		$data_inicial = $this->input->post('data_inicial');
		$data_final = $this->input->post('data_final');

		if ($data_inicial) {

			$this->load->model('ordem_servico_model');

			if ($this->ordem_servico_model->gerar_relatorio_os($data_inicial, $data_final)) {

				$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));

				$ordens_servicos = $this->ordem_servico_model->gerar_relatorio_os($data_inicial, $data_final);

				$file_name = 'Relatório de ordens de serviços';

				$html = '<html>';
				$html .= '<head>';
				$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de OS</title>';
				$html .= '<style>';
				$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
				$html .= 'h3 {text-align: center;}';
				$html .= 'table {border-collapse: collapse; width: 100%;}';
				$html .= 'th, td {text-align: left; padding: 8px;}';
				$html .= 'th {background-color: #f2f2f2;}';
				$html .= 'footer {font-size: 12px; text-align: center;}';
				$html .= '</style>';
				$html .= '</head>';
				$html .= '<body>';
				$html .= '<div style="padding: 20px;">';
				$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
				$html .= '<hr>';
				if ($data_inicial && $data_final) {
					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Ordens de Serviço</b> realizadas entre as seguintes datas:</p>';
					$html .= '<p align="center" style="font-size: 15px">' . '<i>'  . formata_data_banco_sem_hora($data_inicial) . '<i>' . ' - ' . '<i>'  . formata_data_banco_sem_hora($data_final) . '<i>' . '</p>';
				} else {
					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Ordens de Serviço</b> realizadas a partir da data:</p>';
					$html .= '<p align="center" style="font-size: 15px">' . '<i>'  . formata_data_banco_sem_hora($data_inicial) . '<i>' . '</p>';
				}
				$html .= '<hr>';
				$html .= '<table>';
				$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th></th>';
				$html .= '<th>Data</th>';
				$html .= '<th>Cliente</th>';
				$html .= '<th>Forma de pagamento</th>';
				$html .= '<th>Valor total</th>';
				$html .= '<th></th>';
				$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';

				$valor_final_os = $this->ordem_servico_model->get_valor_final_relatorio_os($data_inicial, $data_final);

				foreach ($ordens_servicos as $os) :
					$html .= '<tr>';
					$html .= '<td></td>';
					$html .= '<td>' . formata_data_banco_com_hora($os->ordem_servico_data_emissao) . '</td>';
					$html .= '<td>' . $os->cliente_nome_completo . '</td>';
					$html .= '<td>' . ($os->forma_pagamento ? ($os->forma_pagamento ? $os->forma_pagamento : '') : '') . '</td>';
					$html .= '<td>' . 'R$&nbsp;' . $os->ordem_servico_valor_total . '</td>';
					$html .= '<td></td>';
					$html .= '<td></td>';
					$html .= '</tr>';
				endforeach;

				$html .= '<tfoot>';
				$html .= '<tr>';
				$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
				$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_os->ordem_servico_valor_total . '</td>';
				$html .= '</tr>';
				$html .= '</tfoot>';
				$html .= '</table>';
				$html .= '</body>';
				$html .= '</html>';

				$this->pdf->createPDF($html, $file_name, false);
			} else {

				if (!empty($data_inicial) && !empty($data_final)) {
					$this->session->set_flashdata('info', 'Não foram encontradas Ordens de Serviços entre as datas ' . formata_data_banco_sem_hora($data_inicial) . '&nbsp;e&nbsp;' . formata_data_banco_sem_hora($data_final));
				} else {
					$this->session->set_flashdata('info', 'Não foram encontradas Ordens de Serviços a partir da data ' . formata_data_banco_sem_hora($data_inicial));
				}
				redirect('relatorios/os');
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('relatorios/os');
		$this->load->view('layout/footer');
	}

	public function receber()
	{

		$data = array(
			'pageTitle' => 'Relatório de contas a receber'
		);

		$contas = $this->input->post('contas');

		if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {

			$this->load->model('bills_model');

			if ($contas == 'vencidas') {

				$conta_receber_status = 0;

				$data_vencimento = TRUE;

				if ($this->bills_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento);
					$file_name = 'Relatório de contas a receber vencidas';
					$file_name = 'Relatório de contas a receber vencidas';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas vencidas</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Receber</b> (vencidas)</p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Cliente</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->cliente_nome_completo . '</td>';
						$html .= '<td>' . formata_data_banco_com_hora($conta->conta_receber_data_vencimento) . '</td>';
						$html .= '<td>Vencida</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_receber_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';


					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas vencidas na base de dados');
					redirect('relatorios/receber');
				}
			}

			if ($contas == 'pagas') {

				$conta_receber_status = 1;

				if ($this->bills_model->get_contas_receber_relatorio($conta_receber_status)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_receber_relatorio($conta_receber_status);
					$file_name = 'Relatório de contas a receber pagas';
					$file_name = 'Relatório de contas a receber pagas';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas pagas</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Receber</b> (pagas)</p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Cliente</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status);

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->cliente_nome_completo . '</td>';
						$html .= '<td>' . formata_data_banco_com_hora($conta->conta_receber_data_pagamento) . '</td>';
						$html .= '<td>Paga</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_receber_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';


					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas pagas na base de dados');
					redirect('relatorios/receber');
				}
			}

			if ($contas == 'receber') {

				$conta_receber_status = 0;

				if ($this->bills_model->get_contas_receber_relatorio($conta_receber_status)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_receber_relatorio($conta_receber_status);
					$file_name = 'Relatório de contas a receber';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a receber</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Receber</b></p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Cliente</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status);
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_receber_relatorio($conta_receber_status);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->cliente_nome_completo . '</td>';
						$html .= '<td>' . formata_data_banco_sem_hora($conta->conta_receber_data_vencimento) . '</td>';
						$html .= '<td>A receber</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_receber_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_receber_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';




					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas a receber na base de dados');
					redirect('relatorios/receber');
				}
			}

			//pagas
		}

		$this->load->view('layout/header', $data);
		$this->load->view('relatorios/receber');
		$this->load->view('layout/footer');
	}

	public function pagar()
	{

		$data = array(
			'pageTitle' => 'Relatório de contas a pagar'
		);

		$contas = $this->input->post('contas');

		if ($contas == 'pagas' || $contas == 'vencidas' || $contas == 'a_pagar') {

			$this->load->model('bills_model');

			if ($contas == 'vencidas') {

				$conta_pagar_status = 0;

				$data_vencimento = TRUE;

				if ($this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$file_name = 'Relatório de contas a pagar vencidas';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a pagar vencidas</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Pagar</b> (vencidas)</p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Fornecedor</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->fornecedor_nome_fantasia . '</td>';
						$html .= '<td>' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
						$html .= '<td>Vencida</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_pagar_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';


					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas vencidas na base de dados');
					redirect('relatorios/pagar');
				}
			}


			if ($contas == 'pagas') {

				$conta_pagar_status = 1;

				$data_vencimento = FALSE;

				if ($this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$file_name = 'Relatório de contas pagas';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas pagas</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Pagar</b> (pagas)</p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Fornecedor</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->fornecedor_nome_fantasia . '</td>';
						$html .= '<td>' . formata_data_banco_com_hora($conta->conta_pagar_data_pagamento) . '</td>';
						$html .= '<td>Paga</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_pagar_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';


					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas pagas na base de dados');
					redirect('relatorios/pagar');
				}
			}

			if ($contas == 'a_pagar') {

				$conta_pagar_status = 0;

				$data_vencimento = FALSE;

				if ($this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {

					$empresa = $this->core_model->get_by_id('sistema', array('sistema_id' => 1));
					$contas = $this->bills_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$file_name = 'Relatório de Contas a pagar';

					$html = '<html>';
					$html .= '<head>';
					$html .= '<title>' . $empresa->sistema_nome_fantasia . ' | Relatório de contas a pagar</title>';
					$html .= '<style>';
					$html .= 'body {font-size: 14px; font-family: Arial, sans-serif; margin: 0;}';
					$html .= 'h3 {text-align: center;}';
					$html .= 'table {border-collapse: collapse; width: 100%;}';
					$html .= 'th, td {text-align: left; padding: 8px;}';
					$html .= 'th {background-color: #f2f2f2;}';
					$html .= 'footer {font-size: 12px; text-align: center;}';
					$html .= '</style>';
					$html .= '</head>';
					$html .= '<body>';
					$html .= '<div style="padding: 20px;">';
					$html .= '<h3>' . $empresa->sistema_nome_fantasia . '</h3>';
					$html .= '<hr>';

					$html .= '<p align="center" style="font-size: 15px">Relatório de <b>Contas a Pagar</b></p>';

					$html .= '<hr>';
					$html .= '<table>';
					$html .= '<thead>';
					$html .= '<tr>';
					$html .= '<th></th>';
					$html .= '<th>Fornecedor</th>';
					$html .= '<th>Data vencimento</th>';
					$html .= '<th>Situação</th>';
					$html .= '<th>Valor total</th>';
					$html .= '<th></th>';
					$html .= '</tr>';
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);
					$html .= '</thead>';
					$html .= '<tbody>';

					$valor_final_contas = $this->bills_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

					foreach ($contas as $conta) :
						$html .= '<tr>';
						$html .= '<td></td>';
						$html .= '<td>' . $conta->fornecedor_nome_fantasia . '</td>';
						$html .= '<td>' . formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento) . '</td>';
						$html .= '<td>A pagar</td>';
						$html .= '<td>' . 'R$&nbsp;' . $conta->conta_pagar_valor . '</td>';
						$html .= '<td></td>';
						$html .= '<td></td>';
						$html .= '</tr>';
					endforeach;

					$html .= '<tfoot>';
					$html .= '<tr>';
					$html .= '<td colspan="4" style="text-align:right; font-weight:bold; border:none; padding-top:20px;">Valor total:</td>';
					$html .= '<td style="border:none; padding-top:20px;">' . 'R$&nbsp;' . $valor_final_contas->conta_pagar_valor_total . '</td>';
					$html .= '</tr>';
					$html .= '</tfoot>';
					$html .= '</table>';
					$html .= '</body>';
					$html .= '</html>';

					$this->pdf->createPDF($html, $file_name, false);
				} else {

					$this->session->set_flashdata('info', 'Não existem contas a pagar na base de dados');
					redirect('relatorios/pagar');
				}
			}
		}

		$this->load->view('layout/header', $data);
		$this->load->view('relatorios/pagar');
		$this->load->view('layout/footer');
	}
}
