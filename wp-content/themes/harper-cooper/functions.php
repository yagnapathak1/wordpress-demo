<?php

/**
 * Hoper & Copper functions and definitions
 *
 */

function hoper_copper_setup()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary-menu' => esc_html__('Primary', 'hoper_setup'),
    ));
    add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);
    // Add support for full and wide align images.
	add_theme_support( 'align-wide' );
    add_theme_support( 'custom-logo' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );
}
add_action('after_setup_theme', 'hoper_copper_setup');

function hoper_site_styles(){
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assest/css/bootstrap.min.css');
    wp_enqueue_style('fa-fa-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('theme-main', get_stylesheet_directory_uri(). '/assest/css/responsive.css');
    wp_enqueue_style('responsive-css', get_stylesheet_directory_uri(). '/style.css');
    wp_enqueue_script('jquery-min','https://code.jquery.com/jquery-3.6.0.min.js');
    wp_enqueue_script('custom-js',get_template_directory_uri() . '/assest/js/custom.js');
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assest/js/bootstrap.min.js');
   
    //  wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js');
    // wp_enqueue_style('bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css');
}
add_action('wp_enqueue_scripts','hoper_site_styles');

function add_additional_class($classes, $item, $args){
    if(isset($args->add_li_class)){
        $classes[] = $args->add_li_class;
    }
    return $classes;
}

add_filter('nav_menu_css_class', 'add_additional_class', 1, 3);
function add_additional_class_on_a($classes, $item, $args)
{
    if (isset($args->add_a_class)) {
        $classes['class'] = $args->add_a_class;
    }
    return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);

/*
* Creating a function to create our CPT
*/
  
function custom_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Projects', 'Post Type General Name', 'hoper' ),
        'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'hoper' ),
        'menu_name'           => __( 'Projects', 'hoper' ),
        'parent_item_colon'   => __( 'Parent Project', 'hoper' ),
        'all_items'           => __( 'All Projects', 'hoper' ),
        'view_item'           => __( 'View Project', 'hoper' ),
        'add_new_item'        => __( 'Add New Project', 'hoper' ),
        'add_new'             => __( 'Add New', 'hoper' ),
        'edit_item'           => __( 'Edit Project', 'hoper' ),
        'update_item'         => __( 'Update Project', 'hoper' ),
        'search_items'        => __( 'Search Project', 'hoper' ),
        'not_found'           => __( 'Not Found', 'hoper' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'hoper' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'Projects', 'hoper' ),
        'description'         => __( 'Project news and reviews', 'hoper' ),
        'labels'              => $labels,
        'menu_icon'           => 'dashicons-building',
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'status' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'Projects', $args );

    register_taxonomy('project-status', ['projects'], [
		'label' => __('Status', 'txtdomain'),
		'hierarchical' => true,
		'rewrite' => ['slug' => 'project-status'],
		'show_admin_column' => true,
		'show_in_rest' => true,
		'labels' => [
			'singular_name' => __('Status', 'txtdomain'),
			'all_items' => __('All Status', 'txtdomain'),
			'edit_item' => __('Edit Status', 'txtdomain'),
			'view_item' => __('View Status', 'txtdomain'),
			'update_item' => __('Update Status', 'txtdomain'),
			'add_new_item' => __('Add New Status', 'txtdomain'),
			'new_item_name' => __('New Status Name', 'txtdomain'),
			'search_items' => __('Search Status', 'txtdomain'),
			'parent_item' => __('Parent Status', 'txtdomain'),
			'parent_item_colon' => __('Parent Status:', 'txtdomain'),
			'not_found' => __('No Status found', 'txtdomain'),
		]
	]);
	register_taxonomy_for_object_type('project-status', 'projects');
  
}

add_action( 'init', 'custom_post_type', 0 );
//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

     $new_filetypes = array();
     $new_filetypes['svg'] = 'image/svg';
     $file_types = array_merge($file_types, $new_filetypes );

     return $file_types; 
} 
add_action('upload_mimes', 'add_file_types_to_uploads');

function register_sidebar_widgets(){
    register_sidebar( array(
    'name' => 'Footer Sidebar 1',
    'id' => 'footer-sidebar-1',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
    register_sidebar( array(
    'name' => 'Footer Sidebar 2',
    'id' => 'footer-sidebar-2',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
    register_sidebar( array(
    'name' => 'Footer Sidebar 3',
    'id' => 'footer-sidebar-3',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
    register_sidebar( array(
    'name' => 'Footer Sidebar 4',
    'id' => 'footer-sidebar-4',
    'description' => 'Appears in the footer area',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
}
add_action('widgets_init','register_sidebar_widgets');