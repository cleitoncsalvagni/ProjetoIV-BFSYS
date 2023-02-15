<?php if (!$this->router->fetch_class() == 'login') : ?>

  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <!-- <span>Copyright &copy; BFSYS <?php echo date('Y') ?></span> -->
        <span>Copyright &copy; BFSYS <?php echo date('Y') ?> | Por Cleiton Salvagni</span>
      </div>
    </div>
  </footer>

<?php endif; ?>


</div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <text class="modal-title">Deseja mesmo sair?</text>

        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-sm" href="<?php echo base_url('login/logout') ?>">Sair</a>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url("public/vendor/jquery/jquery.min.js"); ?>"></script>

<script src="<?php echo base_url("public/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

<script src="<?php echo base_url("public/vendor/jquery-easing/jquery.easing.min.js"); ?>"></script>

<script src="<?php echo base_url("public/js/sb-admin-2.min.js") ?>"></script>


<?php if (isset($scripts)) : ?>

  <?php foreach ($scripts as $script) : ?>

    <script src="<?php echo base_url("public/" . $script); ?>"></script>

  <?php endforeach; ?>

<?php endif; ?>

</body>

</html>