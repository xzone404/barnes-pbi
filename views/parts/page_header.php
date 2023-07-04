<?php

if (!defined('ENV')) die();

$p_home = get_page_home();
$p_current = get_current_page();

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo is_home() ? __("site_title") : $p_current->menu_label; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"><?php echo $p_home->menu_label; ?></a></li>
              <?php
              $nodes = explode('/', $p_current->uri ?? '');
              $path = '';
              while (count($nodes) > 0) {
                $path .= '/'.array_shift($nodes);
                if ($path == '/') continue;
                $p = get_page($path);
                echo "\n\t\t\t\t\t\t\t".'<li class="breadcrumb-item active">';
                if (count($nodes) > 0) echo '<a href="'.get_page_link($p->uri).'">';
                echo $p->menu_label;
                if (count($nodes) > 0) echo '</a>';
                echo '</li>';
              }
              ?>              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
