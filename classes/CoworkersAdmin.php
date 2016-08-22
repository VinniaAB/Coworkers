<?php

/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 11:42
 */

namespace Vinnia\Coworkers;

class CoworkersAdmin
{
    const COWORKERS_POST_TYPE = 'vin_coworkers';
    const OPTION_KEY = '';

    public function init()
    {
        add_filter('enter_title_here', function ($title) {
            return $this->changeTitlePlaceholder($title);
        });

        register_deactivation_hook(__FILE__, function () {
            $this->pluginDeactivation();
        });
    }

    private function changeTitlePlaceholder($title)
    {
        if (get_post_type() === self::COWORKERS_POST_TYPE) {
            return 'Coworker name';
        }
        return $title;
    }

    private function pluginDeactivation()
    {
        delete_option(self::OPTION_KEY);
    }
}