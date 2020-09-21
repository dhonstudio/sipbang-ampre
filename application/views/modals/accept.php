<div class="modal fade" id="modalAccept" tabindex="-1" role="dialog" aria-labelledby="modalAcceptLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAcceptLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
        <div class="modal-body">

          <div class="form-group" id="jenis_respon">
            <small>Jenis Respon</small>
            <div class="input-group-prepend">
              <select class="custom-select" id="respon" name="respon">
                <option value="" selected>Pilih</option>
                <option value="billing" <?php if(set_value('respon') == "billing") echo "selected";?>>Billing</option>
                <option value="npbl" <?php if(set_value('respon') == "npbl") echo "selected";?>>NPBL</option>
                <option value="spjk" <?php if(set_value('respon') == "spjk") echo "selected";?>>SPJK</option>
                <option value="spjm" <?php if(set_value('respon') == "spjm") echo "selected";?>>SPJM</option>
                <option value="sppb" <?php if(set_value('respon') == "sppb") echo "selected";?>>SPPB</option>
                <option value="ip" <?php if(set_value('respon') == "ip") echo "selected";?>>IP</option>
                <option value="pemeriksaan" <?php if(set_value('respon') == "pemeriksaan") echo "selected";?>>Mulai Pemeriksaan</option>
                <option value="finish" <?php if(set_value('respon') == "finish") echo "selected";?>>Selesai Pemeriksaan</option>
                <option value="spbl" <?php if(set_value('respon') == "spbl") echo "selected";?>>SPBL</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <input id="ref" name="ref" hidden>
            <small>Tanggal Terima</small>
            <input type="date" class="form-control" id="doc_date" name="doc_date" maxlength="11" value="<?= date('Y-m-d', time())?>" required>
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