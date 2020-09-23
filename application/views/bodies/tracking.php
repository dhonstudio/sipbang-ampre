
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <h1 class="h3 mb-4 text-gray-800"><?= $maintitle?></h1>

          <div class="row">
            <div class="col-lg-12">

              <?= $this->session->flashdata('message');?>

              <table class="table table-hover">
                <tbody>
                  <?php foreach ($tracking as $p) : ?>
                    <?php
                      if ($p['jenis'] == "rksp") $stat = "telah menginput RKSP";
                      if ($p['jenis'] == "accept_rksp") $stat = "telah menerima RKSP";
                      if ($p['jenis'] == "manifes") $stat = "telah menginput Manifes No ".$p['nomor']." dengan Pos: ".$p['pos'];
                      if ($p['jenis'] == "ubah_manifes") $stat = "telah menginput Manifes No ".$p['nomor']." dengan Pos: ".$p['pos']." dan telah diubah";
                      if ($p['jenis'] == "accept_manifes") $stat = "telah menerima Manifes";
                      if ($p['jenis'] == "bongkar") $stat = "telah selesai melakukan pembongkaran";
                      if ($p['jenis'] == "accept_bongkar") $stat = "telah mengawasi pembongkaran";
                      if ($p['jenis'] == "timbun") $stat = "telah selesai melakukan penimbunan";
                      if ($p['jenis'] == "accept_timbun") $stat = "telah mengawasi penimbunan";
                      if ($p['jenis'] == "pib") $stat = "telah mengajukan PIB No ".$p['nomor']." atas Manifes No ".$p['no_manifes']." Pos ".$p['pos'];
                      if ($p['jenis'] == "billing") $stat = "telah menerbitkan Billing";
                      if ($p['jenis'] == "npbl") $stat = "telah menerbitkan NPBL";
                      if ($p['jenis'] == "spjk") $stat = "telah menerbitkan SPJK";
                      if ($p['jenis'] == "spjm") $stat = "telah menerbitkan SPJM";
                      if ($p['jenis'] == "sppb") $stat = "telah menerbitkan SPPB";
                      if ($p['jenis'] == "ip") $stat = "telah menerbitkan Instruksi Pemeriksaan";
                      if ($p['jenis'] == "mp") $stat = "telah memulai pemeriksaan";
                      if ($p['jenis'] == "sp") $stat = "telah selesai melakukan pemeriksaan";
                      if ($p['jenis'] == "spbl") $stat = "telah menerbitkan SPBL";
                    ?>
                  <tr>
                    <td><img width="20px" src="<?= base_url('assets/img/');?>track.png"></td>
                    <td><?= date('d F Y', $p['stamp']);?></td>
                    <td><b><?= $p['name'];?></b></td>
                    <td><?= $stat?></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->