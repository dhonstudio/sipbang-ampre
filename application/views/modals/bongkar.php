<div class="modal fade" id="modalBongkar" tabindex="-1" role="dialog" aria-labelledby="modalBongkarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBongkarLabel">Waktu Bongkar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?= base_url('adding/bongkar')?>">
        <div class="modal-body">
          
          <div class="form-group">
            <small>Nomor Manifes</small>
            <div class="input-group-prepend">
              <select class="custom-select" id="ref" name="ref" required>
                <option value="" selected>Pilih</option>
                <?php foreach ($refmanifes as $r) :?>
                  <option value="<?= $r['ref'] ?>" <?php if(set_value('ref') == $r['ref']) echo "selected";?>><?= $r['nomor']?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <small>Tanggal Selesai</small>
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