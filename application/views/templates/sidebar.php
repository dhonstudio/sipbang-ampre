<style>
    @media screen and (max-width: 600px) {
      .sidebar_el {
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

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-white sidebar sidebar_el sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
          <img src="<?= base_url('assets/img/');?>logo.png" width="60" alt="">
          <text class="sidebar-brand-text mx-0">SIP Bang</text>
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

        <li class="nav-item">
          <div class="dropdown">
            
            <?php if ($user['level'] > 1):?>
              <a class="nav-link font-weight-bold pt-2 pb-0 px-0 ml-2 mb-4" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <button type="button" class="btn btn-dark pl-4 pr-4">
                  <span>+ Baru</span>
                </button>
              </a>
            <?php endif;?>

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
                <a class="dropdown-item my-2 py-1 <?= $am['url']?>" data-toggle="modal" data-target="#<?= $am['url']?>" href="#"><?= $am['title'];?></a>
              <?php endforeach;?>
            </div>

          </div>
        </li>

        <?php
          $querySubMenu = "SELECT *
                          FROM `user_sub_menu`
                         WHERE `sebagai` = '$sebagai'
                         AND `is_active` = 1
                         ";
          $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) :?>
          <?php if ($subtitle == $sm['title']) :?>
          <li class="nav-item active">
          <?php else :?>
          <li class="nav-item">
          <?php endif;?>
            <a class="nav-link font-weight-bold" href="<?= base_url($sm['url']);?>">
              <i class="<?= $sm['icon'];?>"></i>
              <span><?= $sm['title'];?></span></a>
          </li>
        <?php endforeach;?>

        <?php if ($user['sebagai'] == 'pegawai') :?>
          <?php if ($subtitle == 'Tracking') :?>
          <li class="nav-item active">
          <?php else :?>
          <li class="nav-item">
          <?php endif;?>
            <a class="nav-link font-weight-bold" href="#" data-toggle="modal" data-target="#modalTrack">
              <i class="fas fa-fw fa-sitemap"></i>
              <span>Tracking</span></a>
          </li>
        <?php endif;?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->