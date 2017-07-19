<?php
/**
 * Widgets init & registering.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Widgets
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

add_action( 'widgets_init', 'ddw_wpdrsd_register_widgets' );
/**
 * Register all our Widgets classes.
 *
 * @since 1.0.0
 *
 * @uses register_widget()
 * @uses ddw_wpdrsd_get_options()
 */
function ddw_wpdrsd_register_widgets() {

	/** Search Downloads Widget */
	require_once( WPDRSD_PLUGIN_DIR . '/includes/widgets/wpdrsd-widget-search.php' );
	register_widget( 'DDW_WPDRSD_Search_Downloads_Widget' );

	/** Popular Downloads Widget */
	require_once( WPDRSD_PLUGIN_DIR . '/includes/widgets/wpdrsd-widget-popular-downloads.php' );
	register_widget( 'DDW_WPDRSD_Popular_Downloads_Widget' );

	$options = ddw_wpdrsd_get_options();

	/** Downloads File Categories / Tags Widget */
	if ( $options[ 'wpdrsd_tax_file_categories' ] || $options[ 'wpdrsd_tax_file_tags' ] ) {

		require_once( WPDRSD_PLUGIN_DIR . '/includes/widgets/wpdrsd-widget-taxonomies.php' );
		register_widget( 'DDW_WPDRSD_Downloads_Taxonomies_Widget' );

	}  // end-if settings check

}  // end of function ddw_wpdrsd_register_widgets
