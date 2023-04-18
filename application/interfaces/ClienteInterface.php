<?php

interface ClienteInterface
{
	function delete($cliente_id = null);
	function check_email($cliente_email);
	function check_telefone($cliente_telefone);
	function check_celular($cliente_celular);
	function check_rg_ie($cliente_rg_ie);
	function check_cpf($cpf);
}
