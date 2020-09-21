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
                    <th scope="col">Nomor Manifes</th>
                    <th scope="col">Doc Date</th>
                    <th scope="col">Arrival</th>
                    <th scope="col">Input Date</th>
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($manifes as $p) : ?>
                  <tr>
                    <td><?= $p['nomor'];?></td>
                    <td><?= date('d F Y', $p['doc_date']);?></td>
                    <td><?= date('d F Y', $p['eta']);?></td>
                    <td><?= date('d/m/Y H:i', $p['stamp']);?></td>
                    <td></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>

              <table class="table table-hover square_el">
                <thead>
                  <tr>
                    <th scope="col">Nomor Manifes</th>
                    <th scope="col">Arrival</th>
                    <th scope="col">File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($manifes as $p) : ?>
                  <tr>
                    <td><b><?= $p['nomor'];?></b><br><?= date('d/m/Y', $p['doc_date']);?></td>
                    <td><?= date('d/m/Y', $p['eta']);?></td>
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