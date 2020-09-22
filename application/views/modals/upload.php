<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-labelledby="modalUploadLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUploadLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open_multipart('adding/uploaddoc');?>
        <div class="modal-body">

          <div class="form-group">
            <input id="id_tracking" name="id_tracking" hidden>
            <input id="user" name="user" hidden value="<?= $this->uri->segment(1);?>">
            <input id="doc" name="doc" hidden value="<?= $this->uri->segment(2);?>">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="image" name="image" required>
              <label class="custom-file-label" for="image">Unggah Dokumen</label>
            </div>
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