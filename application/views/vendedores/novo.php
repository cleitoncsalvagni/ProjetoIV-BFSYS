<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores') ?>">Vendedores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_novo">
                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-user"></i>&nbsp; Dados Pessoais</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Matrícula</label>
                                <input type="text" class="form-control" readonly value="<?php echo $vendedor_codigo ?>" name="vendedor_codigo">
                            </div>

                            <div class="col-md-4">
                                <label>Nome Completo <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="vendedor_nome_completo" placeholder="Informe o nome completo" value="<?php echo set_value('vendedor_nome_completo') ?>">
                                <?php echo form_error('vendedor_nome_completo', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-3">
                                <label>CPF <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control cpf" name="vendedor_cpf" placeholder="Informe o CPF" value="<?php echo set_value('vendedor_cpf') ?>">
                                <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>RG</label>
                                <input type="text" class="form-control" name="vendedor_rg" placeholder="Informe o RG" value="<?php echo set_value('vendedor_rg') ?>">
                                <?php echo form_error('vendedor_rg', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <label>Email <strong class='text-danger'>*</strong></label>
                                <input type="email" class="form-control" name="vendedor_email" placeholder="Informe o email" value="<?php echo set_value('vendedor_email') ?>">
                                <?php echo form_error('vendedor_email', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Celular <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control sp_celphones" name="vendedor_celular" placeholder="Informe o celular" value="<?php echo set_value('vendedor_celular') ?>">
                                <?php echo form_error('vendedor_celular', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Telefone fixo</label>
                                <input type="text" class="form-control phone_with_ddd" name="vendedor_telefone" placeholder="Informe o telefone" value="<?php echo set_value('vendedor_telefone') ?>">
                                <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-map-marker-alt"></i>&nbsp; Endereço</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Endereço <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="vendedor_endereco" placeholder="Informe o endereço" value="<?php echo set_value('vendedor_endereco') ?>">
                                <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>Numero</label>
                                <input type="text" class="form-control" name="vendedor_numero_endereco" placeholder="Informe o número" value="<?php echo set_value('vendedor_numero_endereco') ?>">
                                <?php echo form_error('vendedor_numero_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Bairro <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="vendedor_bairro" placeholder="Informe o bairro" value="<?php echo set_value('vendedor_bairro') ?>">
                                <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Complemento</label>
                                <input type="text" class="form-control" name="vendedor_complemento" placeholder="Informe o complemento" value="<?php echo set_value('vendedor_complemento') ?>">
                                <?php echo form_error('vendedor_complemento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">

                            <div class="col-md-2">
                                <label>CEP <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control cep" name="vendedor_cep" placeholder="Informe o CEP" value="<?php echo set_value('vendedor_cep') ?>">
                                <?php echo form_error('vendedor_cep', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-4">
                                <label>Cidade <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="vendedor_cidade" placeholder="Informe a cidade" value="<?php echo set_value('vendedor_cidade') ?>">
                                <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>UF <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control uf" name="vendedor_estado" placeholder="UF" value="<?php echo set_value('vendedor_estado') ?>">
                                <?php echo form_error('vendedor_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Vendedor ativo</label>
                                <select name='vendedor_ativo' class="form-control">
                                    <option value='1'>Sim</option>
                                    <option value='0'>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Observações</label>
                            <textarea class="form-control" name="vendedor_obs" placeholder="Observações"><?php echo set_value('vendedor_obs') ?></textarea>
                            <?php echo form_error('vendedor_obs', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>