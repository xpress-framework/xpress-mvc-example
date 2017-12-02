<?php
/**
 * Task Model
 *
 */

class Task_Model extends XPress_MVC_Model {
	/**
	 * Model schema.
	 *
	 * @since 0.2.0
	 * @var array
	 */
	static protected $schema = array(
		'id' => array(
			'description' => 'Task Id',
			'type'        => 'number',
		),
		'title' => array(
			'description' => 'Task Name',
			'type'        => 'string',
			'required'    => true,
		),
		'slug' => array(
			'description' => 'Task Slug',
			'type'        => 'string',
		),
		'completed' => array(
			'description' => 'Task Completed',
			'type'        => 'string',
		),
	);

	/**
	 * Return a model instance for a specific item.
	 *
	 * @since 0.2.0
	 *
	 * @return XPress_MVC_Model instance.
	 */
	static function get( $id ) {
		$post = get_page_by_path( $id, OBJECT, 'task' );

		if ( empty( $post ) ) {
			return new WP_Error( 'not_found', __( 'Resource not found.' ), array(
				'status' => 404,
			) );
		}

		$task = Task_Model::from_post( $post );

		return $task;
	}

	/**
	 * Return a model instance collection filtered by the params.
	 *
	 * @since 0.2.0
	 *
	 * @return array XPress_MVC_Model instance collection.
	 */
	static function find( $params ) {
		$collection = array();

		$default_params = array(
			'post_type'   => 'task',
			'post_status' => 'publish',
		);

		if ( isset( $params['completed'] ) ) {
			$params['meta_key']   = 'completed';
			$params['meta_value'] = $params['completed'];
			unset( $params['completed'] );
		}

		$query = new WP_Query( wp_parse_args( $params, $default_params ) );

		while ( $query->have_posts() ) {
			$query->the_post();
			$collection[] = Task_Model::from_post( $post );
		}

		return $collection;
	}

	/**
	 * Persists the current model instance.
	 *
	 * @since 0.2.0
	 *
	 * @return boolean
	 */
	public function save() {
		$post_id = wp_insert_post( array(
			'ID'          => isset( $this->id ) ? $this->id : 0,
			'post_title'  => wp_strip_all_tags( $this->title ),
			'post_type'   => 'task',
			'post_status' => 'publish',
			'post_author' => 1,
		) );

		if ( $this->is_valid_post_id( $post_id ) ) {
			if ( ! empty( $this->completed ) ) {
				update_post_meta( $post_id, 'completed', $this->completed );
			}
			return true;
		}

		return false;
	}

	/**
	 * Delete the current model instance.
	 *
	 * @since 0.2.0
	 *
	 * @return XPress_MVC_Model instance.
	 */
	public function delete() {
		wp_delete_post( $this->id, true );
	}

	/**
	 * Detects wp_insert_post failure.
	 *
	 * @since 0.2.0
	 *
	 * @return boolean
	 */
	private function is_valid_post_id( $post_id ) {
		if ( is_wp_error( $post_id ) || $post_id == 0 ) {
			$is_valid_post_id = false;
		} else {
			$is_valid_post_id = true;
		}

		return $is_valid_post_id;
	}

	/**
	 * Convert post to task.
	 *
	 * @since 0.2.0
	 *
	 * @return XPress_MVC_Model instance.
	 */
	static function from_post( $post ) {
		$task = Task_Model::new( array(
			'id'        => $post->ID,
			'title'     => $post->post_title,
			'slug'      => $post->post_name,
			'completed' => get_post_meta( $post->ID, 'completed', true ),
		) );
		return $task;
	}
}
