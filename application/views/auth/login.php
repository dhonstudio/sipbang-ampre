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
                      <b id="usernameLabel"><?php
                      if($type == 'username') {
                        if ($ncookies == 0 || (isset($_GET['username']) && $_GET['username'] == '')) echo "Masukkan Username";
                        else echo "Pilih Akun";
                      } else {
                        echo $user['name'];
                      }
                      ?></b>
                    </h4>
                  </div>

                  <?= $this->session->flashdata('message');?>

                  <form id="username" class="user" method="post" action="<?= base_url('auth');?><?php
                  if ($type == 'password') echo '/index/password/'.$username;
                  if ($type == 'reset') echo '/index/reset/'.$username;
                  ?>">

                    <?php if($type == 'username'):?>
                      <?php if ($ncookies == 0 || (isset($_GET['username']) && $_GET['username'] == '')) :?>
                        <div class="form-group">
                          <input type="text" class="form-control py-4" id="user" name="user" placeholder="Username" maxlength="20" value="<?= set_value('user');?>">
                          <?= form_error('user', '<small class="text-danger pl-3">', '</small>');?>
                        </div>
                        <?php else :?>
                        <table class="table table-hover">
                          <?php foreach ($cookies as $p) : ?>
                          <tr class="border-bottom">
                            <td><a href="<?= base_url('auth/index/password');?>/<?= $p['user']?>" class="text-decoration-none"><div class="text-dark"><?= $p['user'];?><br><small><?php $usercookie = $this->db->get_where('users', ['user' => $p['user']])->row_array(); echo $usercookie['name'];?></small></div></a>
                            </td>
                          </tr>
                          <?php endforeach;?>
                          <tr class="border-bottom">
                            <td class="text-dark"><a href="<?= base_url('auth');?>?username=" class="text-decoration-none"><div id="formDisplay" class="text-dark">Gunakan akun lain</div></a>
                            </td>
                          </tr>
                        </table>
                      <?php endif;?>
                    <?php endif;?>
                    
                    <?php if($type != 'username'):?>
                      <div class="form-group">
                        <input type="password" class="form-control py-4" id="pass" name="pass" placeholder="Kata Sandi" maxlength="20" value="<?= set_value('pass');?>">
                        <?= form_error('pass', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                    <?php endif;?>
                    
                    <?php if($type == 'reset'):?>
                      <div class="form-group">
                        <input type="password" class="form-control py-4" id="pass2" name="pass2" placeholder="Ulangi Kata Sandi" maxlength="20" value="">
                        <?= form_error('pass2', '<small class="text-danger pl-3">', '</small>');?>
                      </div>
                    <?php endif;?>
                    
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