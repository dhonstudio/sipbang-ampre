<style>
    @media screen and (max-width: 600px) {
      .tabel_el {
        display:none;
      }
      
      .square_el {
        display:inline;
      }
    }
    
    @media screen and (min-width: 601px) {
      .square_el {
        display:none;
      }
    }
</style>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-4 text-gray-800"><?= $maintitle?></h1>

          <div class="row">
            <div class="col-lg-12">

              <?= $this->session->flashdata('message');?>

              <div class="row">
                <div class="col">
                  <?php echo $pagination; ?>
                </div>
              </div>

              <table class="table table-hover tabel_el">
                <thead>
                  <tr>
                    <th scope="col">Nomor RKSP</th>
                    <th scope="col">Doc Date</th>
                    <th scope="col">ETA</th>
                    <th scope="col">Owner</th>
                    <th scope="col">Input Date</th>
                    <th scope="col">File</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rksp as $p) : ?>
                  <tr>
                    <td><?= $p['nomor'];?></td>
                    <td><?= date('d F Y', $p['doc_date']);?></td>
                    <td><?= date('d F Y', $p['eta']);?></td>
                    <td><?= $p['name'];?></td>
                    <td><?= date('d/m/Y H:i', $p['stamp']);?></td>
                    <td></td>
                    <td>
                      <?php if ($this->user->numAccept($p['ref'], 'accept_rksp') == 0) :?>
                      <a href="#" class="badge badge-success acceptRKSP" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modalAccept">Accept</a>
                      <?php endif;?>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <table class="table table-hover square_el">
                <thead>
                  <tr>
                    <th scope="col">Nomor RKSP</th>
                    <th scope="col">ETA</th>
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($rksp as $p) : ?>
                  <tr>
                    <td><b><?= $p['nomor'];?></b><br><?= $p['name'];?><br><?= date('d/m/Y', $p['doc_date']);?></td>
                    <td><?= date('d/m/Y', $p['eta']);?></td>
                    <td>
                      <?php if ($this->user->numAccept($p['ref'], 'accept_rksp') == 0) :?>
                      <a href="#" class="badge badge-success acceptRKSP" data-id="<?= $p['id_tracking'];?>" data-toggle="modal" data-target="#modalAccept">Accept</a>
                      <?php endif;?>
                    </td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <div class="row">
                  <div class="col">
                      <?php echo $pagination; ?>
                  </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->