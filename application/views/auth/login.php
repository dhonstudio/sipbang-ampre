  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card o-hidden border-1 mb-0 mt-4">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg">
                <div class="px-5 pt-3 mb-5">
                  
                  <div class="text-center mb-3" style="color:black">
                    <img src="<?= base_url('assets/img/');?>logo.png" width="70" alt="Logo">
                    <h6 class="mb-0"><b>SIP Bang</b></h6>
                    <h6><small>Sistem Informasi Pergerakan Barang</small></h6>
                    <h4>
                      <b><?php
                      if($type == 'username') echo "Masukkan Username"; 
                      else echo $user['name'];
                      ?></b>
                    </h4>
                  </div>

                  <?= $this->session->flashdata('message');?>

                  <form class="user" method="post" action="<?= base_url('auth');?><?php 
                  if ($type == 'password') echo '/index/password/'.$username;
                  if ($type == 'reset') echo '/index/reset/'.$username;
                  ?>">
                    
                    <div class="form-group" <?php if($type != 'username') echo "hidden";?>>
                      <input type="text" class="form-control py-4" id="user" name="user" placeholder="Username" maxlength="20" value="<?= set_value('user');?>">
                      <?= form_error('user', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    
                    <div class="form-group" <?php if($type == 'username') echo "hidden";?>>
                      <input type="password" class="form-control py-4" id="pass" name="pass" placeholder="Kata Sandi" maxlength="20" value="<?= set_value('pass');?>">
                      <?= form_error('pass', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    
                    <div class="form-group" <?php if($type != 'reset') echo "hidden";?>>
                      <input type="password" class="form-control py-4" id="pass2" name="pass2" placeholder="Ulangi Kata Sandi" maxlength="20" value="">
                      <?= form_error('pass2', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    
                    <div class="row mt-3 mr-1 justify-content-end">
                        <button type="submit" class="btn btn-primary"><small class="font-weight-bold">Berikutnya</small></button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row mt-2 mr-1 justify-content-end">
            <a class="small" href="https://wa.me/6287700889913">Bantuan</a>
        </div>

      </div>
    </div>
  </div>