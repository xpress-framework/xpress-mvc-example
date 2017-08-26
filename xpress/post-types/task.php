<?
/**
 * Task Post Type
 *
 */

function xpress_mvc_example_post_type_task() {
	$labels = array(
		'name'               => _x( 'Tasks', 'post type general name', 'xpress-mvc-example' ),
		'singular_name'      => _x( 'Task', 'post type singular name', 'xpress-mvc-example' ),
		'menu_name'          => _x( 'Tasks', 'admin menu', 'xpress-mvc-example' ),
		'name_admin_bar'     => _x( 'Task', 'add new on admin bar', 'xpress-mvc-example' ),
		'add_new'            => _x( 'Add New', 'Task', 'xpress-mvc-example' ),
		'add_new_item'       => __( 'Add New Task', 'xpress-mvc-example' ),
		'new_item'           => __( 'New Task', 'xpress-mvc-example' ),
		'edit_item'          => __( 'Edit Task', 'xpress-mvc-example' ),
		'view_item'          => __( 'View Task', 'xpress-mvc-example' ),
		'all_items'          => __( 'All Tasks', 'xpress-mvc-example' ),
		'search_items'       => __( 'Search Tasks', 'xpress-mvc-example' ),
		'parent_item_colon'  => __( 'Parent Tasks:', 'xpress-mvc-example' ),
		'not_found'          => __( 'No Tasks found.', 'xpress-mvc-example' ),
		'not_found_in_trash' => __( 'No Tasks found in Trash.', 'xpress-mvc-example' )
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'          => 'dashicons-yes',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'tasks' ),
		'hierarchical'       => false,
		'supports'           => array( 'title' ),
	);
    register_post_type( 'task', $args );
}
add_action( 'init', 'xpress_mvc_example_post_type_task' );

function xpress_mvc_example_rewrite_flush() {
    xpress_mvc_example_post_type_task();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'xpress_mvc_example_rewrite_flush' );
