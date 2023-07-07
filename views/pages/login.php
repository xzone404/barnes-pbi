<?php

if (!defined('ENV')) die();
//i83osjaz51gfue4rnayzq2cbvhzp80rgfba9mhgs

$p_current = get_current_page();

?>
	<div id="page-wrapper">
    <div class="content-wrapper"<?php if (!$wrap_content) { ?> style="margin-left: 0;"<?php } ?>>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid pt-5">
        
        <div class="row justify-content-center">

          <div class="card card-primary shadow-5">
            <div class="card-header">
              <h3 class="card-title"><?php echo $p_current->menu_label; ?></h3>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo get_site_link('/'); ?>" method="POST">
              <div class="input-group mb-3">
                <input type="password" name="k" id="k" class="form-control" placeholder="Token" aria-label="Token" aria-describedby="button-submit">
                <button class="btn btn-outline-secondary" type="submit" id="submit">Ok</button>
              </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        
        </div>

      </div>
    </div>

<?php view('parts.page_footer', ['wrap_content' => false]); ?>