<?php 


// Enqueue own styles
function enqueue_custom_styles() {

	wp_enqueue_style( 'normalize', get_template_directory_uri() .'/css/normalize.css', array(), false, 'all' );
	wp_enqueue_style( 'main', get_template_directory_uri() .'/style.css', array(), false, 'all' );
	
	if ( is_singular( 'radical' ) ) {
    	wp_enqueue_style( 'radical', get_template_directory_uri() .'/css/radical.css', array(), false, 'all' );
	} else {
		wp_enqueue_style( 'homepage', get_template_directory_uri() .'/css/homepage.css', array(), false, 'all' );
	}

}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles' );


// Enqueue own scripts
function enqueue_custom_scripts() {

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), false, false );
	wp_enqueue_script( 'fittext', get_template_directory_uri() . '/js/fittext.js', array(), false, true );
	wp_enqueue_script( 'site', get_template_directory_uri() . '/js/site.js', array( 'jquery' ), false, true );

}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_scripts' );


// disable for posts
add_filter('use_block_editor_for_post', '__return_false', 10);

// disable for post types
add_filter('use_block_editor_for_post_type', '__return_false', 10);



// Register Custom Post Type Radical
function create_Radical_cpt() {

	$labels = array(
		'name' => _x( 'Radicals', 'Post Type General Name', 'textdomain' ),
		'singular_name' => _x( 'Radical', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => _x( 'Radicals', 'Admin Menu text', 'textdomain' ),
		'name_admin_bar' => _x( 'Radical', 'Add New on Toolbar', 'textdomain' ),
		'archives' => __( 'Radical Archives', 'textdomain' ),
		'attributes' => __( 'Radical Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Radical:', 'textdomain' ),
		'all_items' => __( 'All Radicals', 'textdomain' ),
		'add_new_item' => __( 'Add New Radical', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Radical', 'textdomain' ),
		'edit_item' => __( 'Edit Radical', 'textdomain' ),
		'update_item' => __( 'Update Radical', 'textdomain' ),
		'view_item' => __( 'View Radical', 'textdomain' ),
		'view_items' => __( 'View Radicals', 'textdomain' ),
		'search_items' => __( 'Search Radical', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Radical', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Radical', 'textdomain' ),
		'items_list' => __( 'Radicals list', 'textdomain' ),
		'items_list_navigation' => __( 'Radicals list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Radicals list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Radical', 'textdomain' ),
		'description' => __( 'Post type for the different Radicals', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'editor', 'post-formats', 'custom-fields'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'Radical', $args );

}
add_action( 'init', 'create_Radical_cpt', 0 );




/*
Create Custom Post Fields for the Radical Post Type
*/

function radical_options_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function radical_options_add_meta_box() {
	add_meta_box(
		'radical_options-radical-options',
		__( 'Radical Options', 'radical_options' ),
		'radical_options_html',
		'Radical',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'radical_options_add_meta_box' );

function radical_options_html( $post) {
	wp_nonce_field( '_radical_options_nonce', 'radical_options_nonce' ); ?>

	<p>
		<label for="radical_options_stroke_count"><?php _e( 'Stroke Count', 'radical_options' ); ?></label><br>
		<input type="text" name="radical_options_stroke_count" id="radical_options_stroke_count" value="<?php echo radical_options_get_meta( 'radical_options_stroke_count' ); ?>">
	</p>	<p>
		<label for="radical_options_hiragana_and_romaji_if_applicable_"><?php _e( 'Hiragana and Romaji (if applicable)', 'radical_options' ); ?></label><br>
		<input type="text" name="radical_options_hiragana_and_romaji_if_applicable_" id="radical_options_hiragana_and_romaji_if_applicable_" value="<?php echo radical_options_get_meta( 'radical_options_hiragana_and_romaji_if_applicable_' ); ?>">
	</p>	<p>
		<label for="radical_options_meaning"><?php _e( 'Meaning', 'radical_options' ); ?></label><br>
		<input type="text" name="radical_options_meaning" id="radical_options_meaning" value="<?php echo radical_options_get_meta( 'radical_options_meaning' ); ?>">
	</p>	<p>
		<label for="radical_options_position"><?php _e( 'Position', 'radical_options' ); ?></label><br>
		<input type="text" name="radical_options_position" id="radical_options_position" value="<?php echo radical_options_get_meta( 'radical_options_position' ); ?>">
	</p>	<p>
		<label for="radical_options_examples"><?php _e( 'Examples', 'radical_options' ); ?></label><br>
		<input type="text" name="radical_options_examples" id="radical_options_examples" value="<?php echo radical_options_get_meta( 'radical_options_examples' ); ?>">
	</p><?php
}

function radical_options_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['radical_options_nonce'] ) || ! wp_verify_nonce( $_POST['radical_options_nonce'], '_radical_options_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['radical_options_stroke_count'] ) )
		update_post_meta( $post_id, 'radical_options_stroke_count', esc_attr( $_POST['radical_options_stroke_count'] ) );
	if ( isset( $_POST['radical_options_hiragana_and_romaji_if_applicable_'] ) )
		update_post_meta( $post_id, 'radical_options_hiragana_and_romaji_if_applicable_', esc_attr( $_POST['radical_options_hiragana_and_romaji_if_applicable_'] ) );
	if ( isset( $_POST['radical_options_meaning'] ) )
		update_post_meta( $post_id, 'radical_options_meaning', esc_attr( $_POST['radical_options_meaning'] ) );
	if ( isset( $_POST['radical_options_position'] ) )
		update_post_meta( $post_id, 'radical_options_position', esc_attr( $_POST['radical_options_position'] ) );
	if ( isset( $_POST['radical_options_examples'] ) )
		update_post_meta( $post_id, 'radical_options_examples', esc_attr( $_POST['radical_options_examples'] ) );
}
add_action( 'save_post', 'radical_options_save' );

/*
	Usage: radical_options_get_meta( 'radical_options_stroke_count' )
	Usage: radical_options_get_meta( 'radical_options_hiragana_and_romaji_if_applicable_' )
	Usage: radical_options_get_meta( 'radical_options_meaning' )
	Usage: radical_options_get_meta( 'radical_options_position' )
	Usage: radical_options_get_meta( 'radical_options_examples' )
*/
