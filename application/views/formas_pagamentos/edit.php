<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('formas') ?>">Formas de pagamentos</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:&nbsp;</strong><?php echo formata_data_banco_com_hora($forma_pagamento->forma_pagamento_data_alteracao) ?></p>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-money-check-alt"></i>&nbsp; Informações</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Descrição da forma de pagamento</label>
                                <input type="text" class="form-control" name="forma_pagamento_nome" placeholder="Informe o nome da forma de pagamento" value="<?php echo $forma_pagamento->forma_pagamento_nome; ?>">
                                <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-3">
                                <label>Aceita Parcelamento</label>
                                <select name='forma_pagamento_aceita_parc' class="form-control">
                                    <option value='1' <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                            </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <label>Forma de pagamento ativa</label>
                                <select name='forma_pagamento_ativa' class="form-control">
                                    <option value='1' <?php echo ($forma_pagamento->forma_pagamento_ativa == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($forma_pagamento->forma_pagamento_ativa == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <input type='hidden' name='forma_pagamento_id' value="<?php echo $forma_pagamento->forma_pagamento_id; ?>">

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url('formas') ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>