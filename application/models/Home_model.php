<?php

defined('BASEPATH') or exit('Ação não permitida');

class Home_model extends CI_Model
{

    public function get_sum_vendas()
    {

        $this->db->select([
            'FORMAT(SUM(REPLACE(venda_valor_total, ",", "")), 2) as venda_valor_total',
        ]);

        return $this->db->get('vendas')->row();
    }

    public function get_sum_vendas_por_mes()
    {
        $this->db->select([
            'DATE_FORMAT(venda_data_emissao, "%Y-%m") AS mes',
            'FORMAT(SUM(REPLACE(venda_valor_total, ",", "")), 2) AS venda_valor_total',
        ]);
        $this->db->group_by('mes');
        return $this->db->get('vendas')->result();
    }


    public function get_sum_os()
    {

        $this->db->select([
            'FORMAT(SUM(REPLACE(ordem_servico_valor_total, ",", "")), 2) as os_valor_total',
        ]);

        return $this->db->get('ordens_servicos')->row();
    }

    public function get_sum_os_por_mes()
    {
        $this->db->select([
            'DATE_FORMAT(ordem_servico_data_emissao, "%Y-%m") AS mes',
            'FORMAT(SUM(REPLACE(ordem_servico_valor_total, ",", "")), 2) AS os_valor_total',
        ]);
        $this->db->group_by('mes');
        return $this->db->get('ordens_servicos')->result();
    }

    public function get_sum_receber()
    {

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_receber_valor, ",", "")), 2) as conta_receber_valor_total',
        ]);

        $this->db->where('conta_receber_status', 0);

        return $this->db->get('contas_receber')->row();
    }

    public function get_sum_pagar()
    {

        $this->db->select([
            'FORMAT(SUM(REPLACE(conta_pagar_valor, ",", "")), 2) as conta_pagar_valor_total',
        ]);

        $this->db->where('conta_pagar_status', 0);

        return $this->db->get('contas_pagar')->row();
    }

    public function get_contas_pagar_venc_hoje()
    {

        $this->db->select([
            'contas_pagar.*',
            'fornecedor_id',
            'fornecedor_nome_fantasia as fornecedor',
        ]);

        $this->db->where('conta_pagar_status', 0);
        $this->db->where('conta_pagar_data_vencimento =', date('Y-m-d'));

        $this->db->join('fornecedores', 'fornecedor_id = conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->row();
    }

    public function get_contas_receber_venc_hoje()
    {

        $this->db->select([
            'contas_receber.*',
            'cliente_id',
            'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome_completo',
        ]);

        $this->db->where('conta_receber_status', 0);
        $this->db->where('conta_receber_data_vencimento =', date('Y-m-d'));

        $this->db->join('clientes', 'cliente_id = conta_receber_cliente_id', 'LEFT');
        return $this->db->get('contas_receber')->row();
    }

    public function get_produtos_mais_vendidos()
    {

        $this->db->select([
            'venda_produtos.*',
            'SUM(venda_produto_quantidade) as quantidade_vendidos',
            'produtos.produto_id',
            'produtos.produto_descricao',
        ]);

        $this->db->join('produtos', 'produto_id = venda_produto_id_produto', 'LEFT');
        $this->db->limit(3);

        $this->db->group_by('venda_produto_id_produto');
        $this->db->order_by('quantidade_vendidos', 'DESC');

        return $this->db->get('venda_produtos')->result();
    }

    public function get_servicos_mais_vendidos()
    {

        $this->db->select([
            'ordem_tem_servicos.*',
            'SUM(ordem_ts_quantidade) as quantidade_vendidos',
            'servicos.servico_id',
            'servicos.servico_nome',
        ]);

        $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
        $this->db->limit(3);

        $this->db->group_by('ordem_ts_id_servico');
        $this->db->order_by('quantidade_vendidos', 'DESC');

        return $this->db->get('ordem_tem_servicos')->result();
    }

    public function get_usuarios_desativados()
    {

        $this->db->where('active', 0);
        return $this->db->get('users')->row();
    }

    public function get_receber_vencidas()
    {

        $this->db->where('conta_receber_data_vencimento <', date('Y-m-d'));
        $this->db->where('conta_receber_status', 0);

        return $this->db->get('contas_receber')->row();
    }

    public function get_pagar_vencidas()
    {

        $this->db->where('conta_pagar_data_vencimento <', date('Y-m-d'));
        $this->db->where('conta_pagar_status', 0);

        return $this->db->get('contas_pagar')->row();
    }
}
