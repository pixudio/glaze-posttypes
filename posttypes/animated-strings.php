<?php 
/**
 * Animated strings
 *
 * @posttype animated_string
 * @shortcode hb_animated_string
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( post_type_exists('animated_string') ) {
	return;
}

function hb_featured_animated_string_post_type () {
	$labels = array(
		'name' => _x( 'Animated Strings', 'post type general name', 'glaze' ),
		'singular_name' => _x( 'Animated String', 'post type singular name', 'glaze' ),
		'add_new' => _x( 'Add New', 'animated_string', 'glaze' ),
		'add_new_item' => __( 'Add New Animated String', 'glaze' ),
		'edit_item' => __( 'Edit Animated String', 'glaze' ),
		'new_item' => __( 'New Animated String', 'glaze' ),
		'view_item' => __( 'View Animated String', 'glaze' ),
		'search_items' => __( 'Search Animated String', 'glaze' ),
		'not_found' =>  __( 'No animated string found', 'glaze' ),
		'not_found_in_trash' => __( 'No animated string found in Trash', 'glaze' ), 
		'parent_item_colon' => __( 'Parent animated string:', 'glaze' )
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-format-status',
		'supports' => array('title','thumbnail', 'author')
	);

	register_post_type( 'animated_string', $args );
}

add_action( 'init', 'hb_featured_animated_string_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-animated_string_columns", "animated_string_edit_columns");

add_action("manage_animated_string_posts_custom_column",  "animated_string_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'animated_string' ) );
   
function animated_string_edit_columns($animated_string_columns){
    $animated_string_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Animated String', 'column name', 'glaze'),
    );

    if ( isset($_GET['mode']) && 'excerpt' == $_GET['mode'] )

    	$animated_string_columns["animated_string_thumbnail"] = __('Image', 'glaze');

    $animated_string_columns["shortcode"] = __('Shortcode', 'glaze');

    $animated_string_columns["date"] = __('Date', 'glaze');

    return $animated_string_columns;
}

function animated_string_columns_display($animated_string_columns, $post_id){
    switch ($animated_string_columns)
    {
        case "animated_string_thumbnail":
            $thumb_id = get_post_thumbnail_id( $post_id );
                
            if ($thumb_id != ''){
                $thumb = wp_get_attachment_image( $thumb_id, array( 60, 60 ), true );
                echo $thumb;
            } else {
                echo __('None', 'glaze');
            }
            
        break;

        case "shortcode":

            $thumb_id = get_post_thumbnail_id( $post_id );
                
            if ($thumb_id != ''){

            	echo '<pre>[hb_animated_string id="', $post_id, '"]</pre>'; 

            } else {

                echo '<span style="color: red">', __('Featured image is required', 'glaze'), '</span>';
            }
            
        break;
    }
}
