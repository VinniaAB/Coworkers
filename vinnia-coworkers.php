<?php

/*
Plugin Name: Vinnia Coworkers
Plugin URI: http://www.vinnia.se
Description: Display coworkers on page.
Version: 0.1
Author: Joakim Carlsten
Author URI: http://www.vinnia.se
License: Don't know GPL, perhaps?
*/

namespace Vinnia\Coworkers;

defined('ABSPATH') or die('No script kiddies please!');


add_action('init', function () {
    require_once __DIR__ . '/classes/CoworkersBase.php';
    $coworkers = new CoworkersBase();
    $coworkers->init();
});


add_action('admin_init', function () {
    require_once __DIR__ . '/classes/CoworkersAdmin.php';
    $admin = new CoworkersAdmin();
    $admin->init();
});

add_action('template_redirect', function () {
    require_once __DIR__ . '/classes/CoworkersFrontend.php';
    $frontend = new CoworkersFrontend();
    $frontend->init();
});
