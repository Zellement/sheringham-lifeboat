<?php  ?><?php  ?><?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );


	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		
		// overall theme js file
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
		
		// add jquery to theme
		wp_deregister_script('jquery');
		wp_register_script('jquery', "//code.jquery.com/jquery-1.9.1.min.js", false, null);
		wp_enqueue_script('jquery');
		
		/** import theme style.css **/
		wp_register_style( 'screen', get_template_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
		
		/** import scripts required for responsive goodness **/
		wp_enqueue_style( 'custom',  get_template_directory_uri().'/css/custom.css', '', '', 'screen' );
		
		/** import scripts required for responsive goodness **/
		wp_enqueue_style( 'fontawesome',  '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '', '', 'screen' );
		wp_enqueue_style( 'source',  '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Source+Serif+Pro', '', '', 'screen' );
		
		// nav
		wp_register_script( 'modernizr.custom', get_template_directory_uri().'/js/modernizr.custom.js' );
		wp_enqueue_script( 'modernizr.custom' );

		// nav
		//wp_register_script( 'picturefill.min', get_template_directory_uri().'/js/picturefill.min.js' );
		//wp_enqueue_script( 'picturefill.min' );
		
		// classie
		wp_register_script( 'classie', get_template_directory_uri().'/js/classie.js' );
		wp_enqueue_script( 'classie' );
		
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	/* ========================================================================================================================

	Sidebars

	======================================================================================================================== */

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar 1',
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2>',
			'after_title' => '</h2>',
		));
	}
	
	/* ========================================================================================================================

	Misc.

	======================================================================================================================== */
	
	// Hide annoying frontend toolbar
	add_filter('show_admin_bar', '__return_false'); 

	
	/* ========================================================================================================================

	Custom image sizes

	======================================================================================================================== */

	add_image_size( 'square-small', 300, 300, true ); 
	add_image_size( 'square-medium', 600, 600, true ); 
	add_image_size( 'square-large', 900, 900, true ); 

	add_image_size( 'runner-small', 500, 500, true );
	add_image_size( 'runner-medium', 800, 400, true ); 
	add_image_size( 'runner-large', 2000, 670, true ); 

	add_image_size( 'soft-large', 2000, 2000 ); 

	add_image_size( 'crew-image', 400, 670, true ); 



	
	/* ========================================================================================================================

	Custom post types

	======================================================================================================================== */


	// Register Custom Post Type
function shouts_post_type() {

	$labels = array(
		'name'                => _x( 'Shouts', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Shout', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Shouts', 'text_domain' ),
		'name_admin_bar'      => __( 'Add Shout', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Shout:', 'text_domain' ),
		'all_items'           => __( 'All Shouts', 'text_domain' ),
		'add_new_item'        => __( 'Add New Shout', 'text_domain' ),
		'add_new'             => __( 'New Shout', 'text_domain' ),
		'new_item'            => __( 'New Shout', 'text_domain' ),
		'edit_item'           => __( 'Edit Shout', 'text_domain' ),
		'update_item'         => __( 'Update Shout', 'text_domain' ),
		'view_item'           => __( 'View Shout', 'text_domain' ),
		'search_items'        => __( 'Search shouts', 'text_domain' ),
		'not_found'           => __( 'No shouts found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No shouts found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'shout', 'text_domain' ),
		'description'         => __( 'Shouts', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments',  ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-megaphone',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'shout', $args );

}

// Hook into the 'init' action
add_action( 'init', 'shouts_post_type', 0 );

// Register Custom Post Type
function events_post_type() {

	$labels = array(
		'name'                => _x( 'Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Events', 'text_domain' ),
		'name_admin_bar'      => __( 'Post Event', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'text_domain' ),
		'all_items'           => __( 'All Events', 'text_domain' ),
		'add_new_item'        => __( 'Add New Event', 'text_domain' ),
		'add_new'             => __( 'New Event', 'text_domain' ),
		'new_item'            => __( 'New Event', 'text_domain' ),
		'edit_item'           => __( 'Edit Event', 'text_domain' ),
		'update_item'         => __( 'Update Event', 'text_domain' ),
		'view_item'           => __( 'View Event', 'text_domain' ),
		'search_items'        => __( 'Search events', 'text_domain' ),
		'not_found'           => __( 'No events found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No events found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'event', 'text_domain' ),
		'description'         => __( 'Event information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-smiley',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,		
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'event', $args );

}

// Hook into the 'init' action
add_action( 'init', 'events_post_type', 0 );


// Remove P from images in content

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');