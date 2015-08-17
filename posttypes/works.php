<?php 
/**
 * Theme Work
 *
 * @posttype work
 * @shortcode hb_works && hb_work_carousel && hb_works_grid && hb_works_masonry
 */
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( post_type_exists('theme_slider') ) {
	return;
}

function hb_featured_work_post_type () {
	$labels = array(
		'name' => _x( 'Works', 'post type general name', 'glaze' ),
		'singular_name' => _x( 'Work', 'post type singular name', 'glaze' ),
		'add_new' => _x( 'Add New', 'work', 'glaze' ),
		'add_new_item' => __( 'Add New Work', 'glaze' ),
		'edit_item' => __( 'Edit Work', 'glaze' ),
		'new_item' => __( 'New Work', 'glaze' ),
		'view_item' => __( 'View Work', 'glaze' ),
		'search_items' => __( 'Search Work', 'glaze' ),
		'not_found' =>  __( 'No work found', 'glaze' ),
		'not_found_in_trash' => __( 'No work found in Trash', 'glaze' ), 
		'parent_item_colon' => __( 'Parent work:', 'glaze' )
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
		'taxonomies' => array( 'work-group' ), 
		'menu_position' => 5,
		'menu_icon' => 'dashicons-editor-paste-word',
		'supports' => array('title','thumbnail', 'excerpt', 'editor', 'author' /*'author','comments'*/)
	);

	register_post_type( 'work', $args );

	// "Work Pages" Custom Taxonomy
	$labels = array(
		'name' => _x( 'Work Groups', 'taxonomy general name', 'glaze' ),
		'singular_name' => _x( 'Work Groups', 'taxonomy singular name', 'glaze' ),
		'search_items' =>  __( 'Search Work Groups', 'glaze' ),
		'all_items' => __( 'All Work Groups', 'glaze' ),
		'parent_item' => __( 'Parent Work Group', 'glaze' ),
		'parent_item_colon' => __( 'Parent Work Group:', 'glaze' ),
		'edit_item' => __( 'Edit Work Group', 'glaze' ), 
		'update_item' => __( 'Update Work Group', 'glaze' ),
		'add_new_item' => __( 'Add New Work Group', 'glaze' ),
		'new_item_name' => __( 'New Work Group Name', 'glaze' ),
		'menu_name' => __( 'Work Groups', 'glaze' )
	); 	

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'work-group' )
	);

	register_taxonomy( 'work-group', array( 'work' ), $args );
} // End hb_featured_work_post_type()

add_action( 'init', 'hb_featured_work_post_type' );

/*-----------------------------/
	EDIT LIST CUSTOM COLUMNS
/-----------------------------*/
add_filter("manage_edit-work_columns", "work_edit_columns");

add_action("manage_work_posts_custom_column",  "work_columns_display", 10, 2);

add_theme_support( 'post-thumbnails', array( 'work' ) );
   
function work_edit_columns($work_columns){
    $work_columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => _x('Work', 'column name', 'glaze'),
        "work_thumbnail" => __('Image', 'glaze'),
        "group" => __('Group', 'glaze'),
        "date" => __('Date', 'glaze')
    );
    return $work_columns;
}

function work_columns_display($work_columns, $post_id){
    switch ($work_columns)
    {
        case "work_thumbnail":
            $thumb_id = get_post_thumbnail_id( $post_id );
                
            if ($thumb_id != ''){
                $thumb = wp_get_attachment_image( $thumb_id, array( 100, 100 ), true );
                echo $thumb;
            } else {
                echo __('None', 'glaze');
            }
            
         break;

		case 'group':
				    
				    $terms = get_the_terms( $post_id, 'work-group', '', ', ', '' );
				    
					if ( $terms && ! is_wp_error( $terms ) ) : 

						$groups_list = array();

						foreach ( $terms as $term ) {
							$groups_list[] = "{$term->name} (Group ID: {$term->term_id})";
						}
											
						$groups = join( ", ", $groups_list );

						echo $groups;

					else :

						_e( '&#8212;', MANA );

					endif;
		break;
    }
}