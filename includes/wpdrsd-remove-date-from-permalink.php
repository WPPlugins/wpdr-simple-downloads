<?php
/**
 * Removes the year and month from document permalinks.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Post Type
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @author     Benjamin J. Balter
 * @link       http://ben.balter.com
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

add_filter( 'document_permalink', 'ddw_wpdrsd_remove_dates_from_permalink_filter', 10, 2 );
/**
 * Strip the date from permalink.
 *
 * @author Benjamin J. Balter
 * @link   http://ben.balter.com
 *
 * @since 1.0.0
 */
function ddw_wpdrsd_remove_dates_from_permalink_filter( $link, $post ) {

	$timestamp = strtotime( $post->post_date );

	return str_replace( '/' . date( 'Y', $timestamp ) . '/' . date( 'm', $timestamp ) . '/', '/', $link );
	
}  // end of function ddw_wpdrsd_remove_dates_from_permalink_filter


add_filter( 'document_rewrite_rules', 'ddw_wpdrsd_remove_date_from_rewrite_rules' );
/**
 * Strip the date from rewrite rules.
 *
 * @author Benjamin J. Balter
 * @link   http://ben.balter.com
 *
 * @since 1.0.0
 *
 * @global mixed $wpdr
 */
function ddw_wpdrsd_remove_date_from_rewrite_rules( $rules ) {

	global $wpdr;

	$slug = $wpdr->document_slug();

	$rules = array();

	/** Example: documents/foo-revision-1.bar */
	$rules[ $slug . '/([^.]+)-' . _x( 'revision', 'Translators: revisions slug', 'wpdr-simple-downloads' ) . '-([0-9]+)\.[A-Za-z0-9]{3,4}/?$'] = 'index.php?&document=$matches[1]&revision=$matches[2]';

	/** Example: documents/foo.bar/feed/ */
	$rules[ $slug . '/([^.]+)(\.[A-Za-z0-9]{3,4})?/feed/?$' ] = 'index.php?document=$matches[1]&feed=feed';

	/** Example: documents/foo.bar */
	$rules[ $slug . '/([^.]+)\.[A-Za-z0-9]{3,4}/?$' ] = 'index.php?document=$matches[1]';

	/** Example: site.com/documents/ should list all documents that user has access to (private, public) */
	$rules[ $slug . '/?$' ] = 'index.php?post_type=document';
	$rules[ $slug . '/page/?([0-9]{1,})/?$' ] = 'index.php?post_type=document&paged=$matches[1]';

	return $rules;

}  // end of function ddw_wpdrsd_remove_date_from_rewrite_rules
