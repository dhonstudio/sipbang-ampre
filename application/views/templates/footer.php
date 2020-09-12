        <footer class="sticky-footer bg-white fixed-bottom">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Dhon Studio <?= date('Y')?></span>
            </div>
          </div>
        </footer>

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin untuk Keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!--<div class="modal-body"></div>-->
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-danger" href="<?= base_url('auth/logout');?>">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets');?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets');?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets');?>/vendor/sb-admin-2/js/sb-admin-2.min.js"></script>

    <script>
      $('.addRKSP').on('click', function(){
        var addAction = '<?= base_url('adding/rksp')?>';

        $('#modalTrackLabel').html('Data RKSP Baru');
        $('#doc_dateLabel').html('Tanggal RKSP');
        $('#etaLabel').html('Perkiraan Tiba (ETA)');
        $('#contentModalTrack form').attr('action',addAction);
        document.getElementById("nomor").required = true;
        document.getElementById("doc_date").required = true;
        document.getElementById("eta").required = true;
      });
    </script>

    <script src="<?= base_url('assets');?>/js/script.js"></script>

  </div>

</body>

</html>
