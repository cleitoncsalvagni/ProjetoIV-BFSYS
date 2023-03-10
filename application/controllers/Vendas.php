<?php

defined('BASEPATH') or exit('Ação não permitida');

class Vendas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        $this->load->model('vendas_model');
    }

    public function index()
    {

        $data = array(

            'pageTitle' => 'Vendas',
            'styles' => array('vendor/datatables/dataTables.bootstrap4.min.css'),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'
            ),
            'vendas' => $this->vendas_model->get_all(),

        );

        // echo '<pre>';
        // print_r($data['vendas']);
        // exit;

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
    }
}
