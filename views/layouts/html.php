<?php

if (!defined('ENV')) die();

// get data before echo => keep headers not sent
$__h = view('parts.header', null, true);

$__p = view('pages.' . get_current_view(), null, true);

$__f = view('parts.footer', null, true);

// Output
echo $__h . "\n" . $__p . "\n" . $__f;