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
    const COWORKERS_POST_TYPE = 'vin_coworkers';
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
                'excerpt',
                'page-attributes'
            ),
            'rewrite' => array(
                'slug' => 'coworker',
            )
        );
        register_post_type(self::COWORKERS_POST_TYPE, $args);
    }

    public function getCoworkers () {
        global $post;
        $args = array(
            'post_type' => self::COWORKERS_POST_TYPE,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => -1);
        $query = new \WP_Query($args);
        $coworkers = $query->get_posts();
        $return_array = array();

        if ($coworkers) {
            foreach ($coworkers as $post) :
                $ref = $this->parseCoworker($post);

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

    private function parseCoworker(\WP_Post $post) {
        if (has_post_thumbnail($post->ID) ) {
            $featured_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium');
            $thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
            $title = get_the_title($post->ID);
            $excerpt = get_the_excerpt($post->ID);
            $content = $post->post_content;
            $permalink = get_permalink($post->ID);
            if ($title) {
                $coworker = new Coworker();
                $coworker->image = $featured_image_url[0];
                $coworker->thumbnail = $thumbnail_url[0];
                $coworker->name = $title;
                $coworker->position = $excerpt;
                $coworker->content = apply_filters('the_content', $content);
                $coworker->permalink = $permalink;
                $coworker->post_id = $post->ID;

                return $coworker;
            }
        }
        return false;
    }
}