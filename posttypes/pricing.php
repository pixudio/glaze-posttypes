<?php 
/**
 * Pricing Table
 *
 * @posttype pricing_table
 * @shortcode hb_pricing
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( post_type_exists('pricing_table') ) {
	return;
}

function hb_featured_pricing_table_post_type () {
	$labels = array(
		'name' => _x( 'Pricing tables', 'post type general name', 'glaze' ),
		'singular_name' => _x( 'Pricing table', 'post type singular name', 'glaze' ),
		'add_new' => _x( 'Add New', 'pricing table', 'glaze' ),
		'add_new_item' => __( 'Add New Pricing table', 'glaze' ),
		'edit_item' => __( 'Edit Pricing table', 'glaze' ),
		'new_item' => __( 'New Pricing table', 'glaze' ),
		'view_item' => __( 'View Pricing table', 'glaze' ),
		'search_items' => __( 'Search Pricing table', 'glaze' ),
		'not_found' =>  __( 'No pricing table found', 'glaze' ),
		'not_found_in_trash' => __( 'No pricing table found in Trash', 'glaze' ), 
		'parent_item_colon' => __( 'Parent pricing table:', 'glaze' )
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-exerpt-view',
		'supports' => array('title', 'author' /*'author','comments'*/)
	);

	register_post_type( 'pricing_table', $args );

} // End hb_featured_pricing_table_post_type()

add_action( 'init', 'hb_featured_pricing_table_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-pricing_table_columns", "pricing_table_edit_columns");

add_action("manage_pricing_table_posts_custom_column",  "pricing_table_columns_display", 10, 2);
   
function pricing_table_edit_columns($pricing_table_columns){
    $pricing_table_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Pricing table', 'column name', 'glaze'),
        "shortcode" => __('Shortcode', 'glaze'),
        "date" => __('Date', 'glaze')
    );
    return $pricing_table_columns;
}

function pricing_table_columns_display($pricing_table_columns, $post_id){
    switch ($pricing_table_columns)
    {

		case 'shortcode':
				    
						echo '[hb_pricing id="', $post_id, '"]';

		break;
    }
}
