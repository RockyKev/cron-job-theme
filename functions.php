<?php

// Disable posts/pages
// https://developer.wordpress.org/reference/functions/remove_menu_page/#comment-1308
function cj_remove_posts_menu() {
    // remove_menu_page( 'index.php' );                  //Dashboard
    // remove_menu_page( 'jetpack' );                    //Jetpack* 
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    // remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    // remove_menu_page( 'options-general.php' );        //Settings
    
}
add_action('admin_menu', 'cj_remove_posts_menu');


// Register Custom Post Type
function cj_custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Message Pushes', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Message Push', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Message Pushes', 'text_domain' ),
		'name_admin_bar'        => __( 'Message Push', 'text_domain' ),
		'archives'              => __( 'Message Archives', 'text_domain' ),
		'attributes'            => __( 'Message Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Message:', 'text_domain' ),
		'all_items'             => __( 'All Messages', 'text_domain' ),
		'add_new_item'          => __( 'Add New Message', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Message', 'text_domain' ),
		'edit_item'             => __( 'Edit Message', 'text_domain' ),
		'update_item'           => __( 'Update Message', 'text_domain' ),
		'view_item'             => __( 'View Message', 'text_domain' ),
		'view_items'            => __( 'View Messages', 'text_domain' ),
		'search_items'          => __( 'Search Message', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Messages list', 'text_domain' ),
		'items_list_navigation' => __( 'Messages list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Message Push', 'text_domain' ),
		'description'           => __( 'Pushes messages', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => "dashicons-format-status",
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
        'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'push_api', $args );

}
add_action( 'init', 'cj_custom_post_type', 0 );


// Disable Default Post WYSIWYG
function cj_remove_default_wysigwg() {
	remove_post_type_support( 'push_api', 'editor' );
}

add_action( 'init', 'cj_remove_default_wysigwg', 99);





	/**
	 * TODO: Review this and delete
	 */

if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
