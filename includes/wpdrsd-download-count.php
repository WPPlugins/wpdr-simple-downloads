<?php
/**
 * Add simple download counter - to post type item edit and admin table.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Post Type
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

add_filter( 'manage_edit-document_columns', 'ddw_wpdrsd_do_show_download_count' );
/**
 * Set column order for post type table.
 *
 * @since 1.0.0
 *
 * @param $defaults
 * @param $output
 */
function ddw_wpdrsd_do_show_download_count( $defaults ) {
	
	/** Get existing columns first */
	$output = array_slice( $defaults, 0, 3 );

	/** Splice in "Clicks" */
	$output[ 'download_clicks' ] = '<span style="border-bottom: 1px dotted #666;" title="' . __( 'Added by WPDR Simple Downloads Plugin', 'wpdr-simple-downloads' ) . '">' . __( 'Clicks', 'wpdr-simple-downloads' ) . '</span>';

	/** Get the rest of the columns */
	$output = array_merge( $output, array_slice( $defaults, 2 ) );

	/** Return */
	return $output;

}  // end of function ddw_wpdrsd_do_show_download_count


add_action( 'manage_posts_custom_column', 'ddw_wpdrsd_show_download_count' );
/**
 * Add download count column to post type table.
 *
 * @since 1.0.0
 *
 * @param $column
 * @param $count
 *
 * @global mixed $post
 */
function ddw_wpdrsd_show_download_count( $column ) {
	
	global $post;
	
	$count = get_post_meta( $post->ID, '_wpdrsd_download_count', true );
	
	if ( 'download_clicks' == $column ) {

		echo esc_html( $count ? $count : 0 );

	}  // end-if

}  // end of function ddw_wpdrsd_show_download_count


add_filter( 'manage_edit-document_sortable_columns', 'ddw_wpdrsd_register_sortable_download_count' );
/**
 * Register the "Clicks" column as sortable.
 *
 * @since 1.0.0
 *
 * @param $columns
 */
function ddw_wpdrsd_register_sortable_download_count( $columns ) {

	$columns[ 'download_clicks' ] = 'download_clicks';

	return $columns;

}  // end of function ddw_wpdrsd_register_sortable_download_count


add_filter( 'request', 'ddw_wpdrsd_column_orderby_download_count' );
/**
 * Orderby for "Clicks" column - what & which value.
 *
 * @since 1.0.0
 *
 * @param $vars
 * @param $count
 *
 * @global mixed $post
 */
function ddw_wpdrsd_column_orderby_download_count( $vars ) {

	global $post;

	/** Get the counter */
	$count = isset( $wp_query->post->ID ) ? get_post_meta( $post->ID, '_wpdrsd_download_count', true ) : 0;

	/** What to sort and after which value */
	if ( isset( $vars[ 'orderby' ] ) && 'download_clicks' == $vars[ 'orderby' ] ) {

		$vars = array_merge( $vars, array(
			'meta_key' => esc_html( intval( $count ) ),
			'orderby'  => 'meta_value_num'
		) );

	}  // end-if

	return $vars;

}  // end of function ddw_wpdrsd_column_orderby_download_count


add_action( 'admin_menu', 'ddw_wpdrsd_add_meta_box', 99 );
/**
 * Register the "Download Information" meta box.
 *
 * @since 1.0.0
 */
function ddw_wpdrsd_add_meta_box() {

	add_meta_box( 'download-info', __( 'Download Information', 'wpdr-simple-downloads' ), 'ddw_wpdrsd_meta_box', 'document', 'normal', 'default' );

}  // end of function ddw_wpdrsd_meta_box


/**
 * Add the "Download Information" meta box.
 *
 * @since 1.0.0
 *
 * @param $count
 *
 * @global mixed $post
 */
function ddw_wpdrsd_meta_box() {

	global $post;
	
	$count = isset( $post->ID ) ? get_post_meta( $post->ID, '_wpdrsd_download_count', true ) : 0;

	do_action( 'wpdrsd_download_meta_box_before' );

	echo '<p>&bull; ' . sprintf( __( 'This Download has been accessed <strong>%d</strong> times.', 'wpdr-simple-downloads' ), $count ) . '</p>';

	do_action( 'wpdrsd_download_meta_box_after' );

}  // end of function ddw_wpdrsd_meta_box


add_action( 'template_redirect', 'ddw_wpdrsd_download_count' );
/**
 * Setup the simple download counter.
 *
 * @since 1.0.0
 *
 * @uses get_post_meta()
 * @uses update_post_meta()
 *
 * @param $count
 *
 * @global mixed $wp_query
 */
function ddw_wpdrsd_download_count() {
	
	if ( ! is_singular( 'document' ) ) {
		return;
	}

	global $wp_query;
	
	/** Update the count */
	$count = isset( $wp_query->post->ID ) ? get_post_meta( $wp_query->post->ID, '_wpdrsd_download_count', true ) : 0;

	update_post_meta( $wp_query->post->ID, '_wpdrsd_download_count', $count + 1 );

}  // end of function ddw_wpdrsd_download_count
