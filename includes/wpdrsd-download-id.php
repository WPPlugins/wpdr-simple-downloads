<?php
/**
 * Add post type item ID to admin columns table.
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

add_filter( 'manage_edit-document_columns', 'ddw_wpdrsd_do_show_download_id' );
/**
 * Set column order for post type table.
 *
 * @since 1.0.0
 *
 * @param $defaults
 * @param $output
 */
function ddw_wpdrsd_do_show_download_id( $defaults ) {
	
	/** Get existing columns first */
	$output = array_slice( $defaults, 0, 3 );

	/** Splice in "ID" */
	$output[ 'download_id' ] = '<span style="cursor: help; border-bottom: 1px dotted #666;" title="' . __( 'Added by WPDR Simple Downloads Plugin', 'wpdr-simple-downloads' ) . '">' . __( 'ID', 'wpdr-simple-downloads' ) . '</span>';

	/** Get the rest of the columns */
	$output = array_merge( $output, array_slice( $defaults, 2 ) );

	/** Return */
	return $output;

}  // end of function ddw_wpdrsd_do_show_download_id


add_action( 'manage_posts_custom_column', 'ddw_wpdrsd_show_download_id' );
/**
 * Add download ID column to post type table.
 *
 * @since 1.0.0
 *
 * @param $column
 * @param $download_id
 *
 * @global mixed $post
 */
function ddw_wpdrsd_show_download_id( $column ) {
	
	global $post;
	
	$download_id = isset( $post->ID ) ? $post->ID : 'n.a.';
	
	if ( 'download_id' == $column ) {

		echo esc_html( $download_id ? $download_id : '' );

	}  // end-if

}  // end of function ddw_wpdrsd_show_download_id


add_action( 'wpdrsd_download_meta_box_after', 'ddw_wpdrsd_meta_box_download_id' );
/**
 * Add the "Download Information" meta box.
 *
 * @since 1.0.0
 *
 * @param $download_id
 *
 * @global mixed $post
 */
function ddw_wpdrsd_meta_box_download_id() {

	global $post;
	
	$download_id = isset( $post->ID ) ? $post->ID : 'n.a.';

	echo '<p>&bull; ' . sprintf( __( 'ID of this Download:', 'wpdr-simple-downloads' ) . ' <code><strong>%s</strong></code>', esc_html( $download_id ) ) . '</p>';
	
}  // end of function ddw_wpdrsd_meta_box_download_id
