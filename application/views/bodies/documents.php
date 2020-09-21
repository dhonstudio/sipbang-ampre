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
                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">Nomor RKSP</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Nomor Manifes</th>
                        <?php elseif ($subtitle == 'Pembongkaran'):?>
                          <th scope="col">Nomor Pembongkaran</th>
                          <?php elseif ($subtitle == 'Penimbunan'):?>
                            <th scope="col">Nomor Penimbunan</th>
                          <?php endif;?>

                    <?php if ($subtitle == 'Pembongkaran'):?>
                      <th scope="col">Waktu Bongkar</th>
                      <?php elseif ($subtitle == 'Penimbunan'):?>
                        <th scope="col">Waktu Timbun</th>
                        <?php else:?>
                          <th scope="col">Doc Date</th>
                        <?php endif;?>

                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">ETA</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Arrival</th>
                      <?php endif;?>

                    <th scope="col">Input Date</th>
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($documents as $p) : ?>
                  <tr>
                    <td><?= $p['nomor'];?></td>
                    <td><?= date('d F Y', $p['doc_date']);?></td>

                    <?php if ($subtitle != 'Pembongkaran' || $subtitle != 'Penimbunan'):?>
                      <td><?= date('d F Y', $p['eta']);?></td>
                    <?php endif;?>

                    <td><?= date('d/m/Y H:i', $p['stamp']);?></td>
                    <td></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <table class="table table-hover square_el">
                <thead>
                  <tr>
                    <?php if ($subtitle == 'RKSP'):?>
                      <th scope="col">Nomor RKSP</th>
                      <th scope="col">ETA</th>
                      <?php elseif ($subtitle == 'Manifes'):?>
                        <th scope="col">Nomor Manifes</th>
                        <th scope="col">Arrival</th>
                        <?php elseif ($subtitle == 'Pembongkaran'):?>
                          <th scope="col">Nomor Pembongkaran</th>
                          <th scope="col">Waktu Bongkar</th>
                          <?php elseif ($subtitle == 'Penimbunan'):?>
                            <th scope="col">Nomor Penimbunan</th>
                            <th scope="col">Waktu Timbun</th>
                          <?php endif;?>
                    
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($documents as $p) : ?>
                  <tr>
                    <?php if ($subtitle != 'Pembongkaran' || $subtitle != 'Penimbunan'):?>
                      <td><b><?= $p['nomor'];?></b></td>
                      <td><?= date('d/m/Y', $p['doc_date']);?></td>
                      <?php else:?>
                        <td><b><?= $p['nomor'];?></b><br><?= date('d/m/Y', $p['doc_date']);?></td>
                        <td><?= date('d/m/Y', $p['eta']);?></td>
                      <?php endif;?>

                    <td></td>
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