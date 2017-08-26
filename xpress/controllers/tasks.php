<?php
/**
 * Tasks Controller
 *
 */

class Tasks_Controller extends Xpress_MVC_Controller {
	function register_routes() {
		$this->register_route( 'new-task', '/tasks/new', array(
			'methods' => 'GET',
			'callback' => array( $this, 'new' ),
		) );
		$this->register_route( 'create-task', '/tasks', array(
			'methods' => 'POST',
			'callback' => array( $this, 'create' ),
			'args' => array(
				'title',
			),
		) );
		$this->register_route( 'edit-task', '/tasks/(?P<slug>.+)/edit', array(
			'methods' => 'GET',
			'callback' => array( $this, 'edit' ),
		) );
		$this->register_route( 'destroy-task', '/tasks/(?P<slug>.+)/destroy', array(
			'methods' => 'POST',
			'callback' => array( $this, 'destroy' ),
		) );
		$this->register_route( 'update-task', '/tasks/(?P<slug>.+)', array(
			'methods' => 'POST',
			'callback' => array( $this, 'update' ),
			'args' => array(
				'title',
			),
		) );
	}

	function new( WP_REST_Request $request ) {
		return $this->ok();
	}

	function create( WP_REST_Request $request ) {
		$errors = null;

		if ( empty( $request->get_param( 'title' ) ) ) {
			$errors[] = 'Title is required.';
		}

		if ( ! empty( ( $errors ) ) ) {
			$data = array(
				'errors' => $errors,
			);
			return $this->ok( $data, 'edit-task' );
		}

		$task = wp_insert_post( array(
			'post_title'  => wp_strip_all_tags( $request->get_param( 'title' ) ),
			'post_type'   => 'task',
			'post_status' => 'publish',
			'post_author' => 1,
		) );

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}

	function edit( WP_REST_Request $request ) {
		$task = get_page_by_path( $request->get_param( 'slug' ), OBJECT, 'task' );

		if ( empty( $task ) ) {
			return $this->not_found();
		}

		$data = array(
			'task' => $task,
		);

		return $this->ok( $data );
	}

	function update( WP_REST_Request $request ) {
		$task = get_page_by_path( $request->get_param( 'slug' ), OBJECT, 'task' );

		if ( empty( $task ) ) {
			return $this->not_found();
		}

		$errors = null;

		if ( empty( $request->get_param( 'title' ) ) ) {
			$errors[] = 'Title is required.';
		}

		if ( ! empty( ( $errors ) ) ) {
			$data = array(
				'task' => $task,
				'errors' => $errors,
			);
			return $this->ok( $data, 'edit-task' );
		}

		$task->post_title = wp_strip_all_tags( $request->get_param( 'title' ) );

		$task = wp_update_post( $task );

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}

	function destroy( WP_REST_Request $request ) {
		$task = get_page_by_path( $request->get_param( 'slug' ), OBJECT, 'task' );

		if ( empty( $task ) ) {
			return $this->not_found();
		}

		wp_delete_post( $task->ID );

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}
}
new Tasks_Controller();
