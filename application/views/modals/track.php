<div class="modal fade" id="modalTrack" tabindex="-1" role="dialog" aria-labelledby="modalTrackLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="contentModalTrack">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTrackLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
        <div class="modal-body">
          
          <div class="form-group" id="refDiv">
            <small id="refLabel"></small>
            <div class="input-group-prepend">
              <select class="custom-select" id="refRKSP" name="refRKSP">
                <option value="" selected>Pilih</option>
                <?php foreach ($ref as $r) :?>
                  <option value="<?= $r['ref'] ?>" <?php if(set_value('refRKSP') == $r['ref']) echo "selected";?>><?= $r['nomor']?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group" id="nomorDiv">
            <input id="id_doc" name="id_doc" hidden>
            <input id="ref" name="ref" hidden>
            <input type="text" class="form-control" id="nomor" name="nomor" placeholder="" maxlength="40">
          </div>
          <div class="form-group">
            <small id="doc_dateLabel"></small>
            <input type="date" class="form-control" id="doc_date" name="doc_date" maxlength="11" value="<?= date('Y-m-d', time())?>">
          </div>
          <div class="form-group">
            <small id="etaLabel"></small>
            <input type="date" class="form-control" id="eta" name="eta" maxlength="11" value="<?= date('Y-m-d', time())?>">
          </div>
          <div class="form-group" id="posDiv">
            <input type="text" class="form-control" id="pos" name="pos" placeholder="Pos Manifes (pisahkan dengan koma)" maxlength="500">
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