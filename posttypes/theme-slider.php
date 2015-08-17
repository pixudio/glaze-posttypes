<?php 
/**
 * Theme Slider
 *
 * @posttype theme_slider
 * @shortcode hb_theme_slider
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( post_type_exists('theme_slider') ) {
	return;
}

function hb_featured_theme_slider_post_type () {
	$labels = array(
		'name' => _x( 'Theme Sliders', 'post type general name', 'glaze' ),
		'singular_name' => _x( 'Theme Slider', 'post type singular name', 'glaze' ),
		'add_new' => _x( 'Add New', 'theme_slider', 'glaze' ),
		'add_new_item' => __( 'Add New Theme Slider', 'glaze' ),
		'edit_item' => __( 'Edit Theme Slider', 'glaze' ),
		'new_item' => __( 'New Theme Slider', 'glaze' ),
		'view_item' => __( 'View Theme Slider', 'glaze' ),
		'search_items' => __( 'Search Theme Slider', 'glaze' ),
		'not_found' =>  __( 'No theme slider found', 'glaze' ),
		'not_found_in_trash' => __( 'No theme slider found in Trash', 'glaze' ), 
		'parent_item_colon' => __( 'Parent theme slider:', 'glaze' )
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array('title', 'author')
	);

	register_post_type( 'theme_slider', $args );
}

add_action( 'init', 'hb_featured_theme_slider_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-theme_slider_columns", "theme_slider_edit_columns");

add_action("manage_theme_slider_posts_custom_column",  "theme_slider_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'theme_slider' ) );
   
function theme_slider_edit_columns($theme_slider_columns){
    $theme_slider_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Theme Slider', 'column name', 'glaze'),
    );

    $theme_slider_columns["shortcode"] = __('Shortcode', 'glaze');

    $theme_slider_columns["date"] = __('Date', 'glaze');

    return $theme_slider_columns;
}

function theme_slider_columns_display($theme_slider_columns, $post_id){
    switch ($theme_slider_columns)
    {
        case "shortcode":

            echo '<pre>[hb_theme_slider id="', $post_id, '"]</pre>';

        break;
    }
}
