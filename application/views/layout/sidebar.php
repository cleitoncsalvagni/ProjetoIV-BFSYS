<ul class="navbar-nav bg-gradient-light sidebar sidebar-primary accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/') ?>">
    <div class="sidebar-brand-icon">
      <i class="fas fa-chart-pie"></i> <!-- FEATURE: CLIENTE ADICIONAR O NOME DA EMPRESA/LOGO --->
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
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-database"></i>
      <span>Cadastros</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
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

      <i class="fas fa-boxes"></i>
      <span>Estoque</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-light py-2 collapse-inner rounded">
        <h6 class="collapse-header">Escolha uma opção:</h6>
        <a class="collapse-item" title='Gerenciar Produtos' href="<?php echo base_url('produtos') ?>"><i class="fas fa-box-open text-gray-700"></i>&nbsp;&nbsp;Produtos</a>
        <a class="collapse-item" title='Gerenciar Marcas' href="<?php echo base_url('marcas') ?>"><i class="fas fa-tags text-gray-700"></i>&nbsp;&nbsp;Marcas</a>
        <a class="collapse-item" title='Gerenciar Categorias' href="<?php echo base_url('categorias') ?>"><i class="fab fa-buffer text-gray-700"></i>&nbsp;&nbsp;Categorias</a>
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