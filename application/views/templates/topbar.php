<style>
    @media screen and (max-width: 600px) {
      .toggles_el {
        display:none;
      }
      
      .togglet_el {
        display:inline;
      }
    }
    
    @media screen and (min-width: 601px) {
      .togglet_el {
        display:none;
      }
    }
</style>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 toggles_el">
            <i class="fa fa-bars"></i>
          </button>

          <div class="dropdown togglet_el">
            <button class="btn btn-light navbar-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <?php
                $sebagai = $user['sebagai'];
                $querySubMenu = "SELECT *
                                FROM `user_sub_menu`
                               WHERE `sebagai` = '$sebagai'
                               AND `is_active` = 1
                               ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
              ?>

              <?php foreach ($subMenu as $sm) :?>
                <?php if ($subtitle == $sm['title']) :?>
                <a class="dropdown-item active" href="<?= base_url($sm['url']);?>">
                  <?php else :?>
                  <a class="dropdown-item" href="<?= base_url($sm['url']);?>">
                  <?php endif;?>
                  <?= $sm['title'];?>
                </a>
              <?php endforeach;?>
            </div>
          </div>

          <div class="dropdown togglet_el">
            
            <a class="nav-link font-weight-bold pt-2 pb-0 px-0 ml-2 mb-2" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <button type="button" class="btn btn-dark pl-4 pr-4">
                <span>+ Baru</span>
              </button>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <?php
                $sebagai = $user['sebagai'];
                $queryAddMenu = "SELECT *
                                FROM `user_add_menu`
                               WHERE `sebagai` = '$sebagai'
                               AND `is_active` = 1
                               ";
                $addMenu = $this->db->query($queryAddMenu)->result_array();
              ?>

              <?php foreach ($addMenu as $am) :?>
              <a class="dropdown-item my-2 py-1 <?= $am['url'];?>" data-toggle="modal" data-target="#modalTrack" href="#"><?= $am['title'];?></a>
              <?php endforeach;?>
            </div>

          </div>

          <?php if ($status == "development"):?>
            <!-- Development -->
            <ul class="navbar-nav ml-auto">
              
              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name'];?></span>
                  <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profil/').'default.png';?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="<?= base_url('auth/loginas/').'bcampre';?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pegawai
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= base_url('auth/loginas/').'samudera';?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Pengangkut
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= base_url('auth/loginas/').'sejahtera';?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    TPS
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?= base_url('auth/loginas/').'machinery';?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Importir
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                </div>
              </li>

            </ul>
            <!-- End of Development -->
            <?php else:?>
            <!-- Production -->
            <ul class="navbar-nav ml-auto">
              
              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name'];?></span>
                  <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profil/').'default.png';?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="<?= base_url('auth');?>/changepassword/change/<?= $user['user']?>">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ganti Kata Sandi
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                  </a>
                </div>
              </li>

            </ul>
            <!-- End of Production -->
          <?php endif;?>

        </nav>
        <!-- End of Topbar -->