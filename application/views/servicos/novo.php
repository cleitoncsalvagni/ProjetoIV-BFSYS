<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('servicos') ?>">Serviços</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_novo">
                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-tools"></i>&nbsp; Informações do serviço</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Nome do serviço <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="servico_nome" placeholder="Informe o nome" value="<?php echo set_value('servico_nome') ?>">
                                <?php echo form_error('servico_nome', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-3">
                                <label>Preço <strong class='text-danger'>*</strong></label>
                                <input type="number" class="form-control" name="servico_preco" placeholder="Informe o preço " value="<?php echo set_value('servico_preco') ?>">
                                <?php echo form_error('servico_preco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>

                        <div class="form-group row mb-3">

                            <div class="col-md-12">
                                <label>Descrição <strong class='text-danger'>*</strong></label>
                                <textarea class="form-control" name="servico_descricao" placeholder="Informe a descrição"><?php echo set_value('servico_descricao') ?></textarea>
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
                                    <option value='1'>Sim</option>
                                    <option value='0'>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>