<?php $this->load->view("layout/sidebar"); ?>
<div id="content">
    <?php $this->load->view("layout/navbar") ?>
    <div class="container-fluid">


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('produtos') ?>">Produtos</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $pageTitle ?></li>
            </ol>
        </nav>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="POST" name="form_novo">
                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-file-alt"></i>&nbsp; Informações do produto</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Código</label>
                                <input type="text" class="form-control" name="produto_codigo" readonly value="<?php echo $produto_codigo; ?>">
                            </div>

                            <div class="col-md-10">
                                <label>Descrição <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="produto_descricao" placeholder="Informe a descrição do produto" value="<?php echo set_value('produto_descricao') ?>">
                                <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>') ?>

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Marca</label>
                                <select class='custom-select' name='produto_marca_id'>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?php echo $marca->marca_id ?>">
                                            <?php echo $marca->marca_nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <a href='<?php echo base_url('Marcas') ?>' class="btn btn-link btn-sm mt-2"><i class="fas fa-plus-circle"></i>&nbsp;Cadastrar Marcas</a>
                            </div>
                            <div class="col-md-4">
                                <label>Categoria</label>
                                <select class='custom-select' name='produto_categoria_id'>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?php echo $categoria->categoria_id ?>">
                                            <?php echo $categoria->categoria_nome ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <a href='<?php echo base_url('categorias') ?>' class="btn btn-link btn-sm mt-2"><i class="fas fa-plus-circle"></i>&nbsp;Cadastrar Categorias</a>
                            </div>

                            <div class="col-md-4">
                                <label>Fornecedor</label>
                                <select class='custom-select' name='produto_fornecedor_id'>
                                    <?php foreach ($fornecedores as $fornecedor) : ?>
                                        <option value="<?php echo $fornecedor->fornecedor_id ?>">
                                            <?php echo $fornecedor->fornecedor_nome_fantasia ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <a href='<?php echo base_url('fornecedores') ?>' class="btn btn-link btn-sm mt-2"><i class="fas fa-plus-circle"></i>&nbsp;Cadastrar Fornecedor</a>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fas fa-money-bill-wave"></i>&nbsp; Venda e Estoque</legend>


                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Unidade <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control" name="produto_unidade" placeholder="Ex: UN" value="<?php echo set_value('produto_unidade') ?>">
                                <?php echo form_error('produto_unidade', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>Estoque mínimo <strong class='text-danger'>*</strong></label>
                                <input type="number" class="form-control" name="produto_estoque_minimo" placeholder="Mínimo" value="<?php echo set_value('produto_estoque_minimo') ?>">
                                <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-2">
                                <label>Estoque atual <strong class='text-danger'>*</strong></label>
                                <input type="number" class="form-control" name="produto_qtde_estoque" placeholder="Atual" value="<?php echo set_value('produto_qtde_estoque') ?>">
                                <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Preço de custo <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control money" name="produto_preco_custo" placeholder="Preço de custo" value="<?php echo set_value('produto_preco_custo') ?>">
                                <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">', '</small>') ?>
                            </div>

                            <div class="col-md-3">
                                <label>Preço de venda <strong class='text-danger'>*</strong></label>
                                <input type="text" class="form-control money" name="produto_preco_venda" placeholder="Preço de venda" value="<?php echo set_value('produto_preco_venda') ?>">
                                <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">', '</small>') ?>
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Produto ativo</label>
                                <select name='produto_ativo' class="form-control">
                                    <option value='1'>Sim</option>
                                    <option value='0'>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group row">
                        <div class="col-md-8">
                            <label>Observações</label>
                            <textarea class="form-control" name="produto_obs" placeholder="Observações"><?php echo set_value('produto_obs') ?></textarea>
                            <?php echo form_error('produto_obs', '<small class="form-text text-danger">', '</small>') ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>