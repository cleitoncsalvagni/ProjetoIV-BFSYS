<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('servicos') ?>">Serviços</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:&nbsp;</strong><?php echo formata_data_banco_com_hora($servico->servico_data_alteracao) ?></p>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-tools"></i>&nbsp; Informações do serviço</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Nome do serviço</label>
                                <input type="text" class="form-control" name="servico_nome" placeholder="Informe o nome do serviço" value="<?php echo $servico->servico_nome; ?>">
                                <?php echo form_error('servico_nome', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-3">
                                <label>Preço</label>
                                <input type="text" class="form-control" name="servico_preco" placeholder="Informe o preço" value="<?php echo $servico->servico_preco; ?>">
                                <?php echo form_error('servico_preco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <div class="col-md-12">
                                <label>Descrição</label>
                                <textarea class="form-control" name="servico_descricao" placeholder="Informe a descrição do serviço"><?php echo $servico->servico_descricao ?></textarea>
                                <?php echo form_error('servico_descricao', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Serviço ativo</label>
                                <select name='servico_ativo' class="form-control">
                                    <option value='1' <?php echo ($servico->servico_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($servico->servico_ativo == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <input type='hidden' name='servico_id' value="<?php echo $servico->servico_id; ?>">

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>