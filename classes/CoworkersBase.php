<?php

/**
 * Created by PhpStorm.
 * User: joakimcarlsten
 * Date: 22/08/16
 * Time: 11:41
 */

namespace Vinnia\Coworkers;

require_once __DIR__.'/Coworker.php';

class CoworkersBase
{

    protected static $instance;

    /**
     * CoworkersBase constructor.
     */
    public function __construct()
    {
    }

    public function registerPostType()
    {
        $args = array(
            'description' => 'A post type for your coworkers.',
            'public' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'labels' => array(
                'name' => 'Coworkers',
                'singular_name' => 'Coworker',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Coworker',
                'edit_item' => 'Edit Coworker',
                'new_item' => 'New Coworker',
                'view_item' => 'View Coworker',
                'search_items' => 'Search Coworker',
                'not_found' => 'No Coworkers Found',
                'not_found_in_trash' => 'No Coworkers Found In Trash',
            ),
            'menu_icon' => 'dashicons-groups',
            'capability_type' => 'page',
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'revisions',
                'page-attributes'
            ),
            'rewrite' => array(
                'slug' => 'coworker',
            )
        );
        register_post_type(Coworker::POST_TYPE_NAME, $args);
    }

    public function getCoworkers () {
        global $post;
        $args = array(
            'post_type' => Coworker::POST_TYPE_NAME,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => -1);
        $query = new \WP_Query($args);
        $coworkers = $query->get_posts();
        $return_array = array();

        if ($coworkers) {
            foreach ($coworkers as $post) :
                $ref = self::parseCoworker($post);

                if ( $ref ) {
                    $return_array[] = $ref;
                }
            endforeach;
        }
        return $return_array;
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private static function parseCoworker(\WP_Post $post) {
        if (has_post_thumbnail($post->ID) ) {
            $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
            $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
            $title = get_the_title($post->ID);
            $excerpt = get_the_excerpt($post->ID);
            $content = $post->post_content;
            $permalink = get_permalink($post->ID);
            $postMeta = get_post_meta($post->ID, Coworker::OPTION_KEY_NAME, $single = true);
            if ($title) {
                $coworker = new Coworker();
                $coworker->image = $featured_image_url[0];
                $coworker->thumbnail = $thumbnail_url[0];
                $coworker->name = $title;
                $coworker->content = apply_filters('the_content', $content);
                $coworker->permalink = $permalink;
                $coworker->post_id = $post->ID;

                var_dump($postMeta);
                foreach ($postMeta as $key => $value) {
                    $coworker->$key = $value;
                }

                return $coworker;
            }
        }
        return false;
    }

    public static function getCoworker(\WP_Post $post) : Coworker
    {
        return self::parseCoworker($post);
    }
}