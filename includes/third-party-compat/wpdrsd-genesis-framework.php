<?php
/**
 * Third-party compat: Genesis Framework - load the needed frontend logic/functions.
 *
 * @package    Genesis Connect for Easy Digital Downloads
 * @subpackage Third-party Compat: Genesis, Frontend
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

/** 
 * Sets the Genesis Post Meta for the "Document" (Downloads) post type,
 *    to use "wpdr-file-categories" and "wpdr-file-tags" taxonomies if they exist.
 *
 * @since 1.0.0
 *
 * @param $post_meta
 * @param $terms_file_categories
 * @param $terms_file_tags
 *
 * @global mixed $post
 *
 * @return strings Post meta info for "Document" (Downloads) post type taxonomies
 */
function ddw_wpdrsd_genesis_post_meta( $post_meta ) {
    
	global $post;

	if ( is_page() ) {
		return;
	}

	$terms_file_categories = wp_get_object_terms( $post->ID, 'wpdr-file-categories' );
	$terms_file_tags = wp_get_object_terms( $post->ID, 'wpdr-file-tags' );

	if ( 'document' == get_post_type() /* post_type_exists( 'document' ) */ ) {

		if ( ( count( $terms_file_categories ) > 0 ) && ( count( $terms_file_tags ) > 0 ) ) {

			$post_meta = do_shortcode( '[post_terms taxonomy="wpdr-file-categories"] <span class="post-meta-sep">' . _x( '&#x00B7;', 'Translators: Taxonomy separator for Genesis child themes (default: &#x00B7; = &middot;)', 'wpdr-simple-downloads' ) . '</span> [post_terms before="' . __( 'Tagged:', 'wpdr-simple-downloads' ) . ' " taxonomy="wpdr-file-tags"]<br /><br />' );

		} elseif ( ( count( $terms_file_categories ) > 0 ) && ! $terms_file_tags ) {

			$post_meta = do_shortcode( '[post_terms taxonomy="wpdr-file-categories"]<br /><br />' );

		} elseif ( ! $terms_cat && ( count( $terms_file_tags ) > 0 ) ) {

			$post_meta = do_shortcode( '[post_terms before="' . __( 'Tagged:', 'wpdr-simple-downloads' ) . ' " taxonomy="wpdr-file-tags"]<br /><br />' );

		} elseif ( ! $terms_file_categories && ! $terms_file_tags ) {

			$post_meta = '';

		}  // end-if taxonomy checks

	}  // end-if cpt check
    
	return $post_meta;

}  // end of function ddw_wpdrsd_genesis_post_meta
