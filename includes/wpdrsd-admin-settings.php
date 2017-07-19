<?php
/**
 * Admin settings page for the plugin.
 *
 * @package    WP Document Revisions Simple Downloads
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright 2012-2013, David Decker - DECKERWEB
 * @link       http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * @link       http://twitter.com/deckerweb
 *
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 *
 * @since 1.0.0
 */

add_action( 'admin_menu', 'ddw_wpdrsd_admin_settings' );
/**
 * Registrer plugin's settings submenu panel.
 *    Load the help tab system on plugin's settings page.
 *    Add "Settings updated" message on saving settings page.
 *
 * @since 1.0.0
 *
 * @uses add_submenu_page()
 *
 * @global mixed $wpdrsd_settings_page
 */
function ddw_wpdrsd_admin_settings() {

	global $wpdrsd_settings_page;

	/** Add the submenu panel & settings page */
	$wpdrsd_settings_page = add_submenu_page(
		'edit.php?post_type=document',
		__( 'Download Settings', 'wpdr-simple-downloads' ) . ' &ndash; ' . __( 'WP Document Revisions Simple Downloads', 'wpdr-simple-downloads' ),									// title tag
		__( 'Download Settings', 'wpdr-simple-downloads' ),		// menu title
		'manage_options',						// capability
		'wpdrsd-settings',						// settings page slug
		'ddw_wpdrsd_settings_page'					// callback function
	);

	/** Load help tab system on plugin's setting page */
    	add_action( 'load-' . $wpdrsd_settings_page, 'ddw_wpdrsd_admin_settings_help' );

	/** Register/ Enqueue CSS styles for settings page */
	add_action( 'admin_enqueue_scripts', 'ddw_wpdrsd_settings_enqueue_styles' );

	/** Add & display message on saving options */
	if ( isset( $_GET[ 'settings-updated' ] ) ) {
		add_action( 'admin_notices', 'ddw_wpdrsd_settings_message' );
	}

}  // end of function ddw_wpdrsd_admin_settings


add_action( 'admin_init', 'ddw_wpdrsd_admin_init' );
/**
 * Registrer settings for the plugin.
 *
 * @since 1.0.0
 *
 * @uses register_setting()
 */
function ddw_wpdrsd_admin_init() {

	/** Register settings fields group & field */
	register_setting(
		'wpdrsd_options_group',			// settings fields group
		'wpdrsd_options',			// settings field
		'ddw_wpdrsd_options_validate'		// callback function
	);

}  // end of function ddw_wpdrsd_admin_init


/**
 * Validation of the options to save.
 *
 * @since 1.0.0
 *
 * @uses ddw_wpdrsd_default_options()
 *
 * @param array $input Raw options data.
 *
 * @return array Valid options data.
 */
function ddw_wpdrsd_options_validate( $input ) {

	$default = ddw_wpdrsd_default_options();

	if ( ! isset( $input[ 'wpdrsd_downloads_labels' ] ) ) {
		$default[ 'wpdrsd_downloads_labels' ] = false;
	}

	if ( ! isset( $input[ 'wpdrsd_tax_file_categories' ] ) ) {
		$default[ 'wpdrsd_tax_file_categories' ] = false;
	}

	if ( ! isset( $input[ 'wpdrsd_tax_file_tags' ] ) ) {
		$default[ 'wpdrsd_tax_file_tags' ] = false;
	}

	if ( ! isset( $input[ 'wpdrsd_downloads_translations' ] ) ) {
		$default[ 'wpdrsd_downloads_translations' ] = false;
	}

	if ( ! isset( $input[ 'wpdrsd_formal_translations' ] ) ) {
		$default[ 'wpdrsd_formal_translations' ] = false;
	}

	if ( ! isset( $input[ 'wpdrsd_remove_date_permalink' ] ) ) {
		$default[ 'wpdrsd_remove_date_permalink' ] = false;
	}

	if ( isset( $input[ 'wpdrsd_default_visibility' ] ) ) {
		$default[ 'wpdrsd_default_visibility' ] = true;
	}

	if ( ! isset( $input[ 'wpdrsd_show_revision_log' ] ) ) {
		$default[ 'wpdrsd_show_revision_log' ] = false;
	}

	return $default;

}  // end of function ddw_wpdrsd_options_validate


/**
 * Register & display "Settings updated" message when saving options.
 *
 * @since 1.0.0
 *
 * @uses add_settings_error()
 * @uses settings_errors()
 */
function ddw_wpdrsd_settings_message() {

	/** Register "Update" message */
	add_settings_error( 'wpdrsd-notices', '', __( 'Settings updated.', 'wpdr-simple-downloads' ), 'updated' );

	/** Display message */
	settings_errors( 'wpdrsd-notices' );

}  // end of function ddw_wpdrsd_settings_message


/**
 * Include settings page form code.
 *
 * @since 1.0.0
 */
function ddw_wpdrsd_settings_page() {

	include( WPDRSD_PLUGIN_DIR . '/includes/admin-form/wpdrsd-settings-form.php' );

}  // end of function ddw_wpdrsd_settings_page


/** 
 * Enqueue settings CSS styles.
 *
 * @since 1.0.0
 *
 * @uses wp_enqueue_style()
 */
function ddw_wpdrsd_settings_enqueue_styles() {

	/** Enqueue settings CSS styles */
	wp_enqueue_style( 'wpdrsd-styles', plugins_url( '/css/wpdrsd-styles.css', dirname( __FILE__ ) ), array(), WPDRSD_VERSION );

}  // end of function ddw_wpdrsd_settings_enqueue_styles
