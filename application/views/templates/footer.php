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
      $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
      })

      $('.uploadDoc').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('adding/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#id_tracking').val(data.id_tracking);
              $('#modalUploadLabel').html('Upload Dokumen nomor '+data.nomor);
          }
        });
      });

      $('.fileDoc').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('adding/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('.modal-body iframe').attr('src', '<?= base_url('assets/img/doc/');?>'+data.filename);
          }
        });
      });

      function GetFormattedDate(num) {
        var todayTime = new Date(num);
        var month = ("0" + (todayTime.getMonth() + 1)).slice(-2);
        var day = ("0" + todayTime.getDate()).slice(-2);
        var year = todayTime.getFullYear();
        return year + "-" + month + "-" + day;
      }

      $('.modalManifes').on('click', function(){
        $('#nomorManifes').val('');
        var date = new Date();
        docdate = Date.parse(date) 
        $('#doc_dateManifes').val(GetFormattedDate(docdate));
        $('#etaManifes').val(GetFormattedDate(docdate));
        $('#actionManifes').val('add');
        $('#ref_ubah').val('');
        $('#idManifes').val('');
        document.getElementById("ref_ubah").disabled = true;
        document.getElementById("refManifes").disabled = false;
        document.getElementById("divRef").hidden = false;
        $('#posManifes').val('');
        $('#modalManifesLabel').html('Data Manifes Baru');
      });

      $('.ubahDoc').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('adding/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#nomorManifes').val(data.nomor);
              let docdate = data.doc_date*1000;
              $('#doc_dateManifes').val(GetFormattedDate(docdate));
              $('#etaManifes').val(GetFormattedDate(docdate));
              $('#actionManifes').val('edit');
              $('#ref_ubah').val(data.ref);
              $('#idManifes').val(data.id_tracking);
              document.getElementById("ref_ubah").disabled = false;
              document.getElementById("refManifes").disabled = true;
              document.getElementById("divRef").hidden = true;
              $('#posManifes').val(data.pos);
              $('#modalManifesLabel').html('Ubah Data Manifes');
          }
        });
      });

      $('.acceptRKSP').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('pegawai/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#ref').val(data.ref);
              document.getElementById("jenis_respon").hidden = true;
              document.getElementById("respon").required = false;
              $('#modalAcceptLabel').html('Terima Dokumen RKSP nomor '+data.nomor);
              $('.modal-content form').attr('action','<?= base_url('adding/accept/rksp')?>');
          }
        });
      });

      $('.acceptManifes').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('pegawai/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#ref').val(data.ref);
              document.getElementById("jenis_respon").hidden = true;
              document.getElementById("respon").required = false;
              $('#modalAcceptLabel').html('Terima Dokumen Manifes nomor '+data.nomor);
              $('.modal-content form').attr('action','<?= base_url('adding/accept/manifes')?>');
          }
        });
      });

      $('.acceptBongkar').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('pegawai/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#ref').val(data.ref);
              document.getElementById("jenis_respon").hidden = true;
              document.getElementById("respon").required = false;
              $('#modalAcceptLabel').html('Terima Dokumen Pembongkaran nomor '+data.nomor);
              $('.modal-content form').attr('action','<?= base_url('adding/acceptBongkar/bongkar')?>');
          }
        });
      });

      $('.acceptTimbun').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('pegawai/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#ref').val(data.ref);
              document.getElementById("jenis_respon").hidden = true;
              document.getElementById("respon").required = false;
              $('#modalAcceptLabel').html('Terima Dokumen Penimbunan nomor '+data.nomor);
              $('.modal-content form').attr('action','<?= base_url('adding/acceptBongkar/timbun')?>');
          }
        });
      });

      $('.acceptPIB').on('click', function(){
        const id = $(this).data('id');

        $.ajax({
          url: '<?= base_url('pegawai/gettracking/')?>' + id,
          type: 'get',
          dataType: 'JSON',
          success: function(data) {
              $('#ref').val(data.ref);
              document.getElementById("jenis_respon").hidden = false;
              document.getElementById("respon").required = true;
              $('#modalAcceptLabel').html('Terima Dokumen PIB nomor '+data.nomor);
              $('.modal-content form').attr('action','<?= base_url('adding/acceptPIB')?>');
          }
        });
      });

      $('.tampilPosManifes').change(function(){
        const id = $(this).val();
        $('#tes').html(id);

        $.ajax({
          url: '<?= base_url('importir/gettracking/')?>' + id,
          type: 'get',
          dataType: 'html',
          success: function(data) {
              $('select#pos').html(data);
          }
        });
      });
    </script>

    <script src="<?= base_url('assets');?>/js/script.js"></script>
    <script src="<?= base_url('assets');?>/js/pdfobject.min.js"></script>

  </div>

</body>

</html>
