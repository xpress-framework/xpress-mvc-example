<?php
/**
 * Tasks Controller
 *
 */

class Tasks_Controller extends Xpress_MVC_Controller {
	public $task;

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

		add_filter( 'xpress_mvc_request_before_callbacks', array( $this, 'get_task' ), 10, 3 );
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
			return $this->ok( $data, 'new-task' );
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
		$data = array(
			'task' => $this->task,
		);

		return $this->ok( $data );
	}

	function update( WP_REST_Request $request ) {
		$errors = null;

		if ( empty( $request->get_param( 'title' ) ) ) {
			$errors[] = 'Title is required.';
		}

		if ( ! empty( ( $errors ) ) ) {
			$data = array(
				'task' => $this->task,
				'errors' => $errors,
			);
			return $this->ok( $data, 'edit-task' );
		}

		$this->task->post_title = wp_strip_all_tags( $request->get_param( 'title' ) );

		$task = wp_update_post( $this->task );

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}

	function destroy( WP_REST_Request $request ) {
		wp_delete_post( $this->task->ID );

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}

	function get_task( $response, $handler, $request ) {
		switch ( $handler['callback'][1] ) {
			case 'edit':
			case 'update':
			case 'destroy':
				$this->task = get_page_by_path( $request->get_param( 'slug' ), OBJECT, 'task' );
				if ( empty( $this->task ) ) {
					$response = new WP_Error( 'not_found', __( 'Resource not found.' ), array(
						'status' => 404,
					) );
				}
			break;
		}
		return $response;
	}
}
new Tasks_Controller();
