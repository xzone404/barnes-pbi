<?php

if (!defined('ENV')) die();

$menu = v('menu');

?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="<?php echo get_asset_uri('images/logo_404.png'); ?>" alt="<?php __e('site_title') ?>" class="brand-image">
      <span class="brand-text font-weight-light small"><?php __e('site_title') ?> <?php __e('site_version') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo get_asset_uri('images/avatar.jpg'); ?>" class="img-circle elevation-2" alt="User">
        </div>
        <div class="info">
          <a href="#" class="d-block">Joseph M.</a>
        </div>
      </div>

      <?php /*
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      */ ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            foreach ($menu as $m_item) :
              $menu_item = get_page($m_item->menu_item);
          ?>
          <li class="nav-item<?php if ($menu_item->uri == preg_replace('%^([^\/]+)\/.*$%', '$1', get_current_uri())) echo ' menu-open'; ?>">
            <a href="#" class="nav-link active">
              <i class="nav-icon <?php echo $menu_item->menu_icon ?? 'fas fa-tachometer-alt'; ?>"></i>
              <p>
                <?php echo $menu_item->menu_label; ?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php if (count($m_item->menu_children) > 0) : ?>
            <ul class="nav nav-treeview">
              <?php
                foreach ($m_item->menu_children as $sm_item) :
                  $submenu_item = get_page($sm_item->menu_item);
              ?>
              <li class="nav-item">
                <a href="<?php echo get_page_link($submenu_item->uri); ?>" class="nav-link<?php if ($submenu_item->uri == get_current_uri()) echo ' active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo $submenu_item->menu_label; ?></p>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </li>
          <?php endforeach; ?>
          <?php /*
          <li class="nav-item">
            <a href="mentions" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Mentions
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          */ ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
