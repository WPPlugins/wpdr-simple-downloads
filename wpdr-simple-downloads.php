<?php 
/**
 * Main plugin file.
 * Use the WP Document Revisions plugin as very basic & simple download manager with this additional add-on plugin.
 *
 * @package   WP Document Revisions Simple Downloads
 * @author    David Decker
 * @link      http://twitter.com/deckerweb
 * @copyright Copyright 2012-2013, David Decker - DECKERWEB
 *
 * Plugin Name: WP Document Revisions Simple Downloads
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/wpdr-simple-downloads/
 * Description: Use the WP Document Revisions plugin as very basic & simple download manager with this additional add-on plugin.
 * Version: 1.0.0
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: wpdr-simple-downloads
 * Domain Path: /languages/
 *
 * Copyright 2012-2013 David Decker - DECKERWEB
 *
 *     This file is part of WP Document Revisions Simple Downloads,
 *     a plugin for WordPress.
 *
 *     WP Document Revisions Simple Downloads is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     WP Document Revisions Simple Downloads is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Setting constants
 *
 * @since 1.0.0
 */
/** Set plugin version */
define( 'WPDRSD_VERSION', ddw_wpdrsd_plugin_get_data( 'Version' ) );

/** Plugin directory */
define( 'WPDRSD_PLUGIN_DIR', dirname( __FILE__ ) );

/** Plugin base directory */
define( 'WPDRSD_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );

/** Formal/informal translations */
$options = ddw_wpdrsd_get_options();
$wpdrsd_translations_variant = ( $options[ 'wpdrsd_formal_translations' ] ) ? '/' : '/informal/';

/** Set constant/ filter for WordPress languages directory */
$wpdrsd_wp_lang_dir = WPDRSD_PLUGIN_BASEDIR . '/../../languages/wpdr-simple-downloads' . $wpdrsd_translations_variant . '';
define( 'WPDRSD_WP_LANG_DIR', apply_filters( 'wpdrsd_filter_wp_lang_dir', $wpdrsd_wp_lang_dir ) );

/** Set constant/ filter for plugin's languages directory */
$wpdrsd_lang_dir = WPDRSD_PLUGIN_BASEDIR . '/languages' . $wpdrsd_translations_variant . '';
define( 'WPDRSD_LANG_DIR', apply_filters( 'wpdrsd_filter_lang_dir', $wpdrsd_lang_dir ) );


register_activation_hook( __FILE__, 'ddw_wpdrsd_activation_check' );
/**
 * Checks for activated "WP Document Revision" plugin before allowing
 *    this add-on plugin to activate.
 *
 * @since 1.0.0
 */
function ddw_wpdrsd_activation_check() {

	/**
	 * Look for translations to display for the activation message
	 * Look first in WordPress "languages" folder, then in plugin's "languages" folder
	 */
	load_plugin_textdomain( 'wpdr-simple-downloads', false, WPDRSD_WP_LANG_DIR );
	load_plugin_textdomain( 'wpdr-simple-downloads', false, WPDRSD_LANG_DIR );

	/** Check for activated plugin "WP Document Revisions" */
	if ( ! class_exists( 'Document_Revisions' ) ) {

		/** If no WPDR, deactivate ourself */
		deactivate_plugins( plugin_basename( __FILE__ ) );

		/** Message: no WPDR active */
		$wpdrsd_deactivation_message = sprintf( __( 'Sorry, you cannot activate the %1$s plugin unless you have installed the latest version of the %2$sWP Document Revisions%3$s plugin.', 'wpdr-simple-downloads' ), __( 'WP Document Revisions Simple Downloads', 'wpdr-simple-downloads' ), '<a href="http://wordpress.org/extend/plugins/wp-document-revisions/" target="_new"><strong><em>', '</em></strong></a>' );

		/** Deactivation message */
		wp_die(
			$wpdrsd_deactivation_message,
			__( 'Plugin', 'wpdr-simple-downloads' ) . ': ' . __( 'WP Document Revisions Simple Downloads', 'wpdr-simple-downloads' ),
			array( 'back_link' => true )
		);

	}  // end-if WPDR check



}  // end of function ddw_wpdrsd_activation_check


/**
 * Get default plugin options.
 *
 * @since 1.0.0
 *
 * @return array 
 */
function ddw_wpdrsd_default_options() {

	return array(
		'wpdrsd_downloads_labels'       => true,
		'wpdrsd_tax_file_categories'    => true,
		'wpdrsd_tax_file_tags'          => true,
		'wpdrsd_downloads_translations' => true,
		'wpdrsd_formal_translations'    => true,
		'wpdrsd_remove_date_permalink'  => true,
		'wpdrsd_default_visibility'     => false,
		'wpdrsd_show_revision_log'      => true
	);

}  // end of function ddw_wpdrsd_default_options


/**
 * Get current plugin options.
 *
 * @since 1.0.0
 *
 * @return array 
 */
function ddw_wpdrsd_get_options() {

	$from_db = get_option( 'wpdrsd_options' );

	$default = ddw_wpdrsd_default_options();

	return wp_parse_args( $from_db, $default );

}  // end of function ddw_wpdrsd_get_options


add_action( 'init', 'ddw_wpdrsd_init', 1 );
/**
 * Load the text domain for translation of the plugin.
 * Load the plugin's widgets - very early.
 * 
 * @since 1.0.0
 */
function ddw_wpdrsd_init() {

	/** First look in WordPress' "languages" folder = custom & update-secure! */
	load_plugin_textdomain( 'wpdr-simple-downloads', false, WPDRSD_WP_LANG_DIR );

	/** Then look in plugin's "languages" folder = default */
	load_plugin_textdomain( 'wpdr-simple-downloads', false, WPDRSD_LANG_DIR );

	/** Include our widgets */
	require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-widgets-init.php' );

}  // end of function ddw_wpdrsd_init


add_action( 'init', 'ddw_wpdrsd_setup' );
/**
 * Setup: Register Widget Areas (Note: Has to be early on the "init" hook in order to display translations!)
 *
 * @since 1.0.0
 */
function ddw_wpdrsd_setup() {

	/** Load the admin and frontend functions only when needed */
	if ( is_admin() ) {
		require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-admin-extras.php' );
		require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-admin-settings.php' );
		require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-admin-settings-help.php' );
	}

	/** Add "Documents" link to WPDR plugin page */
	if ( is_admin() && current_user_can( 'edit_theme_options' ) ) {
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ) , 'ddw_wpdrsd_settings_page_link' );
	}

	/** Define constants and set defaults for removing all or certain sections */
	if ( ! defined( 'WPDRSD_SEARCH_LABEL_DISPLAY' ) ) {
		define( 'WPDRSD_SEARCH_LABEL_DISPLAY', TRUE );
	}

}  // end of function ddw_wpdrsd_setup


/**
 * Include other plugin files.
 *
 * @since 1.0.0
 */
/** Include various plugin functions */
require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-functions.php' );
require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-download-count.php' );
require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-download-id.php' );
require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-taxonomies.php' );

$options = ddw_wpdrsd_get_options();

if ( $options[ 'wpdrsd_remove_date_permalink' ]
	&& ( class_exists( 'Document_Revisions' ) || post_type_exists( 'document' ) )
) {
	require_once( WPDRSD_PLUGIN_DIR . '/includes/wpdrsd-remove-date-from-permalink.php' );
}  // end-if settings/class/cpt check

if ( ! is_admin() && ( 'genesis' == basename( get_template_directory() ) ) ) {

	/** Adjust post meta info for "Downloads" */
	require_once( WPDRSD_PLUGIN_DIR . '/includes/third-party-compat/wpdrsd-genesis-framework.php' );
	add_filter( 'genesis_post_meta', 'ddw_wpdrsd_genesis_post_meta', 20 );
}


/**
 * Flush rewrite rules on activation.
 *
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'flush_rewrite_rules' );


add_action( 'plugins_loaded', 'ddw_wpdrsd_load_translations' );
/**
 * Load the customized translations for "Downloads" or "Documents" variant.
 *    - Overrides translations from original WPDR plugin!
 *    - Load translations with "Downloads" or "Documents" wording as set on settings page.
 *    - Load formal or informal translations as set on settings page.
 *    - Supports storing translations in subfolders of WP_LANG_DIR to avoid overriding on plugin updates!
 *
 * Include this function within plugin main file to avoid strange behavior
 *    of "CodeStyling Localization" plugin.
 *
 * @since 1.0.0
 *
 * @uses ddw_wpdrsd_default_options()
 * @uses load_textdomain()
 *
 * @param $options
 *
 * @global mixed $locale
 */
function ddw_wpdrsd_load_translations() {

	global $locale;

	$options = ddw_wpdrsd_get_options();

	/**
	 * 1st Downloads English
	 */
	if ( $options[ 'wpdrsd_downloads_translations' ]
		&& ( empty( $locale )
			|| ( get_locale() == 'en_US' || get_locale() == 'en_GB' || get_locale() == 'en_NZ' || get_locale() == 'en' )
		)
	) {

		/** Load English version with "Downloads" wording */
		$mofile = WP_PLUGIN_DIR . '/wpdr-simple-downloads/wpdr-pomo/downloads-variant/en_US/' . apply_filters( 'wpdrsd_filter_downloads_plugin_english', 'wp-document-revisions-en_US' ) . '.mo';

	/**
	 * 2nd Downloads formal
	 */
	} elseif ( $options[ 'wpdrsd_downloads_translations' ] && $options[ 'wpdrsd_formal_translations' ] ) {
		/** Check for formal version */
		if ( is_readable( WP_LANG_DIR . '/wpdr-downloads/formal/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-downloads/formal/' . apply_filters( 'wpdrsd_filter_downloads_wplang_formal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Then check for custom version */
		elseif ( is_readable( WP_LANG_DIR . '/wpdr-downloads/custom/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-downloads/custom/' . apply_filters( 'wpdrsd_filter_downloads_wplang_custom_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Otherwise load plugin default */
		else {

			$mofile = WP_PLUGIN_DIR . '/wpdr-simple-downloads/wpdr-pomo/downloads-variant/formal/' . apply_filters( 'wpdrsd_filter_downloads_plugin_informal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}  // end-if file checks

	/**
	 * 3rd Downloads informal
	 */
	} elseif ( $options[ 'wpdrsd_downloads_translations' ] && ! $options[ 'wpdrsd_formal_translations' ] ) {

		/** Check for informal version */
		if ( is_readable( WP_LANG_DIR . '/wpdr-downloads/informal/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-downloads/informal/' . apply_filters( 'wpdrsd_filter_downloads_wplang_informal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Then check for custom version */
		elseif ( is_readable( WP_LANG_DIR . '/wpdr-downloads/custom/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-downloads/custom/' . apply_filters( 'wpdrsd_filter_downloads_wplang_custom_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Otherwise load plugin default */
		else {

			$mofile = WP_PLUGIN_DIR . '/wpdr-simple-downloads/wpdr-pomo/downloads-variant/informal/' . apply_filters( 'wpdrsd_filter_downloads_plugin_informal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}  // end-if file checks


	/**
	 * 4th Documents formal
	 */
	} elseif ( ! $options[ 'wpdrsd_downloads_translations' ] && $options[ 'wpdrsd_formal_translations' ] ) {

		/** Check for formal version */
		if ( is_readable( WP_LANG_DIR . '/wpdr-documents/formal/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-documents/formal/' . apply_filters( 'wpdrsd_filter_documents_wplang_formal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Then check for custom version */
		elseif ( is_readable( WP_LANG_DIR . '/wpdr-documents/custom/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-documents/custom/' . apply_filters( 'wpdrsd_filter_documents_wplang_custom_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Otherwise load plugin default */
		else {

			$mofile = WP_PLUGIN_DIR . '/wpdr-simple-downloads/wpdr-pomo/documents-variant/formal/' . apply_filters( 'wpdrsd_filter_documents_plugin_formal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}  // end-if file checks


	/**
	 * 5th Documents informal
	 */
	} elseif ( ! $options[ 'wpdrsd_downloads_translations' ] && ! $options[ 'wpdrsd_formal_translations' ] ) {
		/** Check for informal version */
		if ( is_readable( WP_LANG_DIR . '/wpdr-documents/informal/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-documents/informal/' . apply_filters( 'wpdrsd_filter_documents_wplang_informal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Then check for custom version */
		elseif ( is_readable( WP_LANG_DIR . '/wpdr-documents/custom/wp-document-revisions-' . get_locale() . '.mo' ) ) {

			$mofile = WP_LANG_DIR . '/wpdr-documents/custom/' . apply_filters( 'wpdrsd_filter_documents_wplang_custom_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}

		/** Otherwise load plugin default */
		else {

			$mofile = WP_PLUGIN_DIR . '/wpdr-simple-downloads/wpdr-pomo/documents-variant/informal/' . apply_filters( 'wpdrsd_filter_documents_plugin_informal_locale', 'wp-document-revisions-' . get_locale() ) . '.mo';

		}  // end-if file checks

	}  // end-if/elseif


	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		return load_textdomain( 'wp-document-revisions', $mofile );

	}  // end-if $mofile check

}  // end of function ddw_wpdrsd_load_translations


/**
 * Returns current plugin's header data in a flexible way.
 *
 * @since 1.0.0
 *
 * @uses get_plugins()
 *
 * @param $wpdrsd_plugin_value
 * @param $wpdrsd_plugin_folder
 * @param $wpdrsd_plugin_file
 *
 * @return string Plugin data.
 */
function ddw_wpdrsd_plugin_get_data( $wpdrsd_plugin_value ) {

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$wpdrsd_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$wpdrsd_plugin_file = basename( ( __FILE__ ) );

	return $wpdrsd_plugin_folder[ $wpdrsd_plugin_file ][ $wpdrsd_plugin_value ];

}  // end of function ddw_wpdrsd_plugin_get_data
