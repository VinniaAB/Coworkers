<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 12:04
 */

namespace Vinnia\Coworkers;

class CoworkersFrontend
{

    /**
     * CoworkersFrontend constructor.
     */
    public function __construct()
    {
    }

    public function init()
    {
        add_shortcode('display_coworkers', function() {
            return $this->displayCoworkers();
        });
    }

    public function displayCoworkers () {
        $coworkerBase = CoworkersBase::getInstance();
        $items = $coworkerBase->getCoworkers();
        $contents = '';
        if (!empty($items)) :
            ob_start();
            $template = locate_template('views/coworkers/coworker-index.php');

            if (empty($template)) {
                $template = __DIR__.'/../views/coworker-index.php';
            }

            include $template;

            $contents = ob_get_clean();
        endif;

        return($contents);

    }
}