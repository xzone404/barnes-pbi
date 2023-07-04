<?php

if (!defined('ENV')) die();

view('parts.header');

view('pages.' . get_current_view());

view('parts.footer');
