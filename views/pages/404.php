<?php

if (!defined('ENV')) die();

?>
	<div id="page-wrapper">

<?php view('parts.page_header'); ?>

<?php view('parts.page_banner'); ?>

    <!-- Main -->
    <section id="main" class="container">

      <div class="box special">
        <header class="major">
          <h2>ERREUR 404<br />Cette page n'existe pas</h2>
          <p>
            La page que vous recherchez n'existe pas ou a été supprimée.
          </p>
        </header>
      </div>

      <div class="row">
        <div class="col-12">
          <section class="box">
            <p>
              Nous vous invitons à retourner sur la page d'accueil, ou à vous rendre directement sur
              la page d'inscription au registre Conexium.
            </p>
          </section>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <ul class="actions pb-6" style="justify-content: center;">
            <li><a class="button accent6" href="<?php echo esc_attr(get_site_link()); ?>">Retour à l'accueil</a></li>
          </ul>
        </div>
      </div>

    </section>

<?php view('parts.page_footer'); ?>

  </div>
