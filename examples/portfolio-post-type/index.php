<?php
/**
 * Plugin Name: Portfolio Post Type
 * Description: A Custom Post Type for Portfolios
 * Author: Fabian Kägy
 * Author URI: fabian-kaegy.com
 * Version: 1.0.1
 *
 * @package portfolio-post-type
 */

add_action( 'init', 'custom_post_type_portfolio', 10 );
/**
 * register portfolio custom post type
 */
function custom_post_type_portfolio() {

	$labels = array(
		'name'               => __( 'Portfolio', 'team-cpt' ),
		'singular_name'      => __( 'Portfolio', 'team-cpt' ),
		'menu_name'          => __( 'Portfolio', 'team-cpt' ),
		'parent_item_colon'  => __( 'Parent Person', 'team-cpt' ),
		'all_items'          => __( 'All People', 'team-cpt' ),
		'view_item'          => __( 'Show People', 'team-cpt' ),
		'add_new_item'       => __( 'Create new Person', 'team-cpt' ),
		'add_new'            => __( 'Create new', 'team-cpt' ),
		'edit_item'          => __( 'Edit Person', 'team-cpt' ),
		'update_item'        => __( 'Update Person', 'team-cpt' ),
		'search_items'       => __( 'Search Person', 'team-cpt' ),
		'not_found'          => __( 'Not Found', 'team-cpt' ),
		'not_found_in_trash' => __( 'Not Found in trash', 'team-cpt' ),
	);

	$args = array(
		'labels'              => $labels,
		'description'         => __( 'Portfolio', 'portfolio-cpt' ),
		'menu_icon'           => 'dashicons-format-gallery',
		'supports'            => [ 'title', 'editor', 'thumbnail' ],
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'rest_base'           => 'portfolio',

	);
	register_post_type( 'portfolio', $args );
}
