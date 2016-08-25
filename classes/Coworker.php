<?php
/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 24/08/16
 * Time: 14:15
 */

namespace Vinnia\Coworkers;


class Coworker
{
    const POST_TYPE_NAME = 'vin_coworkers';
    const OPTION_KEY_NAME = 'coworker_details';

    public $image;
    public $thumbnail;
    public $name;
    public $position;
    public $content;
    public $permalink;
    public $post_id;
    public $email;
    public $phone;
}