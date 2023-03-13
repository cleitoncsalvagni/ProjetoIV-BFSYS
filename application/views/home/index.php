<?php $this->load->view('layout/sidebar'); ?>

<div id="content">

  <?php $this->load->view('layout/navbar'); ?>


  <div class="container-fluid">



    <?php if ($this->ion_auth->is_admin()) : ?>


      <div class="row">


        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs get_pagar_vencidas font-weight-bold text-success text-uppercase mb-1">TOTAL DE VENDAS</div>
                  <div class="h5 mb-0 font-weight-bold text-success"><?php echo 'R$&nbsp;' . $soma_vendas->venda_valor_total; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-cart fa-2x text-success"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TOTAL DE SERVIÇOS</div>
                  <div class="h5 mb-0 font-weight-bold text-primary"><?php echo 'R$&nbsp;' . $soma_ordem_servicos->os_valor_total; ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-shopping-basket fa-2x text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">TOTAL A PAGAR</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-danger"><?php echo 'R$&nbsp;' . $total_pagar->conta_pagar_valor_total; ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-money-bill-alt fa-2x text-danger"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">TOTAL A RECEBER</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-warning"><?php echo 'R$&nbsp;' . ($total_receber->conta_receber_valor_total == NULL ? '0,00' : $total_receber->conta_receber_valor_total); ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-hand-holding-usd fa-2x text-warning"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="row">

      <div class="col-lg-6 mb-4">


        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">TOP 3 Produtos mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('public/img/produtos.svg'); ?>" alt="">
            </div>

            <div class="table-responsive">

              <table class="table table-striped table-borderless">

                <thead>
                  <tr>
                    <th>Nome produto</th>
                    <th class="text-center">Vendidos</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($produtos_mais_vendidos as $produto) : ?>

                    <tr>
                      <td><?php echo $produto->produto_descricao ?></td>
                      <td class="text-center"><?php echo '<span class="badge badge-success">' . $produto->quantidade_vendidos . '</span>' ?></td>
                    </tr>

                  <?php endforeach; ?>

                </tbody>


              </table>


            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">TOP 3 Serviços mais vendidos</h6>
          </div>
          <div class="card-body">
            <div class="text-center">
              <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('public/img/servicos.svg'); ?>" alt="">
            </div>

            <div class="table-responsive">

              <table class="table table-striped table-borderless">

                <thead>
                  <tr>
                    <th>Nome serviço</th>
                    <th class="text-center">Vendidos</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($servicos_mais_vendidos as $servico) : ?>

                    <tr>
                      <td><?php echo $servico->servico_nome ?></td>
                      <td class="text-center"><?php echo '<span class="badge badge-primary">' . $servico->quantidade_vendidos . '</span>' ?></td>
                    </tr>

                  <?php endforeach; ?>

                </tbody>


              </table>


            </div>

          </div>
        </div>
      </div>


    </div>

  </div>
  <?php

  if ($message = $this->session->flashdata('info')) {
    echo "<script>toastr.info('" . $message . "');</script>";
  }

  if ($message = $this->session->flashdata('success')) {
    echo "<script>toastr.success('" . $message . "');</script>";
  }
  if ($message = $this->session->flashdata('error')) {
    echo "<script>toastr.error('" . $message . "');</script>";
  }


  ?>
</div>