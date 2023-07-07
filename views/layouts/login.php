<?php

if (!defined('ENV')) die();

?><!DOCTYPE HTML>
<html lang="en">

<head>
	<title><?php __e('site_title'); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="<?php echo get_asset_uri('css/index.css') ?>" />
</head>

<body class="hold-transition sidebar-mini <?php echo get_current_view(); ?>">
<div class="wrapper" style="margin-left: 0;">

<?php
view('pages.' . get_current_view());

view('parts.footer');
