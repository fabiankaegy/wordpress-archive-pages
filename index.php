<?php
/**
 * Plugin Name: WordPress Archive Pages
 * Description: Push Archive pages to the next level
 * Author: Fabian Kägy
 * Author URI: fabian-kaegy.com
 * Version: 0.0.1
 *
 * @package wordpress-archive-pages
 */

define( 'WORDPRESS_ARCHIVE_PAGES_PATH', plugin_dir_path( __FILE__ ) );
define( 'WORDPRESS_ARCHIVE_PAGES_URL', plugin_dir_url( __FILE__ ) );

add_action( 'admin_init', 'add_settings_for_post_types', 10 );
/**
 * add setting for each post type
 */
function add_settings_for_post_types() {

	$post_types = get_public_post_types();

	foreach ( $post_types as $post_type ) {
		register_setting_for_post_type( $post_type );
		add_setting_for_post_type( $post_type );
	}
}

/**
 * add setting for post type
 *
 * @param WP_Post_Type $post_type post type object
 */
function add_setting_for_post_type( $post_type ) {

	$post_type_slug  = $post_type->rewrite['slug'];
	$post_type_label = $post_type->label;

	add_settings_field(
		"post-type-$post_type_slug-archive-page",
		"$post_type_label Archive Page",
		function() use ( $post_type, $post_type_label, $post_type_slug ) {
			?>
			<label for="page_for_<?php echo esc_attr( $post_type_slug ); ?>">
			<?php
			printf(
				/*
				 * translators: %1$s: Post Type for which the archive Page gets selected.
				 * translators: %2$s: Select field to choose the page for posts.
				 */
				__( '%1$s Archive page: %2$s' ),
				esc_html( $post_type_label ),
				wp_dropdown_pages(
					array(
						'name'              => "archive_page_for_$post_type_slug",
						'echo'              => 0,
						'show_option_none'  => __( '&mdash; Select &mdash;' ),
						'option_none_value' => '0',
						'selected'          => get_option( "archive_page_for_$post_type_slug" ),
					)
				)
			);
			?>
			</label>
			<?php
		},
		'reading',
		'default'
	);
}

/**
 * register setting for post type
 *
 * @param WP_Post_Type $post_type post type object
 */
function register_setting_for_post_type( $post_type ) {

	$post_type_slug  = $post_type->rewrite['slug'];
	$post_type_label = $post_type->label;

	register_setting(
		'reading',
		"archive_page_for_$post_type_slug",
		[]
	);
}

/**
 * gets all PostTypes that are public and have an archive
 *
 * @return WP_Post_Type[] post types that are public and have an archive
 */
function get_public_post_types() {
	return get_post_types(
		[
			'public'      => true,
			'has_archive' => true,
		],
		'objects'
	);
}

add_filter( 'display_post_states', 'add_post_state_to_archives', 10, 2 );

/**
 * add post state to archives
 *
 * @param string[] $post_states post states
 * @param WP_Post  $post        post
 */
function add_post_state_to_archives( $post_states, $post ) {

	$post_types = get_public_post_types();

	foreach ( $post_types as $post_type ) {

		$post_type_slug  = $post_type->rewrite['slug'];
		$post_type_label = $post_type->label;

		$post_type_archive = get_option( "archive_page_for_$post_type_slug" );

		if ( $post_type_archive == $post->ID ) {
			/* translators: %s: Label of the Post Type. */
			array_push( $post_states, sprintf( __( '%s Archive' ), esc_attr( $post_type_label ) ) );
		}
	}

	return $post_states;
}
