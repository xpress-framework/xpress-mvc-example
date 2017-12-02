<?php
/**
 * Tasks Controller
 *
 */

class Tasks_Controller extends XPress_MVC_Controller {
	function register_routes() {
		$this->register_route( 'new-task', '/tasks/new', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'new' ),
		) );
		$this->register_route( 'create-task', '/tasks', array(
			'methods'  => 'POST',
			'callback' => array( $this, 'create' ),
			// 'args'     => $this->task_params(),
		) );
		$this->register_route( 'edit-task', '/tasks/(?P<slug>.+)/edit', array(
			'methods'  => 'GET',
			'callback' => array( $this, 'edit' ),
		) );
		$this->register_route( 'update-task', '/tasks/(?P<slug>.+)/edit', array(
			'methods'  => 'PATCH',
			'callback' => array( $this, 'update' ),
			// 'args'     => $this->task_params(),
		) );
		$this->register_route( 'destroy-task', '/tasks/(?P<slug>.+)', array(
			'methods'  => 'DELETE',
			'callback' => array( $this, 'destroy' ),
		) );
	}

	function new( WP_REST_Request $request ) {
		$task = Task_Model::new();

		return $this->ok( $task );
	}

	function create( WP_REST_Request $request ) {
		$task = Task_Model::new( $request->get_params() );

		if ( $task->is_valid() ) {
			$task->save();
			return $this->redirect( get_post_type_archive_link( 'task' ) );
		} else {
			return $this->ok( $task, 'new-task' );
		}
	}

	function edit( WP_REST_Request $request ) {
		$task = Task_Model::get( $request->get_param( 'slug' ) );

		if ( is_wp_error( $task ) ) {
			return $task;
		}

		return $this->ok( $task );
	}

	function update( WP_REST_Request $request ) {
		$task = Task_Model::get( $request->get_param( 'slug' ) );

		if ( is_wp_error( $task ) ) {
			return $task;
		}

		$params = $request->get_params();
		unset( $params['_method'] );
		$task->update( $params );


		if ( $task->is_valid() ) {
			$task->save();
			return $this->redirect( get_post_type_archive_link( 'task' ) );
		} else {
			return $this->ok( $task, 'edit-task' );
		}
	}

	function destroy( WP_REST_Request $request ) {
		$task = Task_Model::get( $request->get_param( 'slug' ) );

		if ( is_wp_error( $task ) ) {
			return $task;
		}

		$task->delete();

		return $this->redirect( get_post_type_archive_link( 'task' ) );
	}
}
new Tasks_Controller();
