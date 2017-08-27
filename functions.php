<?php
function xpress_mvc_example_enqueue_styles() {
    $parent_style = 'twentyfifteen-style';


    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_style( $parent_style,
    	get_template_directory_uri() . '/style.css'
    );
}
add_action( 'wp_enqueue_scripts', 'xpress_mvc_example_enqueue_styles' );

require 'xpress/post-types/task.php';
require 'xpress/controllers/tasks.php';
