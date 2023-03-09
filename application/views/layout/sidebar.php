<ul class="navbar-nav bg-gradient-light sidebar sidebar-primary accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/') ?>">
    <div class="sidebar-brand-icon">
      <img src="http://[::1]/bfsys/public/img/bfsys_logo_icon.svg" style='width: 3rem;' class="img-fluid" alt="...">
    </div>
    <div class="sidebar-brand-text mx-3">BFSYS</div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item <?php echo $this->router->fetch_class() == 'home' ? 'active' : '' ?>">
    <a class="nav-link" href="<?php echo base_url('/') ?>">
      <i class="fas fa-fw fa-home"></i>
      <span>Início</span></a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Módulos
  </div>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <i class="fas fa-shopping-cart"></i>
      <span>Vendas</span>
    </a>
    <div id="collapseOne" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-light py-2 collapse-inner rounded">
        <h6 class="collapse-header">Escolha uma opção:</h6>
        <a class="collapse-item" title='Gerenciar O.S' href="<?php echo base_url('os') ?>"><i class="fas fa-file-invoice-dollar text-gray-700"></i>&nbsp;&nbsp;Ordens de Serviço</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-database"></i>
      <span>Cadastros</span>
    </a>
    <div id="collapseTwo" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-light py-2 collapse-inner rounded">
        <h6 class="collapse-header">Escolha uma opção:</h6>
        <a class="collapse-item" title='Gerenciar Clientes' href="<?php echo base_url('clientes') ?>"><i class="fas fa-user-tie text-gray-700"></i>&nbsp;&nbsp;Clientes</a>
        <a class="collapse-item" title='Gerenciar Fornecedores' href="<?php echo base_url('fornecedores') ?>"><i class="fas fa-box text-gray-700"></i>&nbsp;&nbsp;Fornecedores</a>
        <a class="collapse-item" title='Gerenciar Vendedores' href="<?php echo base_url('vendedores') ?>"><i class="fas fa-users text-gray-700"></i>&nbsp;&nbsp;Vendedores</a>
        <a class="collapse-item" title='Gerenciar Serviços' href="<?php echo base_url('servicos') ?>"><i class="fas fa-tools text-gray-700"></i>&nbsp;&nbsp;Serviços</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">

      <i class="fas fa-box"></i>
      <span>Estoque</span>
    </a>
    <div id="collapseThree" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-light py-2 collapse-inner rounded">
        <h6 class="collapse-header">Escolha uma opção:</h6>
        <a class="collapse-item" title='Gerenciar Produtos' href="<?php echo base_url('produtos') ?>"><i class="fas fa-box-open text-gray-700"></i>&nbsp;&nbsp;Produtos</a>
        <a class="collapse-item" title='Gerenciar Marcas' href="<?php echo base_url('marcas') ?>"><i class="fas fa-tags text-gray-700"></i>&nbsp;&nbsp;Marcas</a>
        <a class="collapse-item" title='Gerenciar Categorias' href="<?php echo base_url('categorias') ?>"><i class="fab fa-buffer text-gray-700"></i>&nbsp;&nbsp;Categorias</a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">

      <i class="fas fa-money-bill-alt"></i>
      <span>Financeiro</span>
    </a>
    <div id="collapseFour" class="collapse" data-parent="#accordionSidebar">
      <div class="bg-light py-2 collapse-inner rounded">
        <h6 class="collapse-header">Escolha uma opção:</h6>
        <a class="collapse-item" title='Gerenciar contas a pagar' href="<?php echo base_url('pagar') ?>"><i class="fas fa-receipt text-gray-700"></i>&nbsp;&nbsp;Contas a Pagar</a>
        <a class="collapse-item" title='Gerenciar contas a receber' href="<?php echo base_url('receber') ?>"><i class="fas fa-hand-holding-usd text-gray-700"></i>&nbsp;&nbsp;Contas a Receber</a>
        <a class="collapse-item" title='Gerenciar formas de pagamento' href="<?php echo base_url('formas') ?>"><i class="fas fa-money-check-alt text-gray-700"></i>&nbsp;&nbsp;Formas Pagamento</a>
      </div>
    </div>
  </li>



  <hr class="sidebar-divider">


  <div class="sidebar-heading">
    Ajustes
  </div>

  <li class="nav-item <?php echo $this->router->fetch_class() == 'usuarios' ? 'active' : '' ?>">
    <a title='Gerenciar usuários' class="nav-link" href="<?php echo base_url('usuarios'); ?>">
      <i class="fas fa-fw fa-users"></i>
      <span>Usuários</span></a>
  </li>

  <li class="nav-item <?php echo $this->router->fetch_class() == 'sistema' ? 'active' : '' ?>">
    <a title='Gerenciar dados do sistema' class="nav-link" href="<?php echo base_url('sistema'); ?>">
      <i class="fas fa-cogs"></i>
      <span>Sistema</span></a>
  </li>


  <hr class="sidebar-divider d-none d-md-block">


  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>


<div id="content-wrapper" class="d-flex flex-column">