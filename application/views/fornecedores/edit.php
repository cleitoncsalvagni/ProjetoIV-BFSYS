<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores') ?>">Fornecedores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_edit">

                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:&nbsp;</strong><?php echo formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao) ?></p>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-building"></i>&nbsp; Dados Empresa</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Razão Social</label>
                                <input type="text" class="form-control" name="fornecedor_razao" placeholder="Informe a razão social" value="<?php echo $fornecedor->fornecedor_razao; ?>">
                                <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">', '</small>') ?>

                            </div>

                            <div class="col-md-4">
                                <label>Nome Fantasia</label>
                                <input type="text" class="form-control form-control-user" name="fornecedor_nome_fantasia" placeholder="Informe o nome fantasia" value="<?php echo $fornecedor->fornecedor_nome_fantasia; ?>">
                                <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-4">
                                <label>CNPJ</label>
                                <input type="text" class="form-control cnpj" name="fornecedor_cnpj" placeholder="Informe o CNPJ" value="<?php echo $fornecedor->fornecedor_cnpj; ?>">
                                <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <label>Inscrição Estadual</label>
                                <input type="text" class="form-control" name="fornecedor_ie" placeholder="Informe a inscrição estadual" value="<?php echo $fornecedor->fornecedor_ie; ?>">
                                <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-phone"></i>&nbsp; Contato</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-3">
                                <label>Email</label>
                                <input type="text" class="form-control" name="fornecedor_email" placeholder="Informe o email" value="<?php echo $fornecedor->fornecedor_email; ?>">
                                <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">', '</small>') ?>
                            </div>


                            <div class="col-md-3">
                                <label>Telefone fixo</label>
                                <input type="text" class="form-control phone_with_ddd" name="fornecedor_telefone" placeholder="Informe o telefone" value="<?php echo $fornecedor->fornecedor_telefone; ?>">
                                <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">', '</small>') ?>
                            </div>


                            <div class="col-md-3">
                                <label>Celular</label>
                                <input type="text" class="form-control sp_celphones" name="fornecedor_celular" placeholder="Informe o celular" value="<?php echo $fornecedor->fornecedor_celular; ?>">
                                <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Contato</label>
                                <input type="text" class="form-control" name="fornecedor_contato" placeholder="Informe o nome do contato" value="<?php echo $fornecedor->fornecedor_contato; ?>">
                                <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-map-marker-alt"></i>&nbsp; Endereço</legend>
                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="fornecedor_endereco" placeholder="Informe o endereço" value="<?php echo $fornecedor->fornecedor_endereco; ?>">
                                <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>Numero</label>
                                <input type="text" class="form-control" name="fornecedor_numero_endereco" placeholder="Informe o número" value="<?php echo $fornecedor->fornecedor_numero_endereco; ?>">
                                <?php echo form_error('fornecedor_numero_endereco', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-6">
                                <label>Complemento</label>
                                <input type="text" class="form-control" name="fornecedor_complemento" placeholder="Informe o complemento" value="<?php echo $fornecedor->fornecedor_complemento; ?>">
                                <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Bairro</label>
                                <input type="text" class="form-control" name="fornecedor_bairro" placeholder="Informe o bairro" value="<?php echo $fornecedor->fornecedor_bairro; ?>">
                                <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-2">
                                <label>CEP</label>
                                <input type="text" class="form-control cep" name="fornecedor_cep" placeholder="Informe o CEP" value="<?php echo $fornecedor->fornecedor_cep; ?>">
                                <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-4">
                                <label>Cidade</label>
                                <input type="text" class="form-control" name="fornecedor_cidade" placeholder="Informe a cidade" value="<?php echo $fornecedor->fornecedor_cidade; ?>">
                                <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                            <div class="col-md-1">
                                <label>UF</label>
                                <input type="text" class="form-control uf" name="fornecedor_estado" placeholder="UF" value="<?php echo $fornecedor->fornecedor_estado; ?>">
                                <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-user-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Fornecedor ativo</label>
                                <select name='fornecedor_ativo' class="form-control">
                                    <option value='1' <?php echo ($fornecedor->fornecedor_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label>Observações</label>
                            <textarea class="form-control" name="fornecedor_obs" placeholder="Observações"><?php echo $fornecedor->fornecedor_obs ?></textarea>
                            <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>


                    <input type='hidden' name='fornecedor_id' value="<?php echo $fornecedor->fornecedor_id; ?>">

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>