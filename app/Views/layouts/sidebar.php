<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
      <img src="<?= base_url() ?>/img/Logoputih.png" alt="AdminLTE Logo" class="brand-image "
           style="opacity: .8">
      <span class="brand-text font-weight-light">&nbsp;</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/adminlte3') ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= user()->username ?> </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <?php if(has_permission('administrator')) { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('area') ?>" class="nav-link">
                  <i class="fas fa-tag nav-icon"></i>
                  <p>Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin') ?>" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('pareto') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pareto</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <li class="nav-item">
            <a href="<?= base_url('peta') ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Peta
              </p>
            </a>
          </li>
         
         
          <li class="nav-item ">
            <a href="<?= base_url('rcfa') ?>" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                RCFA
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?= base_url('report') ?>" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Report
                
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>