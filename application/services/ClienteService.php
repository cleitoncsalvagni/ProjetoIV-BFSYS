<?php

class ClienteService
{

	public function delete($cliente_id = null)
	{
		if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {

			$this->session->set_flashdata('error', 'Cliente não encontrado');
			redirect('clientes');
		} else {
			$this->core_model->delete('clientes', array('cliente_id' => $cliente_id));
			redirect('clientes');
		}
	}

	public function check_email($cliente_email)
	{


		if ($this->core_model->get_by_id('clientes', array('cliente_email' => $cliente_email, 'cliente_id !=' => $cliente_id))) {
			$this->form_validation->set_message('check_email', 'Este email já existe!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_telefone($cliente_telefone)
	{
		$cliente_id = $this->input->post('cliente_id');

		if ($this->core_model->get_by_id('clientes', array('cliente_telefone' => $cliente_telefone, 'cliente_id !=' => $cliente_id))) {
			$this->form_validation->set_message('check_telefone', 'Este telefone já existe!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_celular($cliente_celular)
	{
		$cliente_id = $this->input->post('cliente_id');

		if ($this->core_model->get_by_id('clientes', array('cliente_celular' => $cliente_celular, 'cliente_id !=' => $cliente_id))) {
			$this->form_validation->set_message('check_celular', 'Este celular existe!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_rg_ie($cliente_rg_ie)
	{
		$cliente_id = $this->input->post('cliente_id');

		if ($this->core_model->get_by_id('clientes', array('cliente_rg_ie' => $cliente_rg_ie, 'cliente_id !=' => $cliente_id))) {
			$this->form_validation->set_message('check_rg_ie', 'Este documento já existe!');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_cpf($cpf)
	{

		if ($this->input->post('cliente_id')) {

			$cliente_id = $this->input->post('cliente_id');

			if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cpf))) {
				$this->form_validation->set_message('check_cpf', 'Este CPF já existe');
				return FALSE;
			}
		}

		$cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
		if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

			$this->form_validation->set_message('check_cpf', 'Por favor digite um CPF válido');
			return FALSE;
		} else {
			// Calcula os números para verificar se o CPF é verdadeiro
			for ($t = 9; $t < 11; $t++) {
				for ($d = 0, $c = 0; $c < $t; $c++) {
					//$d += $cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
					$d += $cpf[$c] * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf[$c] != $d) {
					$this->form_validation->set_message('check_cpf', 'Por favor digite um CPF válido');
					return FALSE;
				}
			}
			return TRUE;
		}
	}
}
