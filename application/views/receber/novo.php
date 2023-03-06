<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('receber') ?>">Contas a receber</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_novo">
                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-receipt"></i>&nbsp; Informações da conta</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Cliente</label>
                                <select class='custom-select contas_receber' name='conta_receber_cliente_id'>
                                    <?php foreach ($clientes as $cliente) : ?>
                                        <option value="<?php echo $cliente->cliente_id ?>">
                                            <?php echo $cliente->cliente_nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Data de vencimento</label>
                                <input type="date" class="form-control form-control-user-date" name="conta_receber_data_vencimento" value="<?php echo set_value('conta_receber_data_vencimento') ?>">
                                <?php echo form_error('conta_receber_data_vencimento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-3">
                                <label>Valor da conta</label>
                                <input type="text" class="form-control money2" name="conta_receber_valor" value="<?php echo set_value('conta_receber_valor') ?>">
                                <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-3">
                                <label>Situação</label>
                                <select class='custom-select' name='conta_receber_status'>
                                    <option value="1">
                                        Paga
                                    </option>
                                    <option value="0">
                                        Pendente
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label>Observações</label>
                                <textarea class="form-control" name="conta_receber_obs" placeholder="Observações"><?php echo set_value('conta_receber_obs') ?></textarea>
                                <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>


                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>

                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>