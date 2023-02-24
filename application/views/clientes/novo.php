<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('clientes') ?>">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_add">
                    <div>
                        <div class="custom-control custom-radio custom-control-inline mt-2">
                            <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
                            <label class="custom-control-label" for="pessoa_fisica">Pessoa física</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?>>
                            <label class="custom-control-label" for="pessoa_juridica">Pessoa jurídica</label>
                        </div>
                    </div>

                    <fieldset class='mt-5 border p-3'>
                        <legend class='small'><i class="fas fa-fw fa-user-tie"></i>&nbsp; Dados Pessoais</legend>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>Nome <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="cliente_nome" placeholder="Informe o nome" value="<?php echo set_value('cliente_nome'); ?>">
                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-5">
                                <label>Sobrenome <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control form-control-user" name="cliente_sobrenome" placeholder="Informe o sobrenome" value="<?php echo set_value('cliente_sobrenome'); ?>">
                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>Data de nasc. <strong class='text-danger'>*</strong></label>
                                <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo set_value('cliente_data_nascimento'); ?>">
                                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>

                        <div class="form-group row mb-3">
                            <div class='col-md-3 pessoa_fisica'>
                                <label>CPF <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="Informe o CPF" value="<?php echo set_value('cliente_cpf') ?>">
                                <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class='col-md-3 pessoa_juridica'>
                                <label>CNPJ <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control cnpj" name="cliente_cnpj" placeholder="Informe o CNPJ" value="<?php echo set_value('cliente_cnpj') ?>">
                                <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3 pessoa_fisica">
                                <label class=''>RG</label>
                                <input type="text" class="form-control" name="cliente_rg_ie" placeholder="Informe o RG" value="<?php echo set_value('cliente_rg_ie'); ?>">
                                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3 pessoa_juridica">
                                <label class=''>Inscrição Estadual</label>
                                <input type="text" class="form-control" name="cliente_rg_ie" placeholder="Informe a inscrição estadual" value="<?php echo set_value('cliente_rg_ie'); ?>">
                                <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="text" class="form-control" name="cliente_email" placeholder="Informe o email" value="<?php echo set_value('cliente_email'); ?>">
                                <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>') ?>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Celular</label>
                                <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Informe o celular" value="<?php echo set_value('cliente_celular') ?>">
                                <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Telefone fixo</label>
                                <input type="text" class="form-control phone_with_ddd" name="cliente_telefone" placeholder="Informe o telefone fixo" value="<?php echo set_value('cliente_telefone') ?>">
                                <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-map-marker-alt"></i>&nbsp; Endereço</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Endereço <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="cliente_endereco" placeholder="Informe o endereço" value="<?php echo set_value('cliente_endereço') ?>">
                                <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>Numero</label>
                                <input type="text" class="form-control" name="cliente_numero_endereco" placeholder="Informe o número" value="<?php echo set_value('cliente_numero_endereco') ?>">
                                <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-6">
                                <label>Complemento</label>
                                <input type="text" class="form-control" name="cliente_complemento" placeholder="Informe o complemento" value="<?php echo set_value('cliente_complemento') ?>">
                                <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Bairro <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="cliente_bairro" placeholder="Informe o bairro" value="<?php echo set_value('cliente_bairro'); ?>">
                                <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>CEP <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control cep" name="cliente_cep" placeholder="Informe o CEP" value="<?php echo set_value('cliente_cep'); ?>">
                                <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-3">
                                <label>Cidade <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="cliente_cidade" placeholder="Informe a cidade" value="<?php echo set_value('cliente_cidade'); ?>">
                                <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>UF <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control uf" name="cliente_estado" placeholder="UF" value="<?php echo set_value('cliente_estado'); ?>">
                                <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Cliente ativo</label>
                                <select name='cliente_ativo' class="form-control">
                                    <option value='1'>Sim</option>
                                    <option value='0'>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>Observações</label>
                            <textarea class="form-control" name="cliente_obs" placeholder="Observações"><?php echo set_value('cliente_obs'); ?></textarea>
                            <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>