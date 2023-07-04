<?php

if (!defined('ENV')) die();

?>
</div>

<!-- Scripts -->
<script src="<?php echo get_page_link('dist/main.js'); ?>"></script>
<?php
global $inline_scripts;
if (!empty($inline_scripts??'')) :
  echo $inline_scripts;
endif;
?>

</body>

</html>