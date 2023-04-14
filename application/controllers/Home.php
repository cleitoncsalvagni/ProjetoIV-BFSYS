<?php

defined('BASEPATH') or exit('Ação não permitida');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou! Por favor realize seu login novamente');
            redirect('login');
        }

        $this->load->model('home_model');
    }

    public function index()
    {
        /* Vendas de produtos - Para o gráfico em barras. */

        $vendas_por_mes = $this->home_model->get_sum_vendas_por_mes();
        $valores_vendas = array_fill(0, 12, 0);
        $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");

        foreach ($vendas_por_mes as $venda) {
            $mes = intval(substr($venda->mes, 5)) - 1; // Subtrai 1 para ficar no índice correto do array
            $valores_vendas[$mes] = intval(str_replace(',', '', $venda->venda_valor_total));
        }

        $soma_vendas_mes = array_values($valores_vendas); // Transforma os valores em um array sequencial
        $labels_meses = array_slice($meses, 0, count($soma_vendas_mes)); // Pega as labels dos meses correspondentes aos valores

        /* Vendas de serviço - Para o gráfico em barras. */

        $os_por_mes = $this->home_model->get_sum_os_por_mes();
        $valores_os = array_fill(0, 12, 0);
        $meses = array("Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez");

        foreach ($os_por_mes as $os) {
            $mes = intval(substr($os->mes, 5)) - 1; // Subtrai 1 para ficar no índice correto do array
            $valores_os[$mes] = intval(str_replace(',', '', $os->os_valor_total));
        }

        $soma_os_mes = array_values($valores_os); // Transforma os valores em um array sequencial
        $labels_meses = array_slice($meses, 0, count($soma_os_mes)); // Pega as labels dos meses correspondentes aos valores

        $data = array(
            'pageTitle' => 'Início',
            'soma_vendas' => $this->home_model->get_sum_vendas(),
            'soma_ordem_servicos' => $this->home_model->get_sum_os(),
            'total_pagar' => $this->home_model->get_sum_pagar(),
            'total_receber' => $this->home_model->get_sum_receber(),
            'produtos_mais_vendidos' => $this->home_model->get_produtos_mais_vendidos(),
            'servicos_mais_vendidos' => $this->home_model->get_servicos_mais_vendidos(),
            'soma_vendas_mes' => $soma_vendas_mes,
            'soma_os_mes' => $soma_os_mes,
        );

        $contador_notificacoes = 0;

        if ($this->home_model->get_receber_vencidas()) {

            $data['contas_receber_vencidas'] = TRUE;
            $contador_notificacoes++;
        } else {
            $data['contas_receber_vencidas'] = FALSE;
        }

        if ($this->home_model->get_pagar_vencidas()) {

            $data['contas_pagar_vencidas'] = TRUE;
            $contador_notificacoes++;
        } else {
            $data['contas_pagar_vencidas'] = FALSE;
        }

        if ($this->home_model->get_contas_pagar_venc_hoje()) {

            $data['contas_pagar_vencem_hoje'] = TRUE;
            $contador_notificacoes++;
        } else {
            $data['contas_pagar_vencem_hoje'] = FALSE;
        }

        if ($this->home_model->get_contas_receber_venc_hoje()) {

            $data['contas_receber_vencem_hoje'] = TRUE;
            $contador_notificacoes++;
        } else {
            $data['contas_receber_vencem_hoje'] = FALSE;
        }

        if ($this->home_model->get_usuarios_desativados()) {

            $data['usuarios_desativados'] = TRUE;
            $contador_notificacoes++;
        } else {
            $data['usuarios_desativados'] = FALSE;
        }


        $data['contador_notificacoes'] = $contador_notificacoes;

        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}
