<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
    Cadastros
  </div>


  <li class="nav-item <?php echo $this->router->fetch_class() == 'clientes' ? 'active' : '' ?>">
    <a title='Gerenciar usuários' class="nav-link" href="<?php echo base_url('clientes'); ?>">
      <i class="fas fa-fw fa-user-tie"></i>
      <span>Clientes</span></a>
  </li>


  <hr class="sidebar-divider">


  <div class="sidebar-heading">
    Configurações
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