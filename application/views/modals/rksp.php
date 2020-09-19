<div class="modal fade" id="modalRKSP" tabindex="-1" role="dialog" aria-labelledby="modalRKSPLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRKSPLabel">Data RKSP Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('adding/rksp')?>">
        <div class="modal-body">
          
          <div class="form-group">
            <input id="id_doc" name="id_doc" hidden>
            <input id="ref" name="ref" hidden>
            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor RKSP" maxlength="40" required>
          </div>

          <div class="form-group">
            <small>Tanggal RKSP</small>
            <input type="date" class="form-control" id="doc_date" name="doc_date" maxlength="11" value="<?= date('Y-m-d', time())?>" required>
          </div>
          
          <div class="form-group">
            <small>Perkiraan Tiba (ETA)</small>
            <input type="date" class="form-control" id="eta" name="eta" maxlength="11" value="<?= date('Y-m-d', time())?>" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>