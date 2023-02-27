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
                <form method="POST" name="form_edit">

                    <p><strong><i class="fas fa-clock"></i>&nbsp;&nbsp;Última alteração:&nbsp;</strong><?php echo formata_data_banco_com_hora($produto->produto_data_alteracao) ?></p>

                    <fieldset class='mt-4 border p-3'>
                        <legend class='small'><i class="fab fa-product-hunt"></i>&nbsp; Informações do produto</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Código</label>
                                <input type="text" class="form-control" name="produto_codigo" readonly value="<?php echo $produto->produto_codigo; ?>">
                            </div>

                            <div class="col-md-10">
                                <label>Descrição</label>
                                <input type="text" class="form-control" name="produto_descricao" placeholder="Informe a descrição do produto" value="<?php echo $produto->produto_descricao; ?>">
                                <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>') ?>

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-4">
                                <label>Marca</label>
                                <select class='custom-select' name='produto_marca_id'>
                                    <?php foreach ($marcas as $marca) : ?>
                                        <option value="<?php echo $marca->marca_id ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected' : '') ?> <?php echo ($marca->marca_ativa == 0 ? 'disabled' : '') ?>>
                                            <?php echo $marca->marca_nome ?>&nbsp;<?php echo ($marca->marca_ativa == 0 ? '(Desativada)' : '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Categoria</label>
                                <select class='custom-select' name='produto_categoria_id'>
                                    <?php foreach ($categorias as $categoria) : ?>
                                        <option value="<?php echo $categoria->categoria_id ?>" <?php echo ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : '') ?> <?php echo ($categoria->categoria_ativa == 0 ? 'disabled' : '') ?>>
                                            <?php echo $categoria->categoria_nome ?>&nbsp;<?php echo ($categoria->categoria_ativa == 0 ? '(Desativada)' : '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Fornecedor</label>
                                <select class='custom-select' name='produto_fornecedor_id'>
                                    <?php foreach ($fornecedores as $fornecedor) : ?>
                                        <option value="<?php echo $fornecedor->fornecedor_id ?>" <?php echo ($fornecedor->fornecedor_id == $produto->produto_fornecedor_id ? 'selected' : '') ?> <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'disabled' : '') ?>>
                                            <?php echo $fornecedor->fornecedor_nome_fantasia ?>&nbsp;<?php echo ($fornecedor->fornecedor_ativo == 0 ? '(Desativada)' : '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='mt-4 border p-3 mb-3'>
                        <legend class='small'><i class="fas fa-cog"></i>&nbsp; Preferências</legend>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label>Serviço ativo</label>
                                <select name='produto_ativo' class="form-control">
                                    <option value='1' <?php echo ($produto->produto_ativo == 1 ? 'selected' : '') ?>>Sim</option>
                                    <option value='0' <?php echo ($produto->produto_ativo == 0 ? 'selected' : '') ?>>Não</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <input type='hidden' name='produto_id' value="<?php echo $produto->produto_id; ?>">

                    <button type="submit" class="btn btn-success btn-sm ">Salvar</button>
                    <a href='<?php echo base_url($this->router->fetch_class()) ?>' title='Voltar' class='btn btn-primary btn-sm ml-2'>Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>