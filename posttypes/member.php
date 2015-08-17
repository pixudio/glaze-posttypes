<?php 
/**
 * Member
 *
 * @posttype member
 * @shortcode hb_team
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( post_type_exists('member') ) {
	return;
}

function hb_featured_member_post_type () {
	$labels = array(
		'name' => _x( 'Members', 'post type general name', 'glaze' ),
		'singular_name' => _x( 'Member', 'post type singular name', 'glaze' ),
		'add_new' => _x( 'Add New', 'member', 'glaze' ),
		'add_new_item' => __( 'Add New Member', 'glaze' ),
		'edit_item' => __( 'Edit Member', 'glaze' ),
		'new_item' => __( 'New Member', 'glaze' ),
		'view_item' => __( 'View Member', 'glaze' ),
		'search_items' => __( 'Search Member', 'glaze' ),
		'not_found' =>  __( 'No member found', 'glaze' ),
		'not_found_in_trash' => __( 'No member found in Trash', 'glaze' ), 
		'parent_item_colon' => __( 'Parent member:', 'glaze' )
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-universal-access',
		'supports' => array('title','author')
	);

	register_post_type( 'member', $args );
}

add_action( 'init', 'hb_featured_member_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-member_columns", "member_edit_columns");

add_action("manage_member_posts_custom_column",  "member_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'member' ) );
   
function member_edit_columns($member_columns){
    $member_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Member', 'column name', 'glaze'),
        // "member_thumbnail" => __('Image', 'glaze'),
        "date" => __('Date', 'glaze')
    );
    return $member_columns;
}

function member_columns_display($member_columns, $post_id){
    switch ($member_columns)
    {
        case "member_thumbnail":
            $thumb_id = get_post_thumbnail_id( $post_id );
                
            if ($thumb_id != ''){
                $thumb = wp_get_attachment_image( $thumb_id, array( 100, 100 ), true );
                echo $thumb;
            } else {
                echo __('None', 'glaze');
            }
            
         break;
    }
}
