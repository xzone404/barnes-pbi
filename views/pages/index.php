<?php

if (!defined('ENV')) die();

?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">

          <div class="col-md-6 col-lg-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">BUs</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Manage your Business units</h6>

                <p class="card-text">View, create or update BUs.</p>
                <a href="bu/list" class="btn btn-primary"><?php __e('View table'); ?></a>
                <a href="bu/edit" class="btn btn-secondary"><?php __e('New'); ?></a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

          <div class="col-md-6 col-lg-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Clusters</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Manage your Clusters</h6>

                <p class="card-text">View, create or update Clusters.</p>
                <a href="cluster/list" class="btn btn-primary"><?php __e('View table'); ?></a>
                <a href="cluster/edit" class="btn btn-secondary"><?php __e('New'); ?></a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->

          <div class="col-md-6 col-lg-4">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">Collaborators</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Manage your Collaborators</h6>

                <p class="card-text">View, create or update Collaborators.</p>
                <a href="collaborator/list" class="btn btn-primary"><?php __e('View table'); ?></a>
                <a href="collaborator/edit" class="btn btn-secondary"><?php __e('New'); ?></a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          

          <?php /*
          <div class="col-lg-6">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>

                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>

                <p class="card-text">
                  Some quick example text to build on the card title and make up the bulk of the card's
                  content.
                </p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          */ ?>

        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

<?php view('parts.page_footer'); ?>
