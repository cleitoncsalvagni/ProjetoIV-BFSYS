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
		$cliente_id = $this->input->post('cliente_id');

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
}
