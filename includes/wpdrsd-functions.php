<?php
/**
 * Various essential plugin functions.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Plugin Functions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

add_action( 'init', 'ddw_wpdrsd_downloads_cpt_labels', 9 );
/** 
 * Optionally change post type labels to "Downloads".
 *
 * @since 1.0.0
 *
 * @uses ddw_wpdrsd_get_options()
 *
 * @params @options
 */
function ddw_wpdrsd_downloads_cpt_labels() {

	$options = ddw_wpdrsd_get_options();

	if ( $options[ 'wpdrsd_downloads_labels' ] ) {

		add_filter( 'document_revisions_cpt', 'ddw_wpdrsd_do_downloads_cpt_labels' );
		add_action( 'init', 'ddw_wpdrsd_do_downloads_toolbar_label' );
		add_action( 'admin_enqueue_scripts', 'ddw_wpdrsd_enqueue_styles', 11 );



	}  // end-if settings check

}  // end of function ddw_wpdrsd_downloads_cpt_labels


/** 
 * Changes all references of "Documents" in the interface to "Downloads".
 *
 * @since 1.0.0
 *
 * @params array $args the default args for the custom post type
 *
 * @returns array $args the CPT args with our modified labels.
 */
function ddw_wpdrsd_do_downloads_cpt_labels( $args ) {

	$args[ 'labels' ] = array(
		'name'               => _x( 'Downloads', 'Translators: post type general name', 'wpdr-simple-downloads' ),
		'singular_name'      => _x( 'Download', 'Translators: post type singular name', 'wpdr-simple-downloads' ),
		'add_new'            => _x( 'Add Download', 'Translators: download', 'wpdr-simple-downloads' ),
		'add_new_item'       => __( 'Add New Download', 'wpdr-simple-downloads' ),
		'edit_item'          => __( 'Edit Download', 'wpdr-simple-downloads' ),
		'new_item'           => __( 'New Download', 'wpdr-simple-downloads' ),
		'view_item'          => __( 'View Download', 'wpdr-simple-downloads' ),
		'search_items'       => __( 'Search Downloads', 'wpdr-simple-downloads' ),
		'not_found'          => __( 'No Downloads found', 'wpdr-simple-downloads' ),
		'not_found_in_trash' => __( 'No Downloads found in Trash', 'wpdr-simple-downloads' ), 
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Downloads', 'wpdr-simple-downloads' ),
	);

	$args[ 'supports' ] = apply_filters( 'wpdrsd_filter_post_type_supports', array( 'title', 'author', 'revisions', 'excerpt', 'custom-fields' ) );

	$args[ 'menu_icon' ] = apply_filters( 'wpdrsd_filter_admin_menu_icon', plugins_url( '/images/wpdrsd-menu-icon.png', dirname( __FILE__ ) ) );

	return apply_filters( 'wpdrsd_filter_post_type_args', $args );
	
}  // end of function ddw_wpdrsd_do_downloads_cpt_labels


/** 
 * Change "Add new" label in toolbar for "Downloads".
 *
 * @since 1.0.0
 *
 * @params $labels
 *
 * @global mixed $wp_post_types
 */
function ddw_wpdrsd_do_downloads_toolbar_label( $args ) {

	global $wp_post_types;

	$labels = &$wp_post_types[ 'document' ]->labels;
	$labels->name_admin_bar = _x( 'Download File', 'Translators: Toolbar, add new item', 'wpdr-simple-downloads' );

}  // end of function ddw_wpdrsd_do_downloads_toolbar_label


/** 
 * Optionally enqueue our own CSS styles.
 *
 * @since 1.0.0
 *
 * @uses wp_dequeue_style()
 * @uses wp_enqueue_style()
 *
 * @param $wpdr
 *
 * @global mixed $wpdrsd_settings_page
 */
function ddw_wpdrsd_enqueue_styles() {

	if ( ! class_exists( 'Document_Revisions' ) ) {
		return;
	}

	global $wpdrsd_settings_page;

	$wpdr = Document_Revisions::$instance;

	if ( ! $wpdr->verify_post_type() || ! $wpdrsd_settings_page ) {
		return;
	}

	/** Dequeue original WPDR CSS styles */
	//wp_dequeue_style( 'wp-document-revisions' );

	/** Enqueue our own CSS styles */
	wp_enqueue_style( 'wpdrsd-cpt-styles', plugins_url( '/css/wpdrsd-cpt-styles.css', dirname( __FILE__ ) ), array(), WPDRSD_VERSION );

}  // end of function ddw_wpdrsd_enqueue_styles


add_action( 'admin_head', 'ddw_wpdrsd_default_visibility' );
/** 
 * Default visibility of newly added downloads/ documents.
 *
 * @since 1.0.0
 *
 * @uses ddw_wpdrsd_get_options()
 *
 * @global mixed $wpdrsd_settings_page
 */
function ddw_wpdrsd_default_visibility() {

	$options = ddw_wpdrsd_get_options();

	if ( $options[ 'wpdrsd_default_visibility' ] ) {

		add_filter( 'document_to_private', 'ddw_wpdrsd_default_visibility_public', 10, 2 );

	}  // end-if settings check

}  // end of function ddw_wpdrsd_default_visibility


/** 
 * Set default visibility of newly added downloads/ documents to 'publish'.
 *
 * @since 1.0.0
 *
 * @param $post_pre
 *
 * @global mixed $post
 */
function ddw_wpdrsd_default_visibility_public( $post, $post_pre ) {

	global $post;

	$post->post_status = $post_pre->post_status;

	return $post;

}  // end of function ddw_wpdrsd_default_visibility_public


add_action( 'admin_init', 'wpdrsd_show_downloads_revision_log' );
/** 
 * Add "Revision Log" (= version info) of Downloads/ Documents to post type table.
 *    Content is the latest revision/ version description (= 'excerpt').
 *
 * @since 1.0.0
 *
 * @uses ddw_wpdrsd_get_options()
 *
 * @param $options
 */
function wpdrsd_show_downloads_revision_log() {

	$options = ddw_wpdrsd_get_options();

	if ( $options[ 'wpdrsd_show_revision_log' ] && ( empty( $_REQUEST[ 'mode' ] ) || $_REQUEST[ 'mode' ] == 'list' ) ) {

		add_filter( 'manage_edit-document_columns', 'ddw_wpdrsd_do_show_downloads_revision_log' );
		add_action( 'manage_posts_custom_column', 'ddw_wpdrsd_show_downloads_excerpt_custom_columns' );

	}  // end-if settings & load-edit.php mode check

}  // end of function wpdrsd_show_downloads_revision_log


/** 
 * Add "Revision Log" (= version info) of Downloads/ Documents to post type table.
 *    Content is the latest revision/ version description (= 'excerpt').
 *
 * @since 1.0.0
 *
 * @param $column_excerpt
 * @param $columns
 *
 * @return string Columns in post type table.
 */
function ddw_wpdrsd_do_show_downloads_revision_log( $columns ) {

	$column_excerpt = array( 'show_excerpt' => '<span style="cursor: help; border-bottom: 1px dotted #666;" title="' . __( 'Added by WPDR Simple Downloads Plugin', 'wpdr-simple-downloads' ) . '">' . __( 'Rev. Log', 'wpdr-simple-downloads' ) . '</span>' );

	$columns = array_slice( $columns, 0, 2, true ) + $column_excerpt + $columns;

	return $columns;

}  // end of function ddw_wpdrsd_do_show_downloads_revision_log


/** 
 * Show the "Revision Log" (= version info) in the Downloads/ Documents to post type table.
 *
 * @since 1.0.0
 *
 * @param $column
 */
function ddw_wpdrsd_show_downloads_excerpt_custom_columns( $column ) {

	global $post;

	if ( 'show_excerpt' == $column ) {

		$excerpt = ( ! empty( $post->post_excerpt ) ) ? the_excerpt() : '<em>' . __( 'n.a.', 'wpdr-simple-downloads' ) . '</em>';

		echo $excerpt;

	}  // end-if

}  // end of function ddw_wpdrsd_show_downloads_excerpt_custom_columns
