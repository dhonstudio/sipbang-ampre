<div class="modal fade" id="modalTrack" tabindex="-1" role="dialog" aria-labelledby="modalTrackLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTrackLabel">Tracking Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('pegawai/tracking')?>">
        <div class="modal-body">

          <div class="form-group">
            <small>Jenis Dokumen</small>
            <div class="input-group-prepend">
              <select class="custom-select" id="jenis" name="jenis">
                <option value="" selected>Pilih</option>
                <option value="rksp" <?php if(set_value('jenis') == "rksp") echo "selected";?>>RKSP</option>
                <option value="manifes" <?php if(set_value('jenis') == "manifes") echo "selected";?>>Manifes</option>
                <option value="pib" <?php if(set_value('jenis') == "pib") echo "selected";?>>PIB</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Dokumen" maxlength="40" required>
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