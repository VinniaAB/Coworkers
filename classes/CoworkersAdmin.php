<?php

/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 11:42
 */

namespace Vinnia\Coworkers;

require_once __DIR__.'/Coworker.php';

class CoworkersAdmin
{
    private $defaultMeta = [
        'position' => '',
        'email' => '',
        'phone' => ''
    ];

    public function init()
    {
        add_filter('enter_title_here', function ($title) {
            return $this->changeTitlePlaceholder($title);
        });

        register_deactivation_hook(__FILE__, function () {
            $this->pluginDeactivation();
        });

        add_action('save_post', function(int $post_id) {
            $this->saveCoworkerDetails($post_id);
        });

        add_meta_box(
            '_coworker_details',
            __('Coworker details'),
            function(\WP_Post $post) {
                $this->addMetaBox($post);
            },
            Coworker::POST_TYPE_NAME,
            'advanced',
            'high'
        );
    }

    private function validateSaveRequest() : bool
    {
        $action = $_REQUEST['action'] ?? '';
        $post_type = $_REQUEST['post_type'] ?? '';

        if (defined(WP_DEBUG)) {
            error_log("\nCurrent action: " . $action);
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return false;

        if (in_array($action, ['-1', 'untrash', 'trash', Coworker::POST_TYPE_NAME . '_import'])) {
            return false;
        }

        if (Coworker::POST_TYPE_NAME !== $post_type) {
            return false;
        }

        return true;
    }

    private function changeTitlePlaceholder($title)
    {
        if (get_post_type() === Coworker::POST_TYPE_NAME) {
            return 'Coworker name';
        }
        return $title;
    }

    private function pluginDeactivation()
    {
        delete_option(Coworker::OPTION_KEY_NAME);
    }

    private function addMetaBox(\WP_Post $post)
    {
        $coworker = CoworkersBase::getCoworker($post);
        include __DIR__."/../views/admin/detail-box.php";
    }

    private function saveCoworkerDetails(int $post_id)
    {
        if (!$this->validateSaveRequest()) {
            return;
        }

        $oldPostMeta = get_post_meta($post_id, Coworker::OPTION_KEY_NAME, $single = true);

        $newPostMeta = [];
        foreach ($this->defaultMeta as $key => $value) {
            if (isset($_REQUEST[$key])) {
                $newPostMeta[$key] = esc_attr($_REQUEST[$key]);
            }
        }

        $newPostMeta = wp_parse_args($newPostMeta, $oldPostMeta);

        update_post_meta($post_id, Coworker::OPTION_KEY_NAME, $newPostMeta, $oldPostMeta);

    }
}