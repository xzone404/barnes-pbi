<?php

if (!defined('ENV')) die();

$wrap_content = (isset($wrap_content) && !$wrap_content) ? false : true;
?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer"<?php if (!$wrap_content) { ?> style="margin-left: 0;"<?php } ?>>
    <!-- To the right -->
    <div class="d-none d-sm-block text-right">
      <strong><?php __e('site_copyright_1'); ?> <a href="https://404.fr">&copy;404.FR</a>.</strong> All rights reserved.
    </div>
    <!-- Default to the left -->
    <?php /* Anything you want */ ?>
  </footer>
</div>
<!-- ./wrapper -->
